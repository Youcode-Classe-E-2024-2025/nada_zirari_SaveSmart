@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mes Transactions</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('transactions.create') }}" class="btn btn-primary mb-3">Ajouter une Transaction</a>

    <table class="table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Type</th>
                <th>Montant</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->title }}</td>
                    <td>{{ ucfirst($transaction->type) }}</td>
                    <td>{{ $transaction->amount }} €</td>
                    <td>{{ $transaction->date }}</td>
                    <td>
                        <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette transaction ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
