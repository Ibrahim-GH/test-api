<?php

namespace App\Http\Controllers;

use App\Models\User;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get retrieve notifications records
        $notifications = auth()->user()->unreadNotifications;
        return $notifications;

    }


    public function ReadNotifications(User $user)
    {
        if (auth()->id() == $user->id) {

            foreach ($user->unreadNotifications as $notification) {
                $notification->markAsRead();
                return "success the notifications read for user : " . $user->name;
            }

        } else {
            abort(400, ' auth user must be the notifications owner ');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (auth()->id() == $user->id) {
            $user->notifications()->delete();
            return "success the notifications delete for user : " . $user->name;
        } else {
            abort(400, ' auth user must be the notification owner ');
        }
    }
}
