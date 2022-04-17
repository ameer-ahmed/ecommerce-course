<?php

namespace EcommerceCourse\Http\Controllers\Dashboard;

use EcommerceCourse\Http\Controllers\Controller;
use EcommerceCourse\Http\Requests\AdminAuthRequest;

class LoginController extends Controller
{
    protected $redirectPath = '/admin';

    public function viewLogin()
    {
        return view('admin.auth.login');
    }

    public function login(AdminAuthRequest $request)
    {
        $rememberMe = $request->has('remember_me');
        if (auth()->guard('admin')->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ], $rememberMe)) {
            return redirect()->route('admin.home');
        }
        return redirect()->route('admin.login')->with(['error' => 'البيانات المدخلة غير صحيحة.']);
    }

    public function logout()
    {
        if (auth()->guard('admin')->check()) {
            auth()->guard('admin')->logout();
            return redirect()->route('admin.login');
        }
    }

}
