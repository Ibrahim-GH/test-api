<?php

namespace App\Http\Controllers;

use App\Enums\PermissionName;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->hasPermissionTo(PermissionName::SHOW_ALL_USERS)) {
            //get retrieve users records
            dd(auth()->id());
            $users = User::paginate(10);
            return $users;
        } else {
            abort(400, 'you are not allowed to do this action.');
        }
    }


    public function destroy(User $user)
    {
        $authUser = Auth::user();
        if ($authUser->hasPermissionTo(PermissionName::DELETE_USER)) {
            //delete a user by softDelete .
            $user->delete();
            return $user;
        } else {
            abort(400, 'you are not allowed to do this action.');
        }
    }


    public function restore(User $user)
    {
        // superAdmin is (id=1)  in database
        $authUser = Auth::user();
        //retrieve this user data with norlam eloquent query
        if ($authUser->hasPermissionTo(PermissionName::RESTORE_USER)) {
            $user->restore();
            return $user;
        } else {
            abort(400, 'you are not allowed to do this action.');
        }
    }
}
