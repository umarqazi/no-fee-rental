<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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
	return @unlink('storage/' . $path ?? '');
}

/**
 * @return bool
 */
function whoAmI() {
	$guards = array_keys(config('auth.guards'));
	foreach ($guards as $guard) {
		if (Auth::guard($guard)->check()) {
			return $guard;
		}
	}

	return 'web';
}

/**
 * @return mixed
 */
function authenticated() {
    return Auth::guard(whoAmI())->check();
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
	return mySelf()->id;
}

/**
 * @return \Illuminate\Contracts\Auth\Authenticatable|null
 */
function mySelf() {
	return auth()->guard(whoAmI())->user();
}

/**
 * @param $date
 *
 * @return mixed
 */
function dateReadable($date) {

	if ($date instanceof Carbon) {
		return $date->diffForHumans();
	}

	return \Carbon\Carbon::createFromTimestamp(strtotime($date))->diffForHumans();
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
 * @param $data
 *
 * @return \App\Services\NotificationService
 */
function notificationService($data) {
    return new \App\Services\NotificationService(toObject($data));
}

/**
 * @param $msg
 *
 * @return \Illuminate\Http\RedirectResponse
 */
function error($msg, $path = null) {
	return ($path == null)
	? redirect()->back()->with(['message' => $msg, 'alert_type' => 'error'])
	: redirect($path)->with(['message' => $msg, 'alert_type' => 'error']);
}

/**
 * @param $msg
 * @param null $data
 * @param bool $status
 * @param int $code
 *
 * @return \Illuminate\Http\JsonResponse
 */
function json($msg, $data = null, $status = true, $code = 200) {
	return response()->json(['msg' => $msg, 'data' => $data, 'status' => $status], $code);
}

/**
 * @param $msg
 * @param null $path
 *
 * @return \Illuminate\Http\RedirectResponse
 */
function success($msg, $path = null) {
	return ($path == null)
	? redirect()->back()->with(['message' => $msg, 'alert_type' => 'success'])
	: redirect($path)->with(['message' => $msg, 'alert_type' => 'success']);
}

/**
 * @param $request
 * @param null $data
 * @param null $msg
 * @param null $path
 * @param null $errorMsg
 *
 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
 */
function sendResponse($request, $data = null, $msg = null, $path = null, $errorMsg = null) {
    if($request->ajax())
        return ($data)
            ? json($msg, $data)
            : json($errorMsg ?? 'Something went wrong', null, false, 500);
    else
        return ($data)
            ? success($msg, $path)
            : error($errorMsg ?? 'Something went wrong');
}

/**
 * @param $message
 * @param $type
 *
 * @return string
 */
function toast($message, $type) {
	return "<script>toastr.{$type}('{$message}');</script>";
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
 * @param $data
 *
 * @return mixed
 * @throws Exception
 */
function dataTable($data) {
	return datatables()->of($data)->toJson();
}

/**
 * @param null $data
 * @param bool $readable
 *
 * @return array|mixed
 */
function features($data = null, $readable = false) {
	$build = [];
	$config = config('features');
	$features = $config['listing_features'];

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
