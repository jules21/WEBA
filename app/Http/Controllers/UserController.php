<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests\ValidateUpdateUser;
use App\Http\Requests\ValidateUser;
use App\Jobs\MailRegisteredUser;
use App\Jobs\SendSms;
use App\Mail\MailResetPassword;
use App\Models\OperationArea;
use App\Models\Operator;
use App\Models\User;
use App\Models\UserFlowHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Services\DataTable;

class UserController extends Controller
{
    const FILE_PATH = 'public/files/users';

    public function index(Request $request)
    {
        $operator_id = auth()->user()->operator_id;
        $data = User::with(['permissions', 'roles', 'operator', 'institution', 'operationArea','district']);
        if ($request->input('type') =="district") {
            $data = $data->has('district');
        }
        $data->when($operator_id, function ($query) use ($operator_id) {
            return $query->where('operator_id', $operator_id);
        });
        $data = $data->orderBy('updated_at', 'desc')->select('users.*')->get();
        $dataTable = new UserDataTable($data);
        $operationAreas = OperationArea::query()->where('operator_id', $operator_id)->get();

        if ($request->input('type') =="district") {
            return $dataTable->render('admin.user_management.district_users', ['operators' => Operator::all(), 'operationAreas' => $operationAreas]);
        }

        return $dataTable->render('admin.user_management.users', ['operators' => Operator::all(), 'operationAreas' => $operationAreas]);
    }

    public function districtUsers($data){
        return \DataTables::of($data)
            ->addColumn('district', function ($item) {
                return $item->district ? $item->district->name : '-';
            })
            ->editColumn('name', function ($item) {
                return '<div>
                            <div class="font-weight-bold">'.$item->name.'</div>
                        </div>';
            })
            ->editColumn('phone', function ($item) {
                return $item->phone ? $item->phone : '-';
            })
            ->editColumn('roles', function ($item) {
                if (count($item->roles) > 0) {
                    $roles = '';
                    foreach ($item->roles as $key => $role) {
                        if ($key == 0) {
                            $roles .= \Str::slug($role->name);
                        } else {
                            $roles .= ','.\Str::slug($role->name);
                        }
                    }

                    return '<a href="#" class="label label-info label-inline" data-toggle="tooltip" data-trigger="focus" data-html="true" title='.$roles.'>
                                    '.count($item->roles).'
                                </a>';
                } else {
                    return '-';
                }

            })
            ->editColumn('status', function ($item) {
                if ($item->status == 'active') {
                    return '
                    <span class="badge badge-success">Active</span>';
                } else {
                    return '
                 <span class="badge badge-danger">Inactive</span>
                    ';

                }
            })
            ->addColumn('action', function ($item) {
                return '<div class="btn-group">
                                <button type="button" class="btn btn-light-primary btn-sm dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">Actions
                                </button>
                                <div class="dropdown-menu" style="">
                                    <a class="dropdown-item" href="'.route('admin.user.add.roles', $item->id).'">Manage Roles</a>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="edit-btn dropdown-item "
                                       data-toggle="modal"
                                       data-target="#edit-user-model"
                                       data-name="'.$item->name.'"
                                       data-email="'.$item->email.'"
                                       data-phone="'.$item->phone.'"
                                       data-gender="'.$item->gender.'"
                                       data-id="'.$item->id.'"
                                       data-operator="'.$item->operator_id.'"
                                       data-national_id="'.$item->national_id.'"
                                       data-institution="'.$item->institution_id.'"
                                       data-status="'.$item->status.'"
                                       data-url="'.route('admin.users.update', $item->id).'"> Edit</a>';

            })
            ->rawColumns(['action', 'roles', 'status', 'phone', 'operator', 'name', 'district']);
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

        return view('admin.user_management.profile', compact('user'));
    }

    public function userPermissions($user_id)
    {
        $id = decryptId($user_id);
        $user = User::find($id);
        $user->load('roles.permissions');

        return view('admin.user_management.profile_roles', compact('user'));
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

    public function assignDistrict(User $user, Request $request)
    {
        $user->district()->create(['district_id' => $request->district_id]);
        return redirect()->back()->with('success', 'Districts assigned successfully');
    }


    protected static function storeFile($request, $paramName)
    {
        $file = $request->file($paramName);
        $extension = $file->extension();
        $image_name = $file->getClientOriginalName();
        $uuid = 'attachment_'.str_slug(Str::uuid(), '_');
        $path = $file->storeAs(self::FILE_PATH, "$uuid".".$extension");
        $path = str_replace(' ', '_', $path);

        return str_replace(self::FILE_PATH, '', $path);
    }

    public function disableUser($user_id)
    {
        $id = decryptId($user_id);
        $user = User::find($id);
        $action = $user->is_active ? 'Deactivate' : 'Activate';
        $user->is_active = ! $user->is_active;
        $user->save();

        return redirect()->back()->with('success', "{$user->email} {$action}d successfully");
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
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', "Unable to delete {$user->name}");
        }
    }
}
