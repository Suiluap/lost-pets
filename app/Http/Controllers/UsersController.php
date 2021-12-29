<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function usersIndex(){
        $users = User::whereNotIn('id', [Auth::id()])->paginate(20);
        return view('users.list', ['users' => $users]);
    }

    public function deleteUser(User $user)
    {
        if ($user->id == auth()->id() || auth()->user()->isAdmin()){
            File::deleteDirectory(public_path('pictures/'.$user->id));
            $user->delete();

            if(auth()->user()->isAdmin()){
                return redirect()->route('users')->with('status','Naudotojas sėkmingai pašalintas');
            }
            else{
                return redirect()->route('main')->with('status','Profilis sėkmingai pašalintas');
            }
        }
        else{
            abort(403);
        }
    }

    public function userIndex(User $user)
    {
        return view('users.user', ['user' => $user]);
    }

    public function editUser(User $user, Request $request)
    {
        if(($user->id == auth()->id()) || (auth()->user()->isAdmin()))
        {
            if($request->role == null)
            {
                $this->validate($request, [
                    'name' => 'required|max:255',
                    'email' => 'required|email|unique:users,email,'.$user->id.',id|max:255',
                    'phone' => 'required|regex:/^\+370[0-9]{8}$/|max:255',
                    'town' => 'required|max:255',
                ]);

                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone_number' => $request->phone,
                    'town' => $request->town,
                ]);

                return redirect()->route('me')->with('status','Profilis atnaujintas sėkmingai');

            }
            else
            {
                $this->validate($request, [
                    'name' => 'required|max:255',
                    'email' => 'required|email|unique:users,email,'.$user->id.',id|max:255',
                    'phone' => 'required|regex:/^\+370[0-9]{8}$/|max:255',
                    'town' => 'required|max:255',
                    'role' => 'required|in:user,admin'
                ]);

                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone_number' => $request->phone,
                    'town' => $request->town,
                    'role' => $request->role
                ]);

                return redirect()->route('users')->with('status','Naudotojas atnaujintas sėkmingai');
            }
        }
        else
        {
            abort(403);
        }
    }

    public function meIndex()
    {
        return view('users.me', ['user' => auth()->user()]);
    }

    public function passwordIndex()
    {
        return view('users.password');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|between:6,255',
            'password_confirmation' => 'required|same:password'
        ]);

        $currentPassword = Auth::User()->password;
        if(Hash::check($request['old_password'], $currentPassword))
        {
            $user = User::find(Auth::user()->id);
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            return redirect()->route('me')->with('status', 'Slaptažodis pakeistas sėkmingai!');
        }
        else
        {
            return back()->withErrors(['old_password' => 'Neteisingas senas slaptažodis.']);
        }
    }
}
