<!DOCTYPE html>
<html>
<head>
	<title>User Created</title>
</head>
<body>
	<h2>Dear {{$data->first_name}}</h2>
	<p>Your account was Succesfully Created on no fee rental.<br>
	use this link below to login your account.
	{{ $data->link }}
</p>
</body>
</html>