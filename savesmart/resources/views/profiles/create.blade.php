@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer un Nouveau Profil</h1>

    <form method="POST" action="{{ route('profiles.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Nom du Profil :</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Créer</button>
    </form>
</div>
@endsection
