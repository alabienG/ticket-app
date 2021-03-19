@extends('master')
@section('title', 'Roles')
@section('content')

    <div class="container mt-5">
        @if(Session::has('message'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{Session::get('message')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
@endif
        <br>
        <div class="row">
            <div class="col-10">
                <h3>Liste des roles de l'agent : <strong>{{ $user->name }}</strong></h3>
            </div>

            <div class="col">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createRole">Nouveau role</button>
            </div>
        </div>

        <div class="row mt-5">
            @foreach($roles as $role)
                <div class="form-group">
                    {{-- <input type="checkbox" value={{ $role->id }}  > --}}
                    <input  {{ $role->exist ? "checked" : '' }} onclick="attribuer()" id="check" type="checkbox" value={{ $role->id }}>
                    <label for="role">{{ $role->libelle }}
                </div>
            @endforeach
        </div>
        <form method="POST" action="{{ route('role-user') }}">
            @csrf
        <input type="hidden" id="selected" name="ids">
        <input type="hidden" id="user_id" name="user_id" value={{ $user->id }}>
        <button id="btn" type="submit" class="mt-4 btn btn-sm btn-success" onclick="selected()" disabled>Terminer</button>
    </form>

    </div>


    <div class="modal fade" id="createRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ajouter un rôle</h5>
              <button type="button" class="btn btn-dark" data-bs-dismiss="modal" aria-label="Close">
                <span  aria-hidden="true">X</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action={{ url('/roles') }}>
                    @csrf
                    <input type="hidden" value={{ $user->id }} name="user_id">
                    <div class="form-group">
                        <label for="libelle">Libelle</label>
                        <input type="text" id="libelle" required name="libelle" class="form-control">
                    </div>


                    <button type="submit" class="mt-4 btn btn-sm btn-success">Enregistrer</button>

            </form>
            </div>

          </div>
        </div>
      </div>

    <script>
 function attribuer(){
        data = [...document.querySelectorAll('#check:checked')].map(e => e.value);
        let btn  = document.getElementById('btn');
        if(data != null ? data.length>0:false){
            btn.disabled=false;
            document.getElementById("selected").value=data;
        }else{
            btn.disabled =true;
        }
            }

function selected(){
        document.getElementById("selected").value=data;
    }

    </script>
@endsection
