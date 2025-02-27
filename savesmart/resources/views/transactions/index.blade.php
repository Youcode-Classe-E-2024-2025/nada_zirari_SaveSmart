@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Transactions</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('transactions.create') }}" class="btn btn-primary">Ajouter une Transaction</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Description</th>
                <th>Montant</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->description }}</td>
                    <td>{{ $transaction->amount }} €</td>
                    <td>{{ ucfirst($transaction->type) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
