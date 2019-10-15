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
	$name = str_random(20) . '.' . $image->getClientOriginalExtension();
	if (!File::isDirectory($path)) {
		File::makeDirectory($path, 0777, true, true);
	}
	Storage::disk('public')->putFileAs($path, $image, $name);
	$full_image_name = 'storage/' . $path . '/' . $name;
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
		array_push($paths, uploadImage($file, $path));
	}
	return $paths;
}

/**
 * @param $path
 *
 * @return bool
 */
function removeFile($path) {
	return @unlink($path ?? '');
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
	return (authenticated()) ? mySelf()->id : null;
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
 * @param $date
 * @param $format
 *
 * @return false|string
 */
function formattedDate($format, $date) {
    return date($format, strtotime($date));
}

/**
 * @param $dateAlpha
 * @param $dateBeta
 *
 * @return bool
 */
function compareDates($dateAlpha, $dateBeta) {
    return formattedDate('y/m/d', $dateAlpha) >= formattedDate('y/m/d', $dateBeta);
}

/**
 * @param $to
 * @param $data
 *
 * @return mixed
 */
function dispatchMail($to, $data) {
	return \Illuminate\Support\Facades\Mail::to($to)->send(new App\Mail\MailHandler($data));
}

/**
 * @param $data
 *
 * @return \App\Services\NotificationService
 */
function dispatchNotification($data) {
    return new \App\Services\NotificationService(toObject($data));
}

/**
 * @param $command
 */
function artisan($command) {
    $commands = is_array($command) ? $command : collect($command)->toArray();
    foreach ($commands as $command) {
        \Illuminate\Support\Facades\Artisan::call($command);
    }
}

/**
 * @param $data
 * @param int $delay
 *
 * @return \Illuminate\Foundation\Bus\PendingDispatch
 */
function dispatchEmailQueue($data, $delay = 10) {
    return dispatch(new \App\Jobs\SendEmailJob($data))->delay(now()->addSeconds($delay));
}

/**
 * @param $msg
 * @param null $path
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
 * @param int $code
 *
 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
 */
function sendResponse($request, $data = null, $msg = null, $path = null, $errorMsg = null, $code = 200) {
    if($request->ajax())
        return ($data)
            ? json($msg, $data, true, $code)
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
 * @param null $action
 *
 * @return null
 */
function amenities($action = null) {
    $html = null;
    $service = new \App\Services\AmenityService();
    foreach($service->get() as $amenity) {
        $html .= "<div class='col-md-6'>
        <h3>{$amenity->amenity_type }</h3><ul class='checkbox-listing'>".innerAmenity($amenity, $action)."</ul></div>";
    }

    return $html;
}

/**
 * @param $amenity
 * @param $action
 *
 * @return string|null
 */
function innerAmenity($amenity, $action) {
    $innerHtml = null;
    foreach ( $amenity->amenities as $amenity_value ) {
        $innerHtml .= "
            <li><div class='custom-control custom-checkbox'>" .
                Form::checkbox( "amenities[]", $amenity_value->id, null,
                    [
                        ( $action == 'Update' ) ? 'disabled' : '',
                        'class' => 'custom-control-input',
                        'id'    => "listitem{$amenity_value->id}"
                    ])."<label class='custom-control-label' for='listitem{$amenity_value->id}'>" .
                       $amenity_value->amenities . "</label></div></li>";
    }

    return $innerHtml;
}

/**
 * @return \Illuminate\Support\Collection|\Tightenco\Collect\Support\Collection
 */
function neighborhoods() {
    $collection = null;
    $neighbours = new \App\Services\NeighborhoodService();
    $collection[''] = 'Select Neighborhood';
    foreach ( $neighbours->get() as $key => $value ) {
        $collection[ $value->id ] = $value->name;
    }

    return $collection;
}

function fetchAmenities($amenities) {
    $types = [];
    foreach ($amenities as $amenity) {
        if(in_array($amenity->type->amenity_type, $types)) continue;
        $types[] = $amenity->type->amenity_type;
    }
    $amen = [];
    foreach ($types as $type) {
        $tmp = null;
        foreach ($amenities as $amenity) {
            if($type === $amenity->type->amenity_type) {
                $tmp[$type][] = $amenity->amenities;
            }
        }
        $amen[] = $tmp;
    }
    return $amen;
}

/**
 * @param $data
 *
 * @return mixed
 */
function addCalendarEvent($data) {
    return (new \App\Services\CalendarService())->addEvent(toObject($data));
}

/**
 * @param $listing
 *
 * @return string
 */
function is_exclusive($listing) {
    if($listing->building_type === EXCLUSIVE) {
        return $listing->street_address.' - '.$listing->unit;
    }

    return $listing->display_address;
}

/**
 * @param $string
 * @param $phrase
 *
 * @return string
 */
function str_formatting($string, $phrase) {
    return $string.' '.($string > 1 ? $phrase.'s' : $phrase);
}
