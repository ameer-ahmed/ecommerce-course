<?php

namespace EcommerceCourse\Http\Controllers\Dashboard;

use EcommerceCourse\Http\Controllers\Controller;
use EcommerceCourse\Http\Requests\AdminAuthRequest;

class AuthController extends Controller
{

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
            return $this->customRedirect($request);
        }
        return redirect()->route('admin.login')->with(['error' => 'البيانات المدخلة غير صحيحة.']);
    }

    private function customRedirect(AdminAuthRequest $request) {
        if($request->input('goto') !== null && !empty($request->input('goto')))
            return redirect(route('admin.home').$request->input('goto'));
        return redirect()->route('admin.home');
    }

    public function logout()
    {
        $guard = auth()->guard('admin');
        if ($guard->check()) {
            $guard->logout();
            return redirect()->route('admin.login');
        }
    }

}
