<!DOCTYPE html>
<html>
<head>
    <title>Rapport des Transactions</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Rapport des Transactions</h1>
        <p>Généré le {{ date('d/m/Y') }}</p>
    </div>

    <table>
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
</body>
</html>
