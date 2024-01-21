<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function AdminAllCoupon()
    {
        $coupon = Coupon::latest()->get();
        return view('admin.backend.coupon.all_coupon', compact('coupon'));
    }
}
