<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/newsletter-subscribe', 'NewsletterController@subscribe')->name('newsLetter-subscription');

// WP Auth Routes
Route::post('/login', 'WP\AuthController@login');

Route::get('/payment-created', function () {
    return 'hit';
});

// User noise
Route::post('/send-feedback', function (\Illuminate\Http\Request $request) {
    $config = null;
    require_once public_path("usernoise/config.php");

    if (function_exists('date_default_timezone_set'))
        date_default_timezone_set($config['timezone']);

    if (!function_exists('json_encode')){
        echo '{"errors": ["Your installation does not have json_encode function. Please upgrade your PHP"]}';
        exit(0);
    }

    function get_feedback_type($request){
        $type = isset($request->type) ? $request->type : null;
        if (!$type){
            $type = "feedback";
        }
        return $type;
    }

    function strip_slashes_if_needed($string){
        if (get_magic_quotes_gpc())
            return is_array($string) ? array_map('strip_slashes_if_needed', $string) : stripslashes($string);
        return $string;
    }

    $message = sprintf("<div>A new %s has been submitted.\r\n\r\n</div>", get_feedback_type($request));
    $email = null;

    if (isset($request->email) && trim($request->email)){
        $email = strip_slashes_if_needed($request->email);
    }

    $title = null;
    if (isset($request->summary) && trim($request->summary)){
        $title = strip_slashes_if_needed($request->summary);
    }

    $feedback = null;

    if (isset($request->feedback) && trim($request->feedback)){
        $feedback = trim(strip_slashes_if_needed($request->feedback));
    }

    if ($email){
        $message .= "<div>Email: " . $email . "\r\n</div>";
    }

    if ($title){
        $message .= "<div>Summary: " . $title . "\r\n</div>";
    }
    $message .= "<div>Sent from: " . trim(strip_slashes_if_needed($_REQUEST['referer'])) . "\r\n</div>";
    $message .= "<div>Message: \r\n" . $feedback . "\r\n</div>";

    foreach(array_keys($_POST) as $key){
        if (!in_array($key, array('email', 'summary', 'feedback', 'type'))){
            $message .= "<div>".ucfirst($key) . ": " . trim(strip_slashes_if_needed($_REQUEST[$key])) . "\r\n</div>";
        }
    }

    $subject = sprintf('New %s submitted', get_feedback_type($request));

    $data = [
        'email'   => $config['email.from'],
        'subject' => $subject,
        'message' => $message,
    ];

    $credentials = [
        'email' => $config['email.from'],
        'password' => $config['email.smtp.password'],
    ];

    new \App\Services\MailService($credentials);

    return \Illuminate\Support\Facades\Mail::to(config('mail.admin.email'))
        ->send(new \App\Mail\UserNoiseMail($data));

})->name('feedback.send');