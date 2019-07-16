<?php

/**
 * @param $image
 * @param $path
 * @param bool $unlinkOld
 * @param null $old_image
 *
 * @return string
 */
function uploadImage($image, $path, $unlinkOld = false, $old_image = null) {
	$name = time() . '.' . $image->getClientOriginalExtension();
	if (!File::isDirectory($path)) {
		File::makeDirectory($path, 0777, true, true);
	}
	Storage::disk('public')->putFileAs($path, $image, $name);
	$full_image_name = $path . '/' . $name;
	(!$unlinkOld) ?: removeFile($old_image);
	return $full_image_name;
}

/**
 * @param $files
 * @param $path
 *
 * @return array
 */
function uploadMultiImages($files, $path) {
	$paths = [];
	foreach ($files as $file) {
		$name = uploadImage($file, $path);
		array_push($paths, $name);
	}
	return $paths;
}

/**
 * @param $path
 *
 * @return bool
 */
function removeFile($path) {
	return @unlink('storage/'.$path ?? '');
}

/**
 * @return mixed
 */
function isAdmin() {
	return auth()->guard('admin')->check();
}

/**
 * @return mixed
 */
function isAgent() {
	return auth()->guard('agent')->check();
}

/**
 * @return int|null
 */
function myId() {
	return auth()->id();
}

/**
 * @return \Illuminate\Contracts\Auth\Authenticatable|null
 */
function mySelf(){
	return auth()->user();
}

/**
 * @param $to
 * @param $data
 *
 * @return mixed
 */
function mailService($to, $data) {
	return \Illuminate\Support\Facades\Mail::to($to)->send(new App\Mail\MailHandler($data));
}

/**
 * @param $msg
 *
 * @return \Illuminate\Http\RedirectResponse
 */
function error($msg) {
	return redirect()->back()->with(['message' => $msg, 'alert_type' => 'error']);
}

/**
 * @param $msg
 * @param null $path
 *
 * @return \Illuminate\Http\RedirectResponse
 */
function success($msg, $path = null) {
	return ($path != null)
	? redirect($path)->with(['message' => $msg, 'alert_type' => 'success'])
	: redirect()->back()->with(['message' => $msg, 'alert_type' => 'success']);
}

/**
 * @param $message
 * @param $type
 *
 * @return string
 */
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

/**
 * @param $data
 *
 * @return object
 */
function toObject($data) {
	return (object) $data;
}

/**
 * @param null $data
 * @param bool $readable
 *
 * @return array|mixed
 */
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