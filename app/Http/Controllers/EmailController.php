<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarEmail;

class EmailController extends Controller
{
    public function enviarEmail()
    {
        $variavel = 'Variavel';

        return Mail::to('emnedel@inf.ufsm.br')->send(new EnviarEmail($variavel));
    }
}
