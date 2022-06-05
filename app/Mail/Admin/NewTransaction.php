<?php

namespace App\Mail\Admin;

use App\Store;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewTransaction extends Mailable
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
        ->subject('Transaksi Baru')
        ->view('admin.email.new-transaction')
        ->with(
         [
             'data' => $this->data,
         ]);
    }
}
