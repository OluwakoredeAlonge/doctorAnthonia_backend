<?php

namespace App\Http\Controllers;

use App\Models\BookOrder;
use App\Models\SiteSetting;

class BookOrderStatusController extends Controller
{
    public function show(BookOrder $order)
    {
        $order->load('book');
        $bankSettings = SiteSetting::bulk([
            'books_bank_name', 'books_bank_number',
            'books_account_name', 'books_payment_note',
        ]);

        return view('book-order-status', compact('order', 'bankSettings'));
    }

    public function claimPaid(BookOrder $order)
    {
        if ($order->payment_status !== 'pending') {
            return redirect()->route('books.order.show', $order->payment_reference);
        }

        $order->markPaidClaimed();

        return redirect()->route('books.order.show', $order->payment_reference)
            ->with('claimed', true);
    }
}
