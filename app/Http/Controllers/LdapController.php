<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Adldap\Laravel\Facades\Adldap;

class LdapController extends Controller
{
    public function teste()
    {
        $user = Adldap::search()->users();
        dd($user);
    }
}
