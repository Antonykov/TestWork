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
    <h1>Display a list of courses</h1>
    <table>
        <th>№</th><th>Course name</th>
        @foreach ($courses as $key => $course)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $course['fullname'] }}</td>
            </tr>
        @endforeach
    </table>
</div>
</body>
</html>
