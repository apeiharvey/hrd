<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvitationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $data;
    protected $content;
    public $template;
    public function __construct($data,$content,$template)
    {
        $this->data['applicant'] = $data;
        $this->data['content'] = $content;
        $this->data['template'] = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(auth()->user()->email)->subject($this->data['template'])->view('admin.pages.mail',$this->data);
    }
}
