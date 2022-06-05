<?php

namespace App\Mail\Admin;

use App\Store;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdateTransaction extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $store = Store::first();
        return $this->from($store->email)
        ->subject('Update Transaksi')
        ->view('user.email.update-transaction')
        ->with(
         [
             'data' => $this->data,
             'store' => $store
         ]);
    }
}
