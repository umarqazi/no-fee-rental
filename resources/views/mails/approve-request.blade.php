<html>
    <head>
        <title>Request Approved</title>
    </head>

    <body>
        <h2>Dear:</h2><span>{{ $data->name }}</span>
        <h3>{{ $data->approved_on }} to your listing approved.</h3>
        <h3>Your request for listing has been approved by {{ $data->approved_by }}.</h3>
    </body>
</html>