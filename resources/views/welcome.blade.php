@extends('master')

@section('title', 'Accueil')
@section( 'content')


<div class="container mt-5">
    @if(Session::has('message'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{Session::get('message')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
@endif
    <h1>Bienvenue sur notre application de réclamation </h1>
</div>

<div class="row">
<form method="POST" action="{{route('store') }}">
    @csrf
    <div class="form-group">
        <label for="description">Décrivez votre probleme ici</label>
        <textarea class="form-control" name="description" rows="10" cols="3" id="description"></textarea>
        <button type="submit" class="mt-2 btn btn-sm btn-success">Enregistrer</button>
    </div>

</form>

</div>
@endsection
