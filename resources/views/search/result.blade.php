@extends('master')
@section('title', 'Recherche')
@section('content')

<br>
    <div class="container mt-5">

        <div class="table">
            <table class="table table-bordered ">
                <thead>
                  <tr>
                    <th class="numeric">#</th>
                    <th class="numeric">Tickets</th>
                    <th class="numeric">Status </th>
                    <th class="numeric">Date </th>


                  </tr>
                </thead>
                @foreach($result as $ticket )
                @if($ticket->user_id == Auth::id())
                <tbody>
                  <tr >
                    <td > {{ $ticket->id }} </td>
                      <td class="numeric"> {{ $ticket->description }} </td>
                      <td class="numeric"> {{ $ticket->etats }}</td>
                      <td class="numeric"> {{ $ticket->created_at }}</td>

                  </tr>

                </tbody>
                @endif
                @endforeach
              </table>

        </div>

</div>
    </div>



@endsection
