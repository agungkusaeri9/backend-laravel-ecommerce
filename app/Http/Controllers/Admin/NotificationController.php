<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function update()
    {
        request()->validate([
            'id' => ['required']
        ]);

        $item = Notification::find(request('id'));
        $item->status = 1;
        $item->save();

        return response()->json(['success' => 'Pemberitahuan berhasil dilihat']);
    }
}
