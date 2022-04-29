<?php

namespace EcommerceCourse\Http\Controllers\Dashboard;

use EcommerceCourse\Http\Controllers\Controller;
use EcommerceCourse\Http\Requests\EditPasswordRequest;
use EcommerceCourse\Http\Requests\ProfileRequest;
use EcommerceCourse\Models\Admin;
use Exception;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function editProfile() {
        $admin = auth('admin')->user();
        return view('admin.profile.edit', compact('admin'));
    }

    public function saveProfile(ProfileRequest $request) {
        try {
            $admin = Admin::find(auth('admin')->user()->id);
            $admin->update($request->only(['name', 'email']));
            return redirect()->back()->with(['success' => 'تم التحديث بنجاح.']);
        } catch (Exception $exception) {
            return redirect()->back()->with(['error' => 'حدث خطأ أثناء حفظ التعديلات.']);
        }
    }

    public function savePassword(EditPasswordRequest $request) {
        try {
            $request->merge([
                'current_password' => bcrypt($request->current_password),
                'password' => bcrypt($request->password),
                'password_confirmation' => bcrypt($request->password_confirmation),
            ]);
            $admin = Admin::find(auth('admin')->user()->id);
            $admin->update($request->only('password'));
            auth()->guard('admin')->logout();
            return redirect()->route('admin.login')->with(['success' => 'تم تحديث كلمة المرور بنجاح.']);
        } catch (Exception $exception) {
            return redirect()->back()->with(['error' => 'حدث خطأ أثناء تحديث كلمة المرور.']);
        }
    }
}
