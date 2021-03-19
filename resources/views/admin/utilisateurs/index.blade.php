@extends('master')
@section('title', 'Utilisateurs')

@section('content')

<div class="container mt-5">
    <br>
    @if(Session::has('message'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{Session::get('message')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
@endif
    <div class="row">
        <div class="mt-5 col-10">
            <h1>Liste des utilisateurs</h1>
        </div>
        <div class="mt-5 col">
            <a href={{ url('utilisateur/create') }} class="btn btn-success">Ajouter un utilisateur</a>
        </div>
    </div>

    <div class="table">
        <table class="table table-bordered ">
                <thead>
                    <th>Noms</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Date de création</th>
                    <th>Action</th>
                </thead>

                <tbody>
                    @foreach($agents as $agent)
                        <tr>
                            <td>{{ $agent->name }}</td>
                            <td>{{ $agent->email }}</td>
                            <td>

                                @if($agent->roles != null ? count($agent->roles)>0:false)
                                    @foreach($agent->roles as $role)
                                    <span class="badge rounded-pill bg-dark"> {{ $role != null ? $role->libelle :'' }}</span>
                                    @endforeach
                                @endif

                            </td>
                            <td>{{ $agent->created_at }}</td>
                            <td class="text-center"><a href="{{ route('roles',$agent->id) }}" class="btn btn-sm btn-success" title="Ajouter un rôle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-plus" viewBox="0 0 16 16">
                                <path d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z"/>
                                <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                              </svg></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

    </div>

</div>

@endsection
