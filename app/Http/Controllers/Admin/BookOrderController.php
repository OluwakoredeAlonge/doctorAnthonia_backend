<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookOrder;

class BookOrderController extends Controller
{
    public function confirm(BookOrder $order)
    {
        $order->confirm();
        return response()->json(['status' => 'confirmed']);
    }

    public function reject(BookOrder $order)
    {
        $order->reject();
        return response()->json(['status' => 'rejected']);
    }

    public function destroy(BookOrder $order)
    {
        $order->delete();
        return response()->json(['success' => true]);
    }
}
