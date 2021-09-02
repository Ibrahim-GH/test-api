<?php

namespace App\Http\Controllers;

use App\Enums\PermissionName;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $superAdmin)
    {
        if ($superAdmin->hasPermissionTo(PermissionName::DELETE_USER)) {
            //get retrieve users records
            $users = User::paginate(10);
            return $users;
        }
    }


    public function destroy(User $user)
    {
        // superAdmin is (id=1)  in database
        $superAdmin = User::find(1);
        if ($superAdmin->hasPermissionTo(PermissionName::DELETE_USER)) {
            //delete a user by softDelete .
            $user->delete();
            return $user;
        }
    }


    public function restore(User $user)
    {
        // superAdmin is (id=1)  in database
        $superAdmin = User::find(1);

        //retrieve this user data with norlam eloquent query
        if ($superAdmin->hasPermissionTo(PermissionName::RESTORE_USER)) {
            $user->restore();
        }
        return $user;
    }
}
