<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mosások</title>
</head>
<body>
    <p>mosások</p>
    <table>
        <tr>
            <td>Username</td>
            <td>Start</td>
            <td>End</td>
            <td>Comment</td>
        </tr>
        @foreach ($laundries as $laundry)
            <tr>
                <td>{{ $laundry->username }}</td>
                <td>{{ $laundry->from }}</td>
                <td>{{ $laundry->to }}</td>
                <td>{{ $laundry->comment }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>