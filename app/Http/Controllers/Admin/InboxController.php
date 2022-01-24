<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Inbox;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function index()
    {
        $items = Inbox::latest()->get();
        return view('admin.pages.inbox.index',[
            'title' => 'Pesan Masuk',
            'items' => $items
        ]);
    }

    public function destroy($id)
    {
        Inbox::destroy($id);
        return redirect()->back()->with('success','Pesan Masuk berhasil dihapus');
    }
}
