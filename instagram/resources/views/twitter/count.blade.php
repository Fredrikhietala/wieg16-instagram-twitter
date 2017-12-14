<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Twitter</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

</head>
<body>

    <div class="content">
        <div class="title m-b-md">
            Sök efter ord
        </div>
        <form action="{{ action('TwitterController@tweetForm') }}" method="get">
            {{ csrf_field() }}
            <input type="text" name="search" id="search" value="" placeholder="Sök..">
            <input type="submit" name="submit" value="submit">
        </form>
        <table>
            <tr>
                <th>Words</th>
                <th>Count</th>
            </tr>
            @foreach($tweets as $tweet=> $value)
                <tr>
                    <td>{{ $tweet }}</td>
                    <td>{{ $value }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
