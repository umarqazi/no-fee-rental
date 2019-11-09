<html>
    <head>
        <title>Realty Listings Imported</title>
    </head>
    <body>
        <h2>Dear {{ $data->agent->first_name }}</h2>
        <p>{{ $data->message }}</p>
        <p><a href="{{ $data->url }}">Click here</a></p>
    </body>
</html>
