@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard - Profil : {{ $profile->name }}</h1>

    <p><strong>Total Revenus :</strong> {{ $revenus }} €</p>
    <p><strong>Total Dépenses :</strong> {{ $depenses }} €</p>
    <p><strong>Solde :</strong> {{ $revenus - $depenses }} €</p>

    <a href="{{ route('transactions.create') }}" class="btn btn-primary">Ajouter une Transaction</a>
</div>
@endsection
