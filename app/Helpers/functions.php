<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

// Use to Upload Images
function uploadImage($image, $path) {
	$name = time() . '.' . $image->getClientOriginalExtension();
	if (!File::isDirectory($path)) {
		File::makeDirectory($path, 0777, true, true);
	}
	Storage::disk('public')->putFileAs($path, $image, $name);
	$full_image_name = $path . '/' . $name;
	return $full_image_name;
}

// Use to send emails
function mailService($to, $data) {
	return Mail::to($to)->send(new App\Mail\MailHandler($data));
}

// Use to handle common errors
function error($msg) {
	return redirect()->back()->with(['message' => $msg, 'alert_type' => 'error']);
}

function success($msg) {
	return redirect()->back()->with(['message' => $msg, 'alert_type' => 'success']);
}