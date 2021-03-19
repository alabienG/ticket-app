<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class FirstController extends Controller
{
    //

    public function firstMethode(){
            return view('first');
    }

    public function getTickets(){

        $tickets = Ticket::where('user_id', Auth::user()->id)->get();
        return view('tickets', compact('tickets'));
    }

    public function setEtatTicket($ticket_id, $statut){

        $ticket = Ticket::find($ticket_id);
        if(Auth::id() == $ticket->user_id){
                // proprietaire du <ticket></ticket>

            $ticket->etats = $statut;
            $ticket->updated_at =now();
            $ticket->update();
            return back()->with('succes', 'Votre ticket a bien été modifier');
        }

        return back()->with('message', 'Le ticket que vous tentez de modifier ne vous est pas attribuer');

    }


}
