<?php

use App\Jobs\SaveSearchMatchJob;
use App\Services\NotificationService;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Bus\PendingDispatch;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * @param $image
 * @param $path
 * @param bool $unlinkOld
 * @param null $old_image
 *
 * @return string|bool
 */
function uploadImage( $image, $path, $unlinkOld = false, $old_image = null ) {
    if(config('app.env') == PRODUCTION) {
        $image = \App\Services\AWS3Service::getInstance()->upload($path, $image);
        (!$unlinkOld) ?: \App\Services\AWS3Service::getInstance()->delete($old_image);
        return $image;
    } else {
        $name = str_random( 20 ) . '.' . $image->getClientOriginalExtension();
        if(makeDir($path)) {
            makeFile($path, $image, $name);
            $full_image_name = 'storage/' . $path . '/' . $name;
            ( ! $unlinkOld ) ?: removeFile( $old_image );
            return $full_image_name;
        }

        return false;
    }
}

/**
 * @param $key
 * @return mixed
 */
function admin($key) {
    $admin = (new \App\Services\UserService())->findByEmail(config('mail.admin.email'));
    return $admin->{$key};
}

/**
 * @param $notifications
 * @param bool $unreadCount
 * @return bool|int
 */
function hasNewNotification($notifications, $unreadCount = false) {
    $count = 0;
    foreach ($notifications as $notification) {
        if(!$unreadCount) {

            if($notification->is_read === 0) return true;

        } elseif ($notification->is_read === 0) {

            $count ++;

        }
    }

    return $count > 0 ? $count : false;
}

/**
 * @param $image_name
 * @return string
 */
function readImage($image_name) {
    return \App\Services\AWS3Service::getInstance()->read($image_name);
}

/**
 * @param $request
 * @param $collection
 * @param $paginate
 * @return \Illuminate\Pagination\LengthAwarePaginator
 */
function customPaginator($request, $collection, $paginate) {
    $per_page = $paginate;
    $current_page = $request->page ?? 1;
    $starting_point = ($current_page * $per_page) - $per_page;
    $items = collect(array_slice($collection, $starting_point, $per_page, true));
    $paginated = new \Illuminate\Pagination\LengthAwarePaginator($items->values(), count($collection), $paginate, $current_page, [
        'path' => $request->url(),
        'query' => $request->query(),
    ]);

    return $paginated;
}

/**
 * @param $total
 * @param $perPage
 * @return string|null
 */
function pagination($total, $perPage) {
    $html = null;
    $active = false;
    $current = $_GET['page'] ?? null;
    if($current === null) $active = true;
    $total = ceil($total / $perPage);
    if($total <= 1) return null;
    $html .= '<ul class="pagination" role="navigation">';
    for($i = 1; $i <= $total; $i ++) {
        $url = url()->current().'?page='.$i;
        $html .= "<li class='page-item ";
        $html .= $i == $current || $active ? 'active' : '';
        $html .= "'><a class=\"page-link\" href=\"{$url}\">{$i}</a></li>";
        $active = false;
    }
    $html .= '</ul>';
    return $html;
}

/**
 * @return Repository|mixed
 */
function mailToAdmin() {
    $admin = (new \App\Services\UserService())
        ->first(['email' => config('mail.from.address')])
        ->first();

    return $admin->id ?? null;
}

/**
 * @param $type
 * @return string
 */
function userTypeString($type) {
    switch ($type) {
        case ADMIN:
            return 'Admin';
            break;
        case OWNER:
            return 'Owner';
            break;
        case AGENT:
            return 'Agent';
            break;
        case RENTER:
            return 'Renter';
            break;
    }
}

/**
 * @param $data
 * @return mixed
 */
function sendViaSupport($data) {
    $credentials = [
        'email' => config('mail.support.username'),
        'password' => config('mail.support.password'),
    ];
    new \App\Services\MailService($credentials);
    return dispatchMail($data->toEmail, $data);
}

/**
 * @param $data
 * @return mixed
 */
function sendViaInfo($data) {
    $credentials = [
        'email' => config('mail.info.username'),
        'password' => config('mail.info.password'),
    ];

    new \App\Services\MailService($credentials);
    return dispatchMail($data->toEmail, $data);
}

/**
 * @param $path
 * @param $data
 * @param $name
 *
 * @return mixed
 */
function makeFile($path, $data, $name) {
    return Storage::disk( 'public' )->putFileAs( $path, $data, $name );
}

/**
 * @param $path
 *
 * @return bool
 */
function makeDir($path) {
    if ( ! File::isDirectory( $path ) ) {
        File::makeDirectory( $path, 0777, true, true );
    }

    return true;
}

/**
 * @param $files
 * @param $path
 *
 * @return array
 */
function uploadMultiImages( $files, $path ) {
    $paths = [];
    foreach ( $files as $file ) {
        array_push( $paths, uploadImage( $file, $path ) );
    }

    return $paths;
}

/**
 * @param $path
 *
 * @return bool
 */
function removeFile( $path ) {
    return @unlink( $path ?? '' );
}

/**
 * @return bool
 */
function whoAmI() {
    $guards = array_keys( config( 'auth.guards' ) );
    foreach ( $guards as $guard ) {
        if ( Auth::guard( $guard )->check() ) {
            return $guard;
        }
    }

    return 'web';
}

/**
 * @param $id
 * @return bool|mixed
 */
function isOwnerListing($id = null) {
    $user = false;
    if($id != null) {
        $user = (new \App\Services\UserService())->findById($id);
        return $user->user_type === OWNER;
    }

    return $user;
}

/**
 * @return mixed
 */
function authenticated() {
    return Auth::guard( whoAmI() )->check();
}

/**
 * @return mixed
 */
function isAdmin() {
    return auth()->guard( 'admin' )->check();
}

/**
 * @return mixed
 */
function isAgent() {
    return auth()->guard( 'agent' )->check();
}

/**
 * @return mixed
 */
function isRenter() {
    return auth()->guard( 'renter' )->check();
}

/**
 * @return mixed
 */
function isOwner() {
    return auth()->guard( 'owner' )->check();
}

/**
 * @param null $id
 * @return mixed
 */
function isMRGAgent($id = null) {
    return (new \App\Services\UserService())->agentsWithMRGCompany($id);
}

/**
 * @param $id
 * @return mixed
 */
function findUserById($id) {
    return (new \App\Services\UserService())->findById($id);
}

/**
 * @param $favourites
 * @param $listing_id
 *
 * @return bool
 */
function isFavourite( $favourites, $listing_id ) {
    foreach ( $favourites as $key => $fav ) {
        if ( $fav->pivot->user_id == myId() && $fav->pivot->listing_id == $listing_id ) {
            return true;
        }
    }

    return false;
}

/**
 * @return int|null
 */
function myId() {
    return ( authenticated() ) ? mySelf()->id : null;
}

/**
 * @return Authenticatable|null
 */
function mySelf() {
    return auth()->guard( whoAmI() )->user();
}

/**
 * @param $date
 *
 * @return mixed
 */
function dateReadable( $date ) {

    if ( $date instanceof Carbon ) {
        return $date->diffForHumans();
    }

    return \Carbon\Carbon::createFromTimestamp( strtotime( $date ) )->diffForHumans();
}

/**
 * @param $date
 *
 * @return mixed
 */
function daysReadable( $date ) {
    return $difference = str_formatting($date->diffInDays(now()), 'Day');
}

/**
 * @param $date
 *
 * @return mixed
 */
function daysNumReadable( $date ) {
    return $difference = $date->diffInDays(now());
}

/**
 * @param $string
 *
 * @return Carbon
 */
function carbon( $string ) {
    return new Carbon( $string );
}

/**
 * @param $date
 * @param bool $hasTime
 * @return string
 */
function genericDateFormat($date, $hasTime = false) {
    $date = \DateTime::createFromFormat($hasTime ? 'm/d/Y h:i a' : 'm/d/Y', $date);
    return $date->format($hasTime ? 'Y-m-d h:i:s' : 'Y-m-d');
}

///**
// * @param $string
// * @return bool|string
// */
//function calendarDate($string) {
//
//    if(strpos($string, 'pm')) {
//        return genericFormat(str_replace(' pm', '', $string), true);
//    }
//        return genericFormat(str_replace(' am', '', $string), true);
//}

/**
 * @param $date
 * @param $format
 *
 * @return false|string
 */
function formattedDate( $format, $date ) {
    return date( $format, strtotime( $date ) );
}

/**
 * @return bool|mixed
 */
function dispatchPlanExpiryCheckListener() {
    return (new \App\Services\CreditPlanService())->listenForExpiry();
}

/**
 * @return bool|mixed
 */
function addNewList() {
    return (new \App\Services\CreditPlanService())->addSlot();
}

/**
 * @return bool
 */
function isAgentHasPlan() {
    return (new \App\Services\CreditPlanService())->agentHasPlan();
}

/**
 * @param $plan
 * @return string
 */
function currentPlan($plan) {
    if($plan == BASICPLAN) {
        return 'Basic Plan';
    } else if ($plan == GOLDPLAN) {
        return 'Gold Plan';
    } else {
        return 'Platinum Plan';
    }
}

/**
 * @param $plan
 * @return string
 */
function planEnum($plan) {
    if($plan === BASICPLAN) {
        return 'basic';
    } else if ($plan === GOLDPLAN) {
        return 'gold';
    } else {
        return 'platinum';
    }
}

/**
 * @param $currentPlan
 * @return mixed
 */
function billingCycle($currentPlan) {
    return $currentPlan->updated_at->addDays(MAXPLANDAYS)->format('d-m-Y h:m a');
}

/**
 * @param $to
 * @param $data
 *
 * @return mixed
 */
function dispatchMail( $to, $data ) {
    return \Illuminate\Support\Facades\Mail::to( $to )->send( new App\Mail\MailHandler( $data ) );
}

/**
 * @param $data
 *
 * @return bool
 */
function dispatchNotification( $data ) {
    return ( new NotificationService() )->setter($data)->send();
}

/**
 * @param $data
 * @param int $delay
 *
 * @return PendingDispatch
 */
function dispatchListingNotification( $data, $delay = 0 ) {
    return dispatch( new SaveSearchMatchJob( $data ) )->delay( now()->addSeconds( $delay ) );
}

/**
 * @param $data
 * @param int $delay
 * @return PendingDispatch
 */
function dispatchEmailQueue( $data, $delay = 0 ) {
    return dispatch_now( new \App\Jobs\SendEmailJob( $data ) );
}

/**
 * @param $command
 */
function artisan( $command ) {
    $commands = is_array( $command ) ? $command : collect( $command )->toArray();
    foreach ( $commands as $command ) {
        \Illuminate\Support\Facades\Artisan::call( $command );
    }
}

/**
 * @param $msg
 * @param null $path
 *
 * @return RedirectResponse
 */
function error( $msg, $path = null ) {
    return ( $path == null )
        ? redirect()->back()->with( [ 'message' => $msg, 'alert_type' => 'error' ] )
        : redirect( $path )->with( [ 'message' => $msg, 'alert_type' => 'error' ] );
}

/**
 * @param $msg
 * @param null $data
 * @param bool $status
 * @param int $code
 *
 * @return JsonResponse
 */
function json( $msg, $data = null, $status = true, $code = 200 ) {
    return response()->json( [ 'msg' => $msg, 'data' => $data, 'status' => $status ], $code );
}

/**
 * @param $msg
 * @param null $path
 *
 * @return RedirectResponse
 */
function success( $msg, $path = null ) {
    return ( $path == null )
        ? redirect()->back()->with( [ 'message' => $msg, 'alert_type' => 'success' ] )
        : redirect( $path )->with( [ 'message' => $msg, 'alert_type' => 'success' ] );
}

/**
 * @param $request
 * @param null $data
 * @param null $msg
 * @param null $path
 * @param null $errorMsg
 * @param int $code
 *
 * @return JsonResponse|RedirectResponse
 */
function sendResponse( $request, $data = null, $msg = null, $path = null, $errorMsg = null, $code = 200 ) {
    if ( $request->ajax() ) {
        return ( $data )
            ? json( $msg, $data, true, $code )
            : json( $errorMsg ?? 'Something went wrong', null, false, 500 );
    } else {
        return ( $data )
            ? success( $msg, $path )
            : error( $errorMsg ?? 'Something went wrong' );
    }
}

/**
 * @param $message
 * @param $type
 *
 * @return string
 */
function toast( $message, $type ) {
    return "<script>toastr.{$type}('{$message}');</script>";
}

/**
 * @param $message
 * @return mixed
 */
function bootstrapAlertDanger($message) {
    return "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            {$message}
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
}

/**
 * @param $data
 *
 * @return object
 */
function toObject( $data ) {
    return (object) $data;
}

/**
 * @param $image
 * @return mixed
 */
function is_realty_listing($image) {
    return strpos($image, 'http') !== false ? $image : Storage::url($image ?? DLI);
}

/**
 * @param $data
 *
 * @return mixed
 * @throws Exception
 */
function dataTable( $data ) {
    return datatables()->of( $data )->toJson();
}

/**
 * @param $neighborhoods
 *
 * @return string
 */
function neighborhoodExpertise( $neighborhoods ) {
    $collect = [];
    foreach ( $neighborhoods as $neighbours ) {
        $collect[] = $neighbours->name;
    }

    return ( count( $collect ) > 0 ) ? implode( ', ', $collect ) : 'None';
}

/**
 * @param $index
 *
 * @return mixed|null
 */
function openHouseTimeSlot( $index ) {
    $slots = config( 'openHouse' );
    return (new Carbon( $slots[ $index ] ))->format('h:i:s a') ?? null;
}

/**
 * @param $date
 * @return false|int|string
 */
function reverseTimeSlot( $date ) {
    $formatted = carbon($date)->format('H:i a');
    return array_search($formatted, config('openHouse'));
}

/**
 * @param $openHouse
 * @return bool
 */
function isOpenToday($openHouse) {
    return carbon(genericDateFormat($openHouse->date))->format('m-d-Y') >= now()->format('m-d-Y')
        && daysNumReadable(carbon(genericDateFormat($openHouse->date))) < 8;
}

/**
 * @return string|null
 */
function bedsDropDown() {
    $html = null;
    $html = '<ul>
                <li> <input type="checkbox" value="0.5" id="Checkbox-ad-search" name="beds[]">
                    <label for="Checkbox-ad-search"><span class="label-name">Studio</span></label>
                </li>
                <li> <input type="checkbox" value="1" id="Checkbox-1-ad-search" name="beds[]">
                    <label for="Checkbox-1-ad-search"><span class="label-name">1</span></label>
                </li>
                <li> <input type="checkbox" value="2" id="Checkbox-2-ad-search" name="beds[]">
                    <label for="Checkbox-2-ad-search"><span class="label-name">2</span></label>
                </li>
                <li> <input type="checkbox" value="3" id="Checkbox-3-ad-search" name="beds[]">
                    <label for="Checkbox-3-ad-search"><span class="label-name">3</span></label>
                </li>
                <li> <input type="checkbox" value="4" id="Checkbox-4-ad-search" name="beds[]">
                    <label for="Checkbox-4-ad-search"><span class="label-name">4</span></label>
                </li>
                <li> <input type="checkbox" value="5" id="Checkbox-5-ad-search" name="beds[]">
                    <label for="Checkbox-5-ad-search"><span class="label-name">5 +</span></label>
                </li>
            </ul>';

    return $html;
}

/**
 * @param $selected
 * @return string|null
 */
function simple_neighborhood_select($selected = null) {
    $html = null;
    $boroughs = (new \App\Services\BoroughService())->get();
    foreach ($boroughs as $borough) {
        $html .= "<optgroup label='{$borough->boro}'>";
        foreach ($borough->neighborhoods as $neighborhood) {
            $html .= "<option value='{$neighborhood->name}' id='";
            $html .= str_replace(' ', '', $neighborhood->name)."'";
            $html .= $selected !== null ? (in_array($neighborhood->name, is_array($selected) ? $selected : (array)$selected) ? 'selected="selected">' : '>') : '>';
            $html .= "{$neighborhood->name}</option>";
        }

        $html .= "</optgroup>";
    }

    return $html;
}

/**
 * @param null $bool
 * @param null $param
 * @return string
 */
function multi_or_single_neighborhood_selector($bool = null, $param = null) {
    $html = null;
    $script = null;
    $rand_class = str_random(20);
    if(isset($bool)) {

        if($bool === true){
            $html .= '<select class="input-style neighborhood-select-search ASN '.$rand_class.'" name="neighborhood[]" multiple="multiple">';
            $script .= fSelect($rand_class);
        } else {
            $html .= '<select class="input-style neighborhood-select-search ASN '.$rand_class.'" name="neighborhood"><option value="">Select Neighborhood</option>';
            $script .= select2($rand_class);
        }

    } else {
        $html .= '<select class="input-style neighborhood-select-search ASN '.$rand_class.'" name="neighborhood[]" multiple="multiple">';
        $script .= fSelect($rand_class);
    }
        $html .= simple_neighborhood_select($param ?? null);
        $html .= '</select>';

        return $html.$script;
}

/**
 * @param $class
 * @return string|null
 */
function fSelect($class) {
    $html = null;
    $html .= "<script>
        $('.{$class}').fSelect({
            placeholder: 'Select Neighborhoods',
            overflowText: 'Neighborhoods ({n})',
            searchText: 'Search',
            numDisplayed: 1,
        });
    </script>";

    return $html;
}

/**
 * @param $class
 * @return string|null
 */
function select2($class) {
    $html = null;
    $html .= "<script>
        $('.{$class}').select2();
    </script>";

    return $html;
}

/**
 * @param int $amount
 * @param null $pre_select
 * @return string|null
 */
function multi_select_beds($amount = 5, $pre_select = null) {
    $html = null;
    $id = str_random(10);
    $html .= "<ul id=\"advance-search-beds\">";
    $html .= "<li";
    $html .= is_array($pre_select) && in_array('studio', $pre_select) ? " class='white-border-chkbox'>" : '>';
    $html .= Form::checkbox('beds[]', '0.5', is_array($pre_select) && in_array('0.5', $pre_select) ? "checked='checked'" : '', ['id' => $id]);
    $html .= "<label for=\"{$id}\"><span class=\"label-name\">Studio</span></label></li>";
    for ($i = 1; $i <= $amount; $i ++) {
        $id = str_random(10);
        $html .= "<li";
        $html .= is_array($pre_select) && in_array($i, $pre_select) ? " class='white-border-chkbox'>" : '>';
        $html .= Form::checkbox('beds[]', $i, is_array($pre_select) && in_array($i, $pre_select) ? "checked='checked'" : '', ['id' => $id]);
        $html .= "<label for=\"{$id}\"><span class=\"label-name\">";
        $html .= $i == 5 ? $i.' +' : $i;
        $html .= "</span></label></li>";
    }

    return $html;
}

/**
 * @param int $amount
 * @param null $pre_select
 * @return string|null
 */
function multi_select_baths($amount = 5, $pre_select = null) {
    $html = null;
    $id = str_random(10);
    $html .= "<ul id=\"advance-search-baths\">";
    $html .= "<li";
    $html .= is_array($pre_select) && in_array('any', $pre_select) ? " class='white-border-chkbox'>" : '>';
    $html .= Form::checkbox('baths[]', 'any', is_array($pre_select) && in_array('any', $pre_select) ? "checked='checked'" : '', ['id' => $id]);
    $html .= "<label for=\"{$id}\"><span class=\"label-name\">Any</span></label></li>";
    for ($i = 1; $i <= $amount; $i ++) {
        $id = str_random(10);
        $html .= "<li";
        $html .= is_array($pre_select) && in_array($i, $pre_select) ? " class='white-border-chkbox'>" : '>';
        $html .= Form::checkbox('baths[]', $i, is_array($pre_select) && in_array($i, $pre_select) ? "checked='checked'" : '', ['id' => $id]);
        $html .= "<label for=\"{$id}\"><span class=\"label-name\">";
        $html .= $i == 5 ? $i.' +' : $i;
        $html .= "</span></label></li>";
    }

    return $html;
}

/**
 * @param null $array
 * @return string|null
 */
function filter_neighborhood_select($array = null) {
    $html = null;
    $html .= "<div class=\"neighborhood-border-no\">";
    $boroughs = (new \App\Services\BoroughService())->get();
    foreach ($boroughs as $borough) {
        $html .= "<h3>{$borough->boro}</h3><div class=\"border - bottom - h3\"></div><ul class='neighborhood-list'>";
        foreach ($borough->neighborhoods as $key => $neighborhood) {
            $id = str_random(10);
            $html .= "<li><div class=\"custom-control custom-checkbox custom-control-inline\">";
            $html .= Form::checkbox('neighborhood[]', $neighborhood->name,
                $array !== null ? (in_array($neighborhood->name, $array) ? true : false) : false,
                ['class' => 'custom-control-input', 'id' => $id]);
            $html .= "<label class=\"custom-control-label\" for=\"{$id}\">{$neighborhood->name}</label></div></li>";
        }

        $html .= "</ul>";
    }

    $html .= "</div>";

    return $html;
}

function neighborhood_let_us_help() {
    $tabs = null;
    $content = null;
    $tabs .= "<ul class=\"nav nav-pills\">";
    $content .= "<div class=\"tab-content\">";
    $boroughs = (new \App\Services\BoroughService())->get();
    foreach ($boroughs as $key => $borough) {
        $i = 1;
        $hasOpen = false;
        $hasContent = false;
        $tab_id = str_random(16);
        $total = count($borough->neighborhoods);
        $perColum = ceil($total / 3);
        $tabs .= "<li class=\"nav-item\">";
        $tabs .= "<a class='nav-link";
        $tabs .= $key == 0 ? " active'" : "'";
        $tabs .= " data-toggle=\"pill\" href=\"#tab-{$tab_id}\">{$borough->boro}</a></li>";
        foreach ($borough->neighborhoods as $key2 => $neighborhood) {
            $i ++;
            $hasContent = true;
            $id = str_random(10);
            if($key2 == 0) {
                $content .= "<div class='tab-pane ";
                $content .= $key == 0 ? "active'" : "'";
                $content .= " id=\"tab-{$tab_id}\">";
                $content .= "<div class='row'>";
            }

            if(!$hasOpen) {
                $hasOpen = true;
                $content .= "<div class='col-md-4'><ul class=\"neighborhood-list\">";
            }

            $content .= "<li><div class=\"custom-control custom-checkbox custom-control-inline index-neighborhood\">";
            $content .= Form::checkbox('neighborhood[]', $neighborhood->name, false, ['class' => 'custom-control-input', 'id' => $id]);
            $content .= "<label class=\"custom-control-label\" for=\"{$id}\">{$neighborhood->name}</label></div></li>";

            if($i == $perColum) {
                $i = 1;
                $hasOpen = false;
                $content .= "</ul></div>";
            }
        }

        if($hasOpen) {
            $content .= "</ul></div>";
        }

        if($hasContent) {
            $content .= "</div></div>";
        } else {
            $content .= "<div class='tab-pane'";
            $content .= " id=\"tab-{$tab_id}\">";
            $content .= "<div class='row' style='display: block;'>";
            $content .= "<h5 style='padding: 10px;color:black;' class='text-center'>No Neighborhood Exist in {$borough->boro}</h5>";
            $content .= "</div></div>";
        }
    }

    $tabs .= "</ul>";
    $content .= "</div>";

    return $tabs.$content;
}

/**
 * @return string
 */
function neighborhood_site_map() {
    $tabs = null;
    $content = null;
    $tabs .= "<ul class=\"nav nav-pills\">";
    $content .= "<div class=\"tab-content\">";
    $boroughs = (new \App\Services\BoroughService())->get();
    foreach ($boroughs as $key => $borough) {
        $i = 1;
        $hasOpen = false;
        $hasContent = false;
        $tab_id = str_random(16);
        $total = count($borough->neighborhoods);
        $perColum = ceil($total / 3);
        $tabs .= "<li class=\"nav-item\">";
        $tabs .= "<a class='nav-link";
        $tabs .= $key == 0 ? " active'" : "'";
        $tabs .= " data-toggle=\"pill\" href=\"#tab-{$tab_id}\">{$borough->boro}</a></li>";
        foreach ($borough->neighborhoods as $key2 => $neighborhood) {
            $i ++;
            $hasContent = true;
            $id = str_random(10);
            if($key2 == 0) {
                $content .= "<div class='tab-pane ";
                $content .= $key == 0 ? "active'" : "'";
                $content .= " id=\"tab-{$tab_id}\">";
                $content .= "<div class='row'>";
            }

            if(!$hasOpen) {
                $hasOpen = true;
                $content .= "<div class='col-md-4 col-sm-4'><ul class=\"neighborhood-list\">";
            }

            $content .= "<li>";
            $content .= "<a href='/listings-by-neighborhood?neighborhood=".$neighborhood->name."'>";
            $content .= "<label class=\"\" for=\"{$id}\">{$neighborhood->name}</label></a></li>";

            if($i == $perColum) {
                $i = 1;
                $hasOpen = false;
                $content .= "</ul></div>";
            }
        }

        if($hasOpen) {
            $content .= "</ul></div>";
        }

        if($hasContent) {
            $content .= "</div></div>";
        } else {
            $content .= "<div class='tab-pane'";
            $content .= " id=\"tab-{$tab_id}\">";
            $content .= "<div class='row' style='display: block;'>";
            $content .= "<h5 style='padding: 10px;color:black;' class='text-center'>No Neighborhood Exist in {$borough->boro}</h5>";
            $content .= "</div></div>";
        }
    }

    $tabs .= "</ul>";
    $content .= "</div>";

    return $tabs.$content;

}

/**
 * @param $params
 * @return string|null
 */
function panel_listing_filters($params) {
    $html = null;
    $sorting = config('formfields.sorting');
    $html .= '<div class="sort-bt"><i class="fa fa-sort-amount-down"></i>';
    $html .= '<div class="custom-dropdown"><ul><li>';
    foreach ($sorting as $key => $sort) {
        $html .= '<li><a href="';
        $html .= route(whoAmI().'.sorting', $key);
        $html .= sprintf('">%s</a></li>', $sort);
    }

    $html .= '</ul></div><span>Sort By</span></div>';
    $html .= Form::open(['url' => route(whoAmI().'.listingSearch'), 'class' => 'search', 'method' => 'get']);
    $html .= Form::number('bedrooms', $params['bedrooms'] ?? null, ['class' => 'filter-input', 'placeholder' => 'All Beds', 'autocomplete' => 'off']);
    $html .= Form::number('baths', $params['baths'] ?? null, ['class' => 'filter-input', 'placeholder' => 'All Baths', 'autocomplete' => 'off']);
    $html .= Form::button('Filter', ['class' => 'btn-default', 'type' => 'submit']);
    $html .= Form::close();

    return $html;
}

/**
 * @return string|null
 */
function features_pet() {
    $html = null;
    $pets = (new \App\Services\PetPolicyService())->get();
    $html .= "<div class='col-md-12' style='margin-top: 10px;'>";
    $html .= "<h3>Pet Policy</h3><div class='row'><div class='col-md-4'>";
    foreach ($pets as $type => $pet) {
        $id = str_random(10);
        $html .= "<ul class='checkbox-listing'><li><div class='custom-control custom-checkbox'>";
        $html .= Form::checkbox( "pets[]", $pet->id, null,
            [
                'class' => "custom-control-input pets-{$type}",
                'id'    => "listitem-{$id}"
            ]);
        $html .= "<label class='custom-control-label' for='listitem-{$id}'>{$pet->name}</label></div></li></ul>";
    }

    $html .= "</div></div></div>";

    $html .= "<script>
        let row = $('.row');
        $(() => {
            if($('.pets-2').is(':checked')) {
                p3(true);
            }

            if($('.pets-3').is(':checked')) {
                p4(true);
            }
        });

        function p3(action) {
            row.find('.pets-0, .pets-1, .pets-3').prop('checked', false);
            row.find('.pets-0, .pets-1').prop('disabled', action);
        }

        function p4(action) {
            row.find('.pets-0, .pets-1, .pets-2').prop('checked', false);
            row.find('.pets-0, .pets-1').prop('disabled', action);
        }

        $('.pets-3, .pets-2').change(function() {
            let val = $(this).val();
            if (val === '3') {
                p3($(this).is(':checked'));
            }

            if (val === '4') {
                p4($(this).is(':checked'));
            }
        });</script>";

    return $html;
}

/**
 * @return string|null
 */
function features() {
    $i = 0; $html = null; $open =false;
    $features   = (new \App\Services\FeatureService())->get();
    $total      = $features->count();
    $per_column = ceil($total / 3);
    $html .= "<div class='col-md-12' style='margin-top: 10px;'>"; // Main div Start
    $html .= "<h3>Unit Feature</h3>";
    $html .= "<div class='row'>"; // Row Start
    foreach ( $features as $type => $feature ) {

        if($i == 0) {
            $open = true;
            $html .= "<div class='col-md-4'><ul class='checkbox-listing'>";
        }

        $i ++;
        $id = str_random(10);
        $html .= "<li><div class='custom-control custom-checkbox'>";
        $html .= Form::checkbox( "features[]", $feature->id, null,
                    [
                        'class' => 'custom-control-input',
                        'id'    => "listitem-{$id}"
                    ]);
        $html .= "<label class='custom-control-label' for='listitem-{$id}'>{$feature->name}</label></div></li>";

        if($i == $per_column) {
            $open = false;
            $i = 0; $html .= "</ul></div>";
        }
    }

    if($open) {
        $html .= "</ul></div>"; // Optional
    }

    $html .= "</div>"; // Row Close
    $html .= "</div>"; // Main div Close

    return $html;
}

/**
 * @return string
 */
function buildingfeatures() {
    $i = 0; $html = null; $open = false;
    $html .= '<div class="col-md-12" style="margin-top: 10px;">'; // Main div start
    $html .= '<h3>Building Features</h3>';
    $html .= '<div class="row">'; // Row Start
    $service = new \App\Services\AmenityService();
    $amenities = $service->get();
    $total = $amenities->count();
    $perColumn = ceil($total / 3);
    foreach ($amenities as $key => $amenity ) {

        if($i == 0) {
            $open = true;
            $html .= '<div class="col-sm-4">';
        }

        $i ++;
        $id = str_random(10);
        $html .= '<ul class="checkbox-listing"><li><div class="custom-control custom-checkbox">';
        $html .= Form::checkbox( 'amenities[]', $amenity->id, null, [
            'class' => 'custom-control-input',
            'id'    => $id
        ] );
        $html .= '<label class="custom-control-label" for="' . $id . '">' . $amenity->amenities . '</label></div></li></ul>';

        if ( $perColumn == $i ) {
            $open = false;
            $i = 0; $html .= '</div>';
        }
    }

    if($open) {
        $html .= '</div>'; // Optional
    }

    $html .= '</div>'; // Row end
    $html .= '</div>'; // Main div end

    return $html;
}

/**
 * @param $listing
 * @param bool $map_location
 * @return string|null
 */
function property_thumbs($listing, $map_location = false) {
    $html = null;
    $html .= "<div class='property-thumb'><div class='check-btn'>";
    if($map_location) $html .= "<input type='hidden' name='map_location' value='{$listing->map_location}'>";
    $html .= "<a href='javascript:void(0);'>";
//    $html .= "<button class='btn-default' list_id='{$listing->id}' to='{$listing->agent->id}' data-target=\"#check-availability\">Check Availability</button>";
    $html .= "</a></div>";

    if(!authenticated()) {
        $html .= "<span class='display-heart-icon'></span>";
    }

    if(isRenter()) {
        if(isFavourite($listing["favourites"],$listing->id)) {
            $html .= "<span id ='{$listing->id}' class='heart-icon favourite'></span>";
        } else {
            $html .= "<span id ='{$listing->id}' class='heart-icon'></span>";
        }
    }

    $html .= "<img src='".is_realty_listing($listing->thumbnail)."' alt='' class='main-img'>";
    $html .= "<div class='info'><div class='info-link-text'>";
    $html .= "<p>$ ".number_format($listing->rent)." / month&nbsp;&nbsp;</p>";
    $html .= "<small> (";
    $html .= $listing->bedrooms < 1 ? 'Studio' : $listing->bedrooms .' bd';
    $html .= ", ".$listing->baths.' ba'.")</small>";
    $html .= "<p>";
    $html .= is_exclusive($listing).", ";
    $html .= $listing->neighborhood ? $listing->neighborhood->name : null;
    $html .= "</p></div>";
    $html .= "<a href='".route('listing.detail', $listing->id)."' class='btn viewfeature-btn'> View </a></div>";
    $html .= "<div class='feaure-policy-text'>";
    $html .= "<p>$ ".number_format($listing->rent)." / month </p>";
    $html .= "<span> ";
    $html .= $listing->bedrooms < 1 ? 'Studio' : str_formatting($listing->bedrooms, 'bed');
    $html .= ", ".str_formatting($listing->baths, 'bath')." </span></div></div>";
    return $html;
}

/**
 * @param null $id
 *
 * @return mixed
 */
function neighborhoods($id = null) {
    $service = new \App\Services\NeighborhoodService();
    if($id !== null) {
        return $service->findById($id)->name;
    }

    $neighborhoods[''] = 'Select Neighborhood';
    foreach ( $service->getAll()->sortBy('name') as $key => $value ) {
        $neighborhoods[ $value->id ] = $value->name;
    }

    return $neighborhoods;
}

/**
 * @return array
 */
function firstNeighborhood() {
    $neighborhood = (new \App\Services\NeighborhoodService())->first();
    $neighborhood = $neighborhood->name;
    return compact('neighborhood');
}

/**
 * @return array
 */
function owners() {
    $data       = ( new \App\Services\UserService() )->owners();
    $owners[''] = "Select Owner";
    foreach ( $data as $owner ) {
        $owners[ $owner->id ] = sprintf( "%s %s", $owner->first_name, $owner->last_name );
    }

    return $owners;
}

/**
 * @return array
 */
function renters() {
    $data       = ( new \App\Services\UserService() )->renters();
    $renters[''] = "Type Email or Name";
    foreach ( $data as $renter ) {
        $renters[ $renter->id ] = sprintf( "%s ( %s %s )", $renter->email, $renter->first_name, $renter->last_name );
    }

    return $renters;
}

/**
 * @param null $id
 *
 * @return array|null
 */
function agents($id = null) {
    $agents = null;
    $service = new \App\Services\UserService();

    if($id !== null) {
        return $service->edit($id);
    }

    $agents = ['' => 'Select Representative'];
    $records = $service->agents();
    foreach ($records as $agent) {
        $agents[$agent->id] = $agent->first_name.' '.$agent->last_name;
    }

    return $agents;
}

/**
 * @param $data
 * @param bool $update
 * @param null $id
 * @param null $model
 * @return mixed
 */
function calendarEvent( $data, $update = false, $id = null, $model = null ) {
    $calendar = ( new \App\Services\CalendarService() );
    return !$update ? $calendar->addEvent($data) : $calendar->updateEvent($id, $model, $data);
}

/**
 * @param $id
 * @param $model
 * @return bool|mixed
 */
function deleteCalendarEvent( $id, $model ) {
    return ( new \App\Services\CalendarService() )->removeEvent( $id, $model );
}

/**
 * @param $date
 * @return string
 */
function color($date) {
    $event = $date->format('Y-m-d');
    $current = now()->format('Y-m-d');
    if($event > $current) {
        // future green
        return '#53b951';
    } elseif ($event == $current) {
        // current orange
        return '#e77818';
    } elseif ($event < $current) {
        // past grey
        return '#cecccc';
    } else {
        // rejected red
        return '#d41349';
    }

    return 'blue';
}

/**
 * @param $listing
 *
 * @return string
 */
function is_exclusive( $listing ) {
    if ( $listing !== null ) {
        if ( $listing->listing_type === EXCLUSIVE ) {
            $listing->street_address = str_replace('\\', '', $listing->street_address);
            return sprintf( "%s - %s", $listing->street_address, $listing->unit ?? '#' );
        }

        return $listing->display_address;
    }

    return 'N/A';
}

/**
 * @param $date
 * @return bool
 */
function is_available($date) {
    if($date == null) {
        return false;
    }

    return $date <= now()->format('Y-m-d');
}

/**
 * @param $listing_id
 *
 * @return listing_detail
 */
function listing_detail( $id ) {
    return ( new \App\Services\FeatureListingService() )->detail( $id );
}

/**
 * @param $string
 * @param $phrase
 *
 * @return string
 */
function str_formatting( $string, $phrase ) {
    if($string < 1) return 'Studio';
    $string = floatval(preg_replace('/[^\d.]/', '', $string));
    return number_format($string) . ' ' . ( $string > 1 ? $phrase . 's' : $phrase );
}

/**
 * @param $value
 * @return int
 */
function toValidPrice($value) {
    return intval(preg_replace('/[^\d.]/', '', $value));
}

/**
 * @param $id
 *
 * @return mixed
 */
function getMembers( $id ) {
    return ( new \App\Services\MemberService )->team( $id );
}
