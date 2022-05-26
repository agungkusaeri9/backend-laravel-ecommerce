<?php

namespace App\View\Components;

use App\Notification;
use Illuminate\View\Component;

class Topbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $notifications_count = Notification::where('status',0)->count();
        $notifications = Notification::with('user')->where('status',0)->latest()->take($notifications_count)->get();
        return view('admin.templates.partials.topbar',[
            'notifications' => $notifications,
            'notifications_count' => $notifications_count
        ]);
    }
}
