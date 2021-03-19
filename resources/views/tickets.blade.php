@extends('master')

@section( 'content')
<br>
<div class="container mt-5">
    @if(Session::has('message'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{Session::get('message')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
@endif
@if(Session::has('succes'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{Session::get('succes')}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<h1 class="mt-2"> Mes tickets </h1>
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

                <td class="text-center">
                    <form method="POST" action="{{ route('update-ticket',['id'=>$ticket->id, 'statut'=>'Encours']) }}">
                        @csrf
                        @if($ticket->etats =="Attribuer")
                    <button type="submit" class="btn btn-sm btn-success" title="Commencer"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-skip-start-btn" viewBox="0 0 16 16">
                        <path d="M9.71 5.093a.5.5 0 0 1 .79.407v5a.5.5 0 0 1-.79.407L7 8.972V10.5a.5.5 0 0 1-1 0v-5a.5.5 0 0 1 1 0v1.528l2.71-1.935z"/>
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                      </svg></button>
                      @endif
                    </form>


                    <form method="POST" action="{{ route('update-ticket',['id'=>$ticket->id, 'statut'=>'Terminer']) }}">
                    @csrf
                     @if($ticket->etats=="Encours")
                    <button  type="submit" class="btn btn-sm btn-info" title="Terminer"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stop-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M5 6.5A1.5 1.5 0 0 1 6.5 5h3A1.5 1.5 0 0 1 11 6.5v3A1.5 1.5 0 0 1 9.5 11h-3A1.5 1.5 0 0 1 5 9.5v-3z"/>
                      </svg></button>
                      @endif
                    </form>

                      <form method="POST" action="{{ route('update-ticket',['id'=>$ticket->id, 'statut'=>'Annuler']) }}">
                        @csrf
                        @if($ticket->etats != "Terminer")
                    <button type="submit" class="btn btn-sm btn-danger" title="Annuler">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16">
                            <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1L1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                          </svg>
                    </button>
                    @endif
                      </form>

                </td>
          </tr>

        </tbody>
        @endforeach
      </table>

</div>
</div>

<script>
 l = {!!  json_encode($tickets) !!}
 console.log(l);
    </script>
@endsection
