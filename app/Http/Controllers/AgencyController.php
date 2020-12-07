<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AgencyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request){
        $users = User::where('role', 'agency')->get();
        return view('agency.home')->with('agencies', $users);
    }

    public function add(Request $request){

        return view('agency.add');
    }

    public function edit($id){
        $user = User::find($id);
        if(!$user){
            request()->session()->flash('notify-error', 'Something Went Wrong..!');
            return back();
        }

        return view('agency.edit')->with('agency', $user);
    }

    public function postUpdate(Request $request){
        if($request->has('id')){
            $id = $request->has('id') ? $request->get('id') : null;
            $user = User::find($id);
            $user->name = $request->get('name');
            if($request->has('email')){
                $request->validate([
                    'email'                 => ['required',Rule::unique('users', 'email')->ignore($user->id)],
                ],[
                    'email.required'                    => 'Email is required',
                ]);
            }
            $user->email = $request->get('email');
            $user->property_manager_name = $request->get('property_manager_name');

            if($request->has('password') && $request->get('password') != null &&  $request->get('password') == $request->get('confirm_password')){
                $user->password = Hash::make($request->get('password'));
            }
            request()->session()->flash('notify-success', 'Agency Updated Successfully..!');
            $user->save();
        }else{
            $request->validate([
                'name'                  => 'required',
                'property_manager_name' => 'required',
                'email'                 => 'required|email|unique:users',
            ],[
                'name.required'                     => 'Name is required',
                'property_manager_name.required'    => 'Property Manager Name is required',
                'email.required'                    => 'Email is required',
            ]);
            $user = new User();
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->property_manager_name = $request->get('property_manager_name');
            $password = '123456';
            $user->password = Hash::make($password);
            $user->save();
            request()->session()->flash('notify-success', 'Agency Added Successfully..!');
        }

        return redirect('agency');
    }

    public function postDelete(Request $request){
        $id = $request->has('id') ? $request->get('id') : null;
        $user = User::find($id);
        if(!$user){
            return back();
        }
        $user->jobs()->delete();
        $user->delete();
        request()->session()->flash('notify-success', 'Agency Deleted Successfully..!');
        return redirect('agency');
    }
}
