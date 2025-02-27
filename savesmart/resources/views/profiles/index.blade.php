@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Vos Profils</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <ul>
        @foreach($profiles as $profile)
            <li>
                {{ $profile->name }}
                <a href="{{ route('profile.select', $profile->id) }}" class="btn btn-primary">Sélectionner</a>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('profiles.create') }}" class="btn btn-success">Créer un Nouveau Profil</a>
</div>
@endsection
