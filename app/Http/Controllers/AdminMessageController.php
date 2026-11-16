<?php

namespace App\Http\Controllers;

use App\Models\Message;

class AdminMessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.messages.index', compact('messages'));
    }
}
