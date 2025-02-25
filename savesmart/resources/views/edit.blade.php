@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier la Transaction</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transactions.update', $transaction) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Form fields for title, amount, and date (pre-filled with current values) -->
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
