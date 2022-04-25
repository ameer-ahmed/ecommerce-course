<?php

namespace EcommerceCourse\Http\Controllers\Dashboard;

use EcommerceCourse\Http\Controllers\Controller;
use EcommerceCourse\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    private $shippingMethods = ['free', 'local', 'outer'];

    public function editShipping($type) {
        if(in_array($type, $this->shippingMethods)) {
            $key = $type . '_shipping';
            $shippingType = Setting::where('key', $key)->first();
            return view('admin.settings.shipping.edit', compact('shippingType'));
        }
        return redirect()->route('admin.home');
    }

    public function saveShipping(Request $request, $type) {

    }
}
