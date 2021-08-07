<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function userShow($userId)
    {
        $user = User::findOrFail($userId);
        return view('users.user', ['user'=>$user]);
    }
    
    public function userUpdate(Request $request, $userId)
    {
        $request->validate([
            'name' => 'required|max:15',
            'postalCode' => 'required|digits_between:1, 10|numeric',
            'telephone' => 'required|numeric',
            'address' => 'required|max:50',
            'email' => 'required|max:50',
            'password' => 'required|max:15|same:password_confirmation',
            'password_confirmation' => 'required|max:15',
        ]);
        
        $user = User::findOrFail($userId);
        $user->update([
            'name' => $request->name,
            'postalCode' => $request->postalCode,
            'telephone' => $request->telephone,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return view('users.userInfo_after_edit', ['user'=>$user]);
    }
    
    public function userDelete($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        return redirect('accountDeleted');
    }
    
    public function accountDeleted()
    {
        return view('users.accountDeleted');
    }
}
