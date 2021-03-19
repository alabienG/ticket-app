@extends('master')

@section('title', 'Utilisateur')

@section('content')
    <div class="container mt-5">
        <form class="mt-5" method="POST" action={{ url('utilisateur') }}>
        @csrf
            <div class="mt-5 row">
                <div class="mt-2 form-group">
                    <label for="name">Name</label>
                    <input id="name" class="form-control" type="text" name="name">
                </div>

                <div class="mt-2 form-group">
                    <label for="email">Email</label>
                    <input id="email" class="form-control" type="email" name="email">
                </div>


            </div>
            <button type="submit" class="mt-2 btn btn-sm btn-success">Enregistrer</button>


        </form>
    </div>
@endsection
