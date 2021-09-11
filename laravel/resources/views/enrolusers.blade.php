<!DOCTYPE html>
<html>
<head>
    <title>Moodle</title>
    <style>
        table {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            border-spacing: 0;
        }
        td {
            padding: 5px;
        }
        tr.two:nth-child(odd) {
            background: lightgray;
        }
        tr.two:nth-child(even) {
            background: white;
        }
        .number {
            width: 20px;
            text-align: center;
            border-right: 2px solid white;
        }
        .name {
            width: 200px;
            text-align: left;
        }
        .grade {
            width: 40px;
            text-align: center;
        }
        .testname {
            width: 150px;
            text-align: left;
        }
    </style>
</head>
<body>
<div>
    <h1>Display a list of users</h1>

    <table>
        <tr>
            <td class="number">№</td>
            <td width="205px">User name</td>
            <td width="200px">Course name</td>
            <td width="150px">Test name</td>
            <td width="20px">Grade</td>
        </tr>
    </table>
    <table>
        @foreach ($enroleusers as $key => $enroleuser)
            <tr class="two">
                <td class="number">{{ $key + 1 }}</td>
                <td class="name">{{ $enroleuser['firstname'] }} {{ $enroleuser['lastname'] }}</td>
                <td>
                    <table>
                        @foreach ($enroleuser['courses'] as $key2 => $courses)
                        <tr>
                            <td class="name">{{ $courses['fullname'] }}</td>
                            <td>
                                <table>
                                    @foreach ($courses['grade'] as $key3 => $grade)
                                    <tr>
                                        <td class="testname">{{ $grade['name'] }}</td>
                                        <td class="grade">{{ $grade['grade'] }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        @endforeach
    </table>

</div>
</body>
</html>
