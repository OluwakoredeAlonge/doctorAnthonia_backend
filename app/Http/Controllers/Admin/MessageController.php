<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class MessageController extends Controller
{
    public function markRead(ContactMessage $message)
    {
        $message->update(['status' => 'read']);
        return response()->json(['success' => true]);
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return response()->json(['success' => true]);
    }
}
