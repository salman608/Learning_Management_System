<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function AdminAllCoupon()
    {
        $coupon = Coupon::latest()->get();
        return view('admin.backend.coupon.all_coupon', compact('coupon'));
    }

    public function AdminAddCoupon()
    {
        return view('admin.backend.coupon.add_coupon');
    } //end'

    public function AdminStoreCoupon(Request $request)
    {
        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => "Coupon Insert Successfully!",
            'alert-type' => "success"
        );
        return redirect()->route('admin.all.coupon')->with($notification);
    } //End

    public function AdminEditCoupon($id)
    {
        $coupon = Coupon::find($id);
        return view('admin.backend.coupon.edit_coupon', compact('coupon'));
    } //End

    public function AdminUpdateCoupon(Request $request)
    {

        $coupon_id = $request->id;
        Coupon::find($coupon_id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => "Coupon Updated Successfully!",
            'alert-type' => "success"
        );
        return redirect()->route('admin.all.coupon')->with($notification);
    } //End

    public function AdminDeleteCoupon($id)
    {
        Coupon::find($id)->delete();
        $notification = array(
            'message' => "Coupon Deleted Successfully!",
            'alert-type' => "success"
        );
        return redirect()->back()->with($notification);
    }
}
