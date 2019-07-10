<?php

use Illuminate\Support\Facades\Mail;

// Use to Upload Images
function uploadImage($image, $path, $unlinkOld = false) {
	$name = time() . '.' . $image->getClientOriginalExtension();
	if (!File::isDirectory($path)) {
		File::makeDirectory($path, 0777, true, true);
	}
	Storage::disk('public')->putFileAs($path, $image, $name);
	$full_image_name = $path . '/' . $name;
	return $full_image_name;
}

function removeFile($path) {
	return unlink(public_path($path ?? ''));
}

function uploadMultiImages($files, $path) {
	$paths = [];

	foreach ($files as $file) {
		$name = uploadImage($file, $path);
		array_push($paths, $name);
	}

	return $paths;
}

function isAdmin() {
	return auth()->guard('admin')->check();
}

function isAgent() {
	return auth()->guard('agent')->check();
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
	return (object) $data;
}

function features($data = null, $readable = false) {
	$build = [];
	$config = config('constants');
	$features = $config['features'];

	if ($data == null) {
		return $features;
	}

	$keys = array_keys($config['listing_types']);
	foreach ($data as $value) {
		$index = $value->property_type - 1;
		$key = $keys[$index];
		if ($readable) {
			$feature = $features[$key][$value->value - 1];
			$key = str_replace('_', ' ', ucfirst($key));
			$build[$key][] = $feature;
		} else {
			$build[$key][] = $value->value;
		}
	}

	return $build;
}