<?php

use App\Events\TriggerMessage;
use App\Jobs\SaveSearchMatchJob;
use App\Services\NotificationService;
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
 * @return string
 */
function uploadImage( $image, $path, $unlinkOld = false, $old_image = null ) {
    $name = str_random( 20 ) . '.' . $image->getClientOriginalExtension();
    if ( ! File::isDirectory( $path ) ) {
        File::makeDirectory( $path, 0777, true, true );
    }
    Storage::disk( 'public' )->putFileAs( $path, $image, $name );
    $full_image_name = 'storage/' . $path . '/' . $name;
    ( ! $unlinkOld ) ?: removeFile( $old_image );

    return $full_image_name;
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
 * @param $listing_id
 *
 * @return bool
 */
function is_created_by_owner( $listing_id ) {
    $listing_creator = ( new \App\Services\ListingService() )->created_by( $listing_id );
    if ( $listing_creator == 3 ) {
        return true;
    } else {
        return false;
    }
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
 * @param $favourites
 * @param $listing_id
 *
 * @return bool
 */
function isFavourite( $favourites, $listing_id ) {
    foreach ( $favourites as $key => $fav ) {
        if ( $fav["pivot"]->user_id == myId() && $fav["pivot"]->listing_id == $listing_id ) {
            return true;
        }
    }

    return false;
}

/**
 * @return mixed
 */
function isOwner() {
    return auth()->guard( 'renter' )->check();
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
 * @param $string
 *
 * @return Carbon
 */
function carbon( $string ) {
    return new Carbon( $string );
}

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
    return ( new NotificationService( $data ) )->send();
}

/**
 * @param $data
 *
 * @return array|null
 */
function dispatchMessageEvent( $data ) {
    return event( new TriggerMessage( $data ) );
}

/**
 * @param $data
 * @param int $delay
 *
 * @return PendingDispatch
 */
function dispatchListingNotification( $data, $delay = 5 ) {
    return dispatch( new SaveSearchMatchJob( $data ) )->delay( now()->addSeconds( $delay ) );
}

/**
 * @param $data
 * @param int $delay
 *
 * @return PendingDispatch
 */
function dispatchEmailQueue( $data, $delay = 10 ) {
    return dispatch( new \App\Jobs\SendEmailJob( $data ) )->delay( now()->addSeconds( $delay ) );
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
 * @param $data
 *
 * @return object
 */
function toObject( $data ) {
    return (object) $data;
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
 * @param $features
 *
 * @return array|mixed
 */
function findFeatures( $features ) {
    $collection = [];
    foreach ( $features as $feature ) {
        $collection[] = $feature->value;
    }

    return $collection;
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

    return ( count( $collect ) > 0 ) ? implode( ', ', $collect ) : 'Null';
}

/**
 * @param $features
 *
 * @return string
 */
function apartmentFeatures($features) {
    $unit = unitFeature($features);
    $policy = petPolicy($features);
    $unit = implode(', ', $unit);
    $policy = implode(', ', $policy);
    return $unit.', '.$policy;
}

/**
 * @param $features
 *
 * @return array
 */
function petPolicy( $features ) {
    $collection    = [];
    $configFeature = config( 'features.pet_policy' );
    foreach ( $features as $feature ) {
        if ( strpos( $feature->value ?? $feature, 'p' ) !== false ) {
            $collection[] = $configFeature[ $feature->value ?? $feature ];
        }
    }

    return $collection;
}

/**
 * @param $features
 *
 * @return array
 */
function unitFeature( $features ) {
    $collection    = [];
    $configFeature = config( 'features.unit_feature' );
    foreach ( $features as $feature ) {
        if ( strpos( $feature->value ?? $feature, 'u' ) !== false ) {
            $collection[] = $configFeature[ $feature->value ?? $feature ];
        }
    }

    return $collection;
}

/**
 * @param $index
 *
 * @return mixed|null
 */
function openHouseTimeSlot( $index ) {
    $slots = config( 'openHouse' );

    return new Carbon( $slots[ $index ] ) ?? null;
}

/**
 * @param int $perColumn
 *
 * @return string
 */
function amenities( $perColumn = 5 ) {
    $html    = '<div class="col-md-4"><h3>Amenities</h3>';
    $service = new \App\Services\AmenityService();
    foreach ( $service->get() as $key => $amenity ) {
        $html .= '<ul class="checkbox-listing"><li><div class="custom-control custom-checkbox">';
        $html .= Form::checkbox( 'amenities[]', $amenity->id, null, [
            'class' => 'custom-control-input',
            'id'    => $key
        ] );
        $html .= '<label class="custom-control-label" for="' . $key . '">' . $amenity->amenities . '</label></div></li></ul>';
        if ( ( $key + 1 ) % $perColumn === 0 ) {
            $html .= '</div><div class="col-sm-4"><h3>&nbsp;</h3>';
        }
    }

    return $html;
}

/**
 * @return string|null
 */
function features() {
    $html     = null;
    $features = config( 'features' );
    foreach ( $features as $type => $feature ) {
        $html .= "<div class='col-md-6'>
        <h3>" . ucwords( str_replace( '_', ' ', $type ) ) . "</h3><ul class='checkbox-listing'>";
        foreach ( $feature as $index => $value ) {
            $html .= "<li><div class='custom-control custom-checkbox'>" .
                     Form::checkbox( "features[]", $index, null,
                         [
                             'class' => 'custom-control-input',
                             'id'    => "listitem{$index}"
                         ] ) . "<label class='custom-control-label' for='listitem{$index}'>" .
                     $value . "</label></div></li>";
        }
        $html .= "</ul></div>";
    }

    $html .= "<script>
                let row = $('.row'); 
                $(() => {
                    if($('#listitemp3').is(':checked')) {
                        p3(true);
                    }
                    
                    if($('#listitemp4').is(':checked')) {
                        p4(true);
                    }
                });
                
                function p3(action) {
                    row.find('input[value=p1], input[value=p2]').prop('checked', false);
                    row.find('input[value=p1], input[value=p2]').prop('disabled', action);
                }
                
                function p4(action) {
                    row.find('input[value=p1], input[value=p2], input[value=p3]').prop('checked', false);
                    row.find('input[value=p1], input[value=p2], input[value=p3]').prop('disabled', action);
                }
                
                $('#listitemp4, #listitemp3').change(function() {
                    let val = $(this).val();
                    if (val === 'p3') {
                        p3($(this).is(':checked'));
                    }
        
                    if (val === 'p4') {
                        p4($(this).is(':checked'));
                    }
                });</script>";

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
    foreach ( $service->get() as $key => $value ) {
        $neighborhoods[ $value->id ] = $value->name;
    }

    return $neighborhoods;
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
 * @param $data
 * @param bool $update
 * @param null $id
 *
 * @return mixed
 */
function calendarEvent( $data, $update = false, $id = null ) {
    if ( $update ) {
        $calendar = ( new \App\Services\CalendarService() )->updateEvent( $id, $data );
    } else {
        $calendar = ( new \App\Services\CalendarService() )->addEvent( toObject( $data ) );
    }

    return $calendar;
}

/**
 * @param $id
 *
 * @return bool|mixed
 */
function deleteCalendarEvent( $id ) {
    return ( new \App\Services\CalendarService() )->removeEvent( $id );
}

/**
 * @param $listing
 *
 * @return string
 */
function is_exclusive( $listing ) {
    if ( $listing !== null ) {
        if ( $listing->building_type === EXCLUSIVE ) {
            return sprintf( "%s - (%s)", $listing->street_address, $listing->unit ?? '#' );
        }

        return $listing->display_address;
    }

    return 'N/A';
}

/**
 * @param $string
 * @param $phrase
 *
 * @return string
 */
function str_formatting( $string, $phrase ) {
    return $string . ' ' . ( $string > 1 ? $phrase . 's' : $phrase );
}

/**
 * @param $id
 *
 * @return mixed
 */
function getMembers( $id ) {
    return ( new \App\Services\MemberService )->team( $id );
}
