<!DOCTYPE html>
<html>
<head>
	<title>New Message Received</title>
	<style type="text/css">
		h2{
			margin: 0px !important;
		}
	</style>
</head>
<body>
	<p>Hi! someone posted a query.<br />
	Here is the details</p>

	<table>
		<tr>
			<td><h2>Name:</h2></td>
			<td><span>{{ $data->first_name.' '.$data->last_name }}</span></td>
		</tr>
		<tr>
			<td><h2>Email:</h2></td>
			<td><span>{{ $data->email }}</span></td>
		</tr>
		<tr>
			<td><h2>Phone:</h2></td>
			<td><span>{{ $data->phone_number }}</span></td>
		</tr>
		<tr>
			<td><h2>Message:</h2></td>
			<td><span>{{ $data->comment }}</span></td>
		</tr>
	</table>




</body>
</html>