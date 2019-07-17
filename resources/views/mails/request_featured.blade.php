<!DOCTYPE html>
<html>
<head>
	<title>Approved Featured</title>
</head>
<body>
	<h2>Dear: {{ $data->name }}</h2>
	<h3>Your request for featured has been approved on {{ $data->approved_on }} by {{ $data->approved_by }}</h3>
</body>
</html>