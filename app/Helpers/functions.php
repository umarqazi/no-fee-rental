<?php

use Illuminate\Support\Facades\Mail;

// Use to Upload Images
function uploadImage($image, $path, $unlinkOld = false, $file = null) {

	if ($unlinkOld) {
		@unlink(public_path(file_exists($path) ? $path . '/' . $file : ''));
	}

	$name = time() . '.' . $image->getClientOriginalExtension();
	$image->move($path, $name);
	return $name;
}

function uploadMultiImages($files, $path) {
	$paths = [];

	foreach ($files as $file) {
		$name = time() . '.' . $file->getClientOriginalExtension();
		array_push($paths, $name);
		$file->move($path, $name);
	}

	return $paths;
}

// Use to send emails
function mailService($to, $data) {
	return Mail::to($to)->send(new App\Mail\MailHandler($data));
}

// Use to handle common errors
function error($msg) {
	return redirect()->back()->with(['message' => $msg, 'alert_type' => 'error']);
}

function success($msg, $path = null) {
	return ($path != null)
	? redirect($path)->with(['message' => $msg, 'alert_type' => 'success'])
	: redirect()->back()->with(['message' => $msg, 'alert_type' => 'success']);
}

function toast($message, $type) {
	$select = null;
	switch ($type) {
	case 'success':
		$select = "success";
		break;

	case 'error':
		$select = "error";
		break;
	}
	return "<script>toastr.{$select}('{$message}');</script>";
}

function toObject($data) {
	return json_decode(json_encode($data));
}