<?php

namespace App\Http\Controllers;

use App\Role;
use App\RoleUser;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = User::all();
       // dd($agents);
        return view('admin.utilisateurs.index', compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.utilisateurs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

        public function attribuer(Request $request){
            $userid = $request->user_id;
            $ids = $request->ids;
            $tickets_id = array();
            $ids = str_replace(",", "", $ids);
            $tickets_id = str_split($ids);

            for($i =0; $i<count($tickets_id); $i++){
                $ticket = Ticket::find($tickets_id[$i]);
                if($ticket != null){
                    $ticket->user_id = $userid;
                    $ticket->etats="Attribuer";
                    $ticket->update();
                }
            }
        return redirect()->route('dashboard');
        }

    public function store(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $pass = $this->getPassword();
        $user->password =Hash::make($pass);
        $user->save();
        $agents = User::all();
        Log::info("Email : $user->email - Password $pass");
        file_put_contents("log.txt", "\n l'utilisateur $user->id a comme mot de passe $pass", FILE_APPEND);
        $roles = Role::all();
        return view('admin.utilisateurs.roles', compact("user", "roles"));

    }

    public function getRoles($id){
        $user = User::find($id);
        $roles = Role::all();
        if($roles != null){
            foreach($roles as $role){
                $role_user = RoleUser::where('user_id', $user->id)->where('role_id', $role->id)->get();
                if($role_user != null ? count($role_user)>0:false){
                    $role->exist = true;
                }
            }
        }
        return view('admin.utilisateurs.roles', compact("user", "roles"));
    }
    public function createRole(Request $request){
            $libelle = $request->libelle;
            $role = new Role();
            $role->libelle = $libelle;
            $role->save();
            return $this->getRoles($request->user_id);
    }


    public function affecter(Request $request){
            $userid = $request->user_id;
            $ids = $request->ids;
            $roles_id = array();
            $ids = str_replace(",", "", $ids);
            $roles_id = str_split($ids);
        DB::beginTransaction();
        try{
            $roles = RoleUser::where('user_id', $userid)->get();
            foreach($roles as $role){
                $role->delete();

            }

            // on enregistre les nouveaux roles
            for($i =0; $i<count($roles_id); $i++){
                $role = new RoleUser();
                $role->user_id = $userid;
                $role->role_id = $roles_id[$i];
                $role->save();
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
        }
        return $this->getRoles($userid);

    }

    /**

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
    public function getPassword(){
        $tab=array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u'
        , 'v', 'w', 'x', 'y', 'z');
        $pass = "";
        for($i=0; $i<8; $i++){
            $pass  = $pass .''.$tab[random_int(0, 25)];
        }

        return $pass;
    }
}
