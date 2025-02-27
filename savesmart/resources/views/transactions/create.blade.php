@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter une Nouvelle Transaction</h1>

    <form method="POST" action="{{ route('transactions.store') }}">
        @csrf
        <div class="form-group">
            <label for="description">Description :</label>
            <input type="text" name="description" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="amount">Montant (€) :</label>
            <input type="number" name="amount" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="type">Type :</label>
            <select name="type" class="form-control" required>
                <option value="revenu">Revenu</option>
                <option value="dépense">Dépense</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>
</div>
@endsection
