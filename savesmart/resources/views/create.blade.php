@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter une Transaction</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        <!-- Form fields for title, type, amount, and date -->
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
