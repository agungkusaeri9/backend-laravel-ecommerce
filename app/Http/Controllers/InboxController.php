<?php

namespace App\Http\Controllers;

use App\Inbox;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function store()
    {
        request()->validate([
            'name' => ['required'],
            'email' => ['required','email'],
            'text' => ['required']
        ]);
        $data = request()->all();
        $inboxes = Inbox::whereDate('created_at','=',Carbon::now()->translatedFormat('Y-m-d'))->count();
        if($inboxes > 20)
        {
            return redirect()->route('home')->with('error','Pesan tidak terkirim, dikarenakan sudah melebihi batas');
        }else{
            Inbox::create($data);
            return redirect()->route('home')->with('success','Terimakasi sudah menghubungi kami.');
        }
    }
}
