<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function dialog(Request $request, $id)
    {
        $contact = User::findOrFail($id);
        $messages = Message::query()->more(Auth::user()->id, $id, false, 10)->reverse();
        return view('dialog', [
            'contact' => $contact,
            'messages' => $messages
        ]);
    }

    public function index(Request $request) {
        if($q = $request->get('q')) {
            $users = User::latest()->search($q)->get();
        } else {
            $users = User::latest()->limit(10)->get();
        }
        return view('index', [
            'users' => $users
        ]);
    }

    public function load(Request $request, $id) {
        return Message::query()->more(Auth::user()->id, $id, $request->post('message_id'));
    }
}
