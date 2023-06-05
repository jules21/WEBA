<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssignInstitutionToUserRequest;
use App\Http\Requests\UpdateAssignInstitutionToUserRequest;
use App\Models\Institution;
use App\Models\User;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class AssignUserToInstitutionController extends Controller
{
    public function index(Request $request,$institution_id){

        $users = User::where('institution_id',$institution_id)->get();
        return view('admin.settings.institution.assign_user',compact('users','institution_id'));
    }

    public function store(StoreAssignInstitutionToUserRequest $request){

//        dd($request->all());
        $institution = Institution::find($request->institution_id);

        $user = new User();
        $user->institution_id = $institution->id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->status = 'active';
        $user->password = bcrypt($request['password']);
//        dd($user);
        $user->save();
        return redirect()->back()->with('success','User Assigned Successfully');
    }

    public function update(UpdateAssignInstitutionToUserRequest $request){

        $user = User::findOrFail($request->input('InstitutionId'));
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
//        dd($user);
        $user->save();
        return redirect()->back()->with('success','User Updated Successfully');
    }

    public function destroy($id){

        try {
            $user = User::find($id);
            $user->delete();
            return redirect()->back()->with('success','User deleted Successfully');
        }catch (Exception $exception){
            info($exception);{
                return redirect()->back()->with('error','User can not be deleted');
            }
        }
    }
}
