<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;
use App\Book;

class PostPublished extends Notification
{
    use Queueable;

    public function __construct()
    {

    }

    public function via($notifiable)
    {
        return [TelegramChannel::class];

    }

    public function toTelegram($order)
    {
        return TelegramMessage::create()
            ->to('152308042')
            ->content($order->name ."'\n'". $order->phone."'\n'". $order->book_id ."'\n'". $order->sum.".0 euro '\n'" . $order->comment."'\n'". $order->created_at );
    }
}
