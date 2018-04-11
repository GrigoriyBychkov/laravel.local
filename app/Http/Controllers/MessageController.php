<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Mail\Message;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Mail;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::paginate(5);
        return view('messages_customer', array('messages' => $messages));
    }

    public function messageForm()
    {
        $user = Auth::user();
        $email = $user->email;

        return view('messages_form', array('email' => $email));
    }

    public function messageSent(Request $request)
    {
        $message = New Message();

        $message->email = request('email');
        $message->message = request('message');
        $message->save();

        return redirect()->route('messages_customer');
    }

    public function adminIndex()
    {
        $messages = Message::paginate(5);

        return view('admin_messages_page', array('messages' => $messages));
    }

    public function adminAnswerForm($id)
    {
        $message = Message::find($id);
        return view('admin_answer_form', ['message' => $message]);
    }

    public function adminAnswerSend(Request $request, $id)
    {
        $to = Message::find($id);
        Mail::send([$request->answer => 'view'], ['name' => 'test'], function ($m) use ($to) {
            $m->to($to->email, 'user')->subject('Answer');
            $m->from('admin@laravel.com', 'Laravel Site');
        });
        return redirect()->back()->with('success', 'Answer Was Sent');
    }
}
