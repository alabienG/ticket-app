<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // recupération des données du formulaire
       $description = $request['description'];
       //recuperation du user

       $user = User::all()->first();
       //création de l'objet ticket
       $ticket = new Ticket();
       $ticket->description = $description;
       $ticket->user_id = $user->id;
       //enregistrement du ticket
       $ticket->date_debut_traitement = now();
       $ticket->save();

       return redirect(route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request){
        if($request->search != null){
            $result =Ticket::where('description',"like","%".$request->search."%")
            ->orwhere('id', "like", "%".$request->search."%")
            ->orwhere('etats', "like", "%".$request->search."%")
           // ->orwhere('date_debut_traitement', "like", "%".$request->search."%")
            ->where('user_id', Auth::id())
            ->get();
            if($result != null ? count($result)>0:false){
            return view('search.result', compact('result'));
        }
        }
        return back()->with("message", "Aucun résultat pour cette recherche");
    }
}
