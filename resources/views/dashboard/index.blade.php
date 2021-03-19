@extends('master')
@section('title', 'Dashboard')

@section('content')

    <div class="container mt-5">
            <br/>
            @if(Session::has('message'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{Session::get('message')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
@endif
            <h1>Liste des nouveaux tickets ({{ count($tickets) }})</h1>

            <div class="table">
                <table class="table table-bordered ">
                    <thead>
                      <tr>
                        <th class="numeric">#</th>
                        <th class="numeric">Tickets</th>
                        <th class="numeric">Responsable</th>
                        <th class="numeric">Status </th>

                        <th class="numeric">Actions</th>

                      </tr>
                    </thead>
                    @foreach($tickets as $ticket )
                    <tbody>
                      <tr >
                        <td > {{ $ticket->id }} </td>
                          <td class="numeric"> {{ $ticket->description }} </td>
                          <td class="numeric"> {{ $ticket->user->name }}</td>
                          <td class="numeric"> {{ $ticket->etats }}</td>

                          <td>
                          <input id="check" value="{{ $ticket->id }}" onclick="addToAttribuete()" name="check" type="checkbox" class="numeric"/>
                          </td>
                      </tr>

                    </tbody>
                    @endforeach
                  </table>
                  <button id="btn" type="button" class="btn btn-sm btn-success" onclick="selected()" data-bs-toggle="modal" data-bs-target="#agentModal" disabled>Attribuer</button>

            </div>

    </div>

    <div class="modal fade" id="agentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Liste des agents</h5>
              <button type="button" class="btn btn-dark" data-bs-dismiss="modal" aria-label="Close">
                <span  aria-hidden="true">X</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action={{ url('/attribuer') }}>
                    @csrf
                <input type="hidden" name="ids" id="selected">
                <input type="hidden" name="user_id" id="user_id">
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>Noms</th>
                            <th>Email</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach($agents as $agent)
                        <tr>
                            <td>{{ $agent->name }}</td>
                            <td>{{ $agent->email }}</td>

                            <td class="text-center" title="Attribuer"><button type="submit" onclick="selectUser({{ $agent->id }})" class="text-center btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                              </svg></button></td>
                        </tr>
                        @endforeach

                    </tbody>
              </table>
            </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>

            </div>
          </div>
        </div>
      </div>

<script>
    let data;
    function showDialog(){
        $("#agentModal").show();
    }

    function selected(){
        document.getElementById("selected").value=data;
    }

    function selectUser(param){
        document.getElementById('user_id').value=param;
    }

    function addToAttribuete() {
         data = [...document.querySelectorAll('#check:checked')].map(e => e.value);
        let btn  = document.getElementById('btn');
        if(data != null ? data.length>0:false){
            btn.disabled=false;
            console.log(data);
        }else{
            btn.disabled =true;
        }

    }

</script>


@endsection
