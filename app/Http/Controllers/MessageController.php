<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Mail\Message;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\User;
use App\Notifications\AdminNotifications;
use Illuminate\Notifications\Notifiable;


class MessageController extends Controller
{
    use Notifiable;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $messages = Message::paginate(5);
        return view('messages_customer', array('messages' => $messages));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function messageForm()
    {
        $user = Auth::user();
        $email = $user->email;

        return view('messages_form', array('email' => $email));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function messageSent(Request $request)
    {
        $message = New Message();

        $message->email = request('email');
        $message->message = request('message');
        $message->save();

        return redirect()->route('messages_customer');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminIndex()
    {
        $messages = Message::paginate(5);

        return view('admin_messages_page', array('messages' => $messages));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminAnswerForm($id)
    {
        $message = Message::find($id);
        return view('admin_answer_form', ['message' => $message]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminAnswerSend(Request $request, $id)
    {
        $to = Message::find($id);
        Mail::send([$request->answer => 'view'], ['name' => 'test'], function ($m) use ($to) {
            $m->to($to->email, 'user')->subject('Answer');
            $m->from('admin@laravel.com', 'Laravel Site');
        });
        return redirect()->back()->with('success', 'Answer Was Sent');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function notificationIndex()
    {
        return view('notification_form');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function notificationStore(Request $request)
    {
        $notification = $request->notification;
        \Notification::send(User::all(), new AdminNotifications($notification));
        return redirect()->back()->with('success', 'Notification Was Added');
    }

}
