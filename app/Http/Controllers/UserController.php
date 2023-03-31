<?php

namespace App\Http\Controllers;

use App\Imports\ClientImport;
use App\Jobs\SendSms;
use App\Mail\MailResetPassword;
use App\Models\OperationArea;
use App\Models\Operator;
use App\Models\User;
use App\Models\UserFlowHistory;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Jobs\MailRegisteredUser;
use App\DataTables\UserDataTable;
use App\Http\Requests\ValidateUser;
use App\Http\Requests\ValidateUpdateUser;

class UserController extends Controller
{
    const FILE_PATH = "public/files/users";

    public function index()
    {
        $operator_id = auth()->user()->operator_id;
        $data = User::with(["permissions",'roles','operator','institution']);
        $data->when($operator_id, function ($query) use ($operator_id) {
            return $query->where('operator_id', $operator_id);
        });
        $data = $data->orderBy('updated_at', 'desc')->select("users.*")->get();
        $dataTable = new UserDataTable($data);
        $operationAreas = OperationArea::query()->where('operator_id', $operator_id)->get();
        return $dataTable->render('admin.user_management.users',['operators'=>Operator::all(),'operationAreas'=>$operationAreas]);
    }


    public function store(ValidateUser $request)
    {
        $user = User::query()->make($request->validated());
        $password = \Helper::generatePassword();
        $user->fill(['password' => bcrypt($password)])->save();
        $this->dispatch(new MailRegisteredUser($user->email, $password, $user->name, $user->phone));
        return redirect()->back()->with('success', 'User created successfully');
    }

    public function update(ValidateUpdateUser $request, $user_id)
    {
        User::query()->find($user_id)->update($request->validated());
        return redirect()->back()->with('success', 'User Updated successfully');
    }

    public function userProfile($user_id)
    {
        $id = decryptId($user_id);
        $user = User::find($id);
        return view("admin.user_management.profile", compact("user"));
    }
    public function userPermissions($user_id)
    {
        $id = decryptId($user_id);
        $user = User::find($id);
        $user->load('roles.permissions');
        return view("admin.user_management.profile_roles", compact("user"));
    }


    public function resetPassword($user_id)
    {
        $id = decryptId($user_id);
        $user = User::find($id);
        $password = $this->generatePassword();
        $user->password = bcrypt($password);
        $user->save();
        $this->notifyResetPassword($user, $password);
        return redirect()->back()->with('success', "{$user->email} reset successfully");
    }

    public function notifyResetPassword($user, $password)
    {
//        Mail::to($user->email)->send(new MailResetPassword($user, $password));
        $message = "Your Account password has been reset. use this \" $password \" as password to login to your account.";
        $this->sendSMS($user, $message);
    }

    public function getUsersByBranch(Request $request)
    {
        $branches = $request->branches;
        if ($branches) {
            return User::whereIn("operator_id", $branches)->get();
        }

        return [];
    }

    protected static function storeFile($request, $paramName)
    {
        $file = $request->file($paramName);
        $extension = $file->extension();
        $image_name=$file->getClientOriginalName();
        $uuid = "attachment_" . str_slug(Str::uuid(), '_');
        $path = $file->storeAs(self::FILE_PATH, "$uuid" . ".$extension");
        $path=str_replace(' ','_',$path);
        return str_replace(self::FILE_PATH, '', $path);
    }

    public function disableUser($user_id)
    {
        $id = decryptId($user_id);
        $user = User::find($id);
        $action = $user->is_active ? 'Deactivate' : 'Activate';
        $user->is_active = !$user->is_active;
        $user->save();
        $this->saveFlowHistory($user,\request('reason'), $action);
        return redirect()->back()->with('success', "{$user->email} {$action}d successfully");
    }

    public function saveFlowHistory($user, $reason, $action){
        $flow = new UserFlowHistory();
        $flow->user_id = $user->id;
        $flow->reason = $reason;
        $flow->action = $action;
        $flow->done_by = auth()->user()->id;
        $flow->done_at = Carbon::now();
        $flow->save();
    }

    protected function sendSMS(User $user, $message = null): void
    {
        if (is_null($message)) {
            return;
        }
        // if env is local then send sms
        if (config('app.env') != 'local') {
            SendSms::dispatch($user->telephone, $message);
        }
    }

    protected function deleteUser($user_id)
    {
        try {
            $id = decryptId($user_id);
            $user = User::find($id);
            $user->delete();
            return redirect()->back()->with('success', "{$user->name} deleted successfully");
        }catch (\Exception $exception){
            return redirect()->back()->with('error', "Unable to delete {$user->name}");
        }
    }


}
