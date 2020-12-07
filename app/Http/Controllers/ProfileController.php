<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function edit(Request $request){
        return view('profile.edit');
    }

    public function postUpdate(Request $request){
            $user = Auth::user();
            $user->name = $request->get('name');
            $user->property_manager_name = $request->has('property_manager_name') ? $request->get('property_manager_name') : null;

            if($request->has('password') && $request->get('password') != null && $request->get('password') == $request->get('confirm_password')){
                $user->password = Hash::make($request->get('password'));
            }
            request()->session()->flash('notify-success', 'Profile Updated Successfully..!');
            $user->save();

        return back();
    }
}
