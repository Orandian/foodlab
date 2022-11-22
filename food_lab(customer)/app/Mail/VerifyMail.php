<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class VerifyMail extends Mailable
{
    use Queueable, SerializesModels;
    private $mail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        Log::channel('customerlog')->info('VerifyMail Mail', [
            'start __construct'
        ]);

        $this->mail = $data;

        Log::channel('customerlog')->info('VerifyMail Mail', [
            'end __construct'
        ]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Log::channel('customerlog')->info('VerifyMail Mail', [
            'start build'
        ]);

        Log::channel('customerlog')->info('VerifyMail Mail', [
            'end build'
        ]);

        return $this->subject('Verify Mail')
            ->view('customer.access.verify')
            ->with([
                'name' => $this->mail['name'],
                'siteName' => $this->mail['siteName'],
                'link' => $this->mail['verifyLink']
            ]);
    }
}
