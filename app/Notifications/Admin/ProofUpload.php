<?php

namespace App\Notifications\Admin;

use App\Store;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramFile;
use NotificationChannels\Telegram\TelegramMessage;

class ProofUpload extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    public function toTelegram($notifiable)
    {
        $store = Store::first();
        $trx_id = $notifiable->id;
        $detail = route('admin.transactions.show', $trx_id);
        $total = 'Rp. ' .  number_format($notifiable->transaction_total);
        return TelegramFile::create()
            // Optional recipient user id.
            ->to($store->group_chatId)
            // Markdown supported.
            ->content("*Bukti Pembayaran telah diupload*\n\nUUID : $notifiable->uuid\nNama : $notifiable->name\nNo Hp : $notifiable->phone_number\nAlamat : $notifiable->address\nJumlah : $total\nMetode Pembayaran : $notifiable->payment\nKurir : $notifiable->courier")
            ->file('storage/' . $notifiable->proof_of_payment, 'photo')
            ->button('Detail', $detail);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
