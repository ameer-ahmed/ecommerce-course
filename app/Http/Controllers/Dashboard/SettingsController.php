<?php

namespace EcommerceCourse\Http\Controllers\Dashboard;

use EcommerceCourse\Http\Controllers\Controller;
use EcommerceCourse\Http\Requests\ShippingMethodsRequest;
use EcommerceCourse\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    private $shippingMethods = ['free', 'local', 'outer'];

    public function editShipping($type) {
        if(in_array($type, $this->shippingMethods)) {
            $key = $type . '_shipping';
            $shippingType = Setting::where('key', $key)->first();
            return view('admin.settings.shipping.edit', compact('shippingType'));
//            return $shippingType;
        }
        return redirect()->route('admin.home');
    }

    public function saveShipping(ShippingMethodsRequest $request, $id) {
        try {
            $shippingMethod = Setting::find($id);
            DB::beginTransaction();
            $shippingMethod->update([
                'plain_value' => $request->plain_value,
            ]);
            $shippingMethod->value = $request->value;
            $shippingMethod->save();
            DB::commit();
            return redirect()->back()->with(['success' => 'تم التحديث بنجاح.']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'حدث خطأ أثناء حفظ التعديلات.']);
        }
    }
}
