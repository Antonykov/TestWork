<!DOCTYPE html>
<html>
<head>
    <title>Moodle</title>
    <style>
        table {
            ont-family: Verdana, Arial, Helvetica, sans-serif;
            border-collapse: collapse;
        }
        th {
            border-bottom: 3px solid #B9B29F;
            padding: 10px;
            text-align: left;
        }
        td {
            padding: 10px;
        }
        tr:nth-child(odd) {
            background: white;
        }
        tr:nth-child(even) {
            background: lightgrey;
        }
    </style>
</head>
<body>
<div>
    <h1>List of users</h1>
    <table>
        <th>№</th><th>Name</th>
        @foreach ($users as $key => $user)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $user['firstname'] }} {{ $user['lastname'] }}</td>
            </tr>
        @endforeach
    </table>
</div>
</body>
</html>
