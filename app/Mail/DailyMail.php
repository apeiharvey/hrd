<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DailyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $today;
    protected $total;
    public function __construct($today,$total)
    {
        $this->data['today_unread'] = $today;
        $this->data['total_unread'] = $total;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@karirkawanlama.com','no-reply')->subject('Notification')->view('admin.pages.dailymail',$this->data);
    }
}
