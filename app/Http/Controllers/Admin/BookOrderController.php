<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookOrder;

class BookOrderController extends Controller
{
    public function index()
    {
        $orders = BookOrder::with('book')->latest()->get();
        return redirect()->route('admin.dashboard', ['panel' => 'orders'])
            ->with('orders', $orders);
    }

    public function markPaid(BookOrder $order)
    {
        $order->update(['payment_status' => 'paid']);
        return response()->json(['success' => true]);
    }

    public function destroy(BookOrder $order)
    {
        $order->delete();
        return response()->json(['success' => true]);
    }
}
