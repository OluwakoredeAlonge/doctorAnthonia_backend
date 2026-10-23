<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookCouponController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'code'             => 'nullable|string|max:50|unique:book_coupons,code',
            'discount_percent' => 'required|in:25,50,100',
            'book_id'          => 'nullable|exists:books,id',
            'assigned_to'      => 'nullable|string|max:255',
            'max_uses'         => 'required|integer|min:1|max:9999',
            'expires_at'       => 'nullable|date|after:today',
        ]);

        // Auto-generate a code if not provided
        if (empty($data['code'])) {
            do {
                $data['code'] = strtoupper(Str::random(8));
            } while (BookCoupon::where('code', $data['code'])->exists());
        } else {
            $data['code'] = strtoupper($data['code']);
        }

        BookCoupon::create($data);

        return redirect()->route('admin.dashboard', ['panel' => 'coupons'])
            ->with('success', 'Coupon '.$data['code'].' created.');
    }

    public function toggle(BookCoupon $coupon)
    {
        $coupon->update(['is_active' => !$coupon->is_active]);
        return response()->json(['active' => $coupon->fresh()->is_active]);
    }

    public function destroy(BookCoupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.dashboard', ['panel' => 'coupons'])
            ->with('success', 'Coupon deleted.');
    }
}
