<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnviarEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $variaveis;
    
    public function __construct($variavel)
    {
        $this->variaveis = $variavel;
    }

    public function build()
    {
        return $this->view('emails.mail');
    }
}
