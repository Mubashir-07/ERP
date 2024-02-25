<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function userlogin()
    {
        return view('Auth.userLogin');
    }

    public function doUserLogin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('username' , $username)->first();
        if (!$user)
            return redirect()->route('user.login')->with('message', 'Incorrect Credentials');

        if ($user->userRole->role != 'user')
            return redirect()->route('user.login')->with('message' , 'Only user can login here');

        $verifyPassword = Hash::check($password , $user->password);
        if (!$verifyPassword)
            return redirect()->route('user.login')->with('message' , 'Incorrect Credentials');

        return redirect()->route('user.dashboard');
    }

    public function adminLogin()
    {
        return view('Auth.adminLogin');
    }

    public function doAdminLogin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $admin = User::where('username' , $username)->first();

        if ($admin->userRole->role != 'admin')
            return redirect()->route('admin.login')->with('message' , 'Only admin can login here.');

        if (auth()->attempt($request->only('username' , 'password')))
        {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }
        else
            return redirect()->route('admin.login');
    }


}
