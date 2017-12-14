<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

</head>
<body>

    <div class="content">
        <div class="title m-b-md">
            Tweets
        </div>
        <table>
            <tr>
                <th>Skapad</th>
                <th>Tweet</th>
            </tr>
            @foreach($tweets as $tweet)
                <tr>
                    <td>{{ $tweet->created_at }}</td>
                    <td>{{ $tweet->text }}</td>
                </tr>
            @endforeach
        </table>

    </div>
</body>
</html>
