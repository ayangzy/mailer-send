<?php

namespace App\Mail;

use App\Models\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->view('emails.send-email')
            ->subject($this->email->subject)
            ->from($this->email->from);

        $attachmentsObj = $this->email->attachments;

        foreach ($attachmentsObj as $attachment) {
            foreach (json_decode($attachment['attachment']) as $file) {
                $email->attach(public_path('files/' . $file));
            }
        }

        $this->email->status = Email::SENT;
        $this->email->save();
        return $email;
    }
}
