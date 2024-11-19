<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webklex\PHPIMAP\Client;
class TicketController extends Controller
{
    public function loadMailForm(){
        return view('mail_form');
    }
}
