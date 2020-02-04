@extends('mails.layouts.header')
@section('title', 'Reset Password')
@section('content')
    <div class="Notification-wrapper">
        <div class="logo-img">
            <a href="javascript:void(0)"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"></a>
        </div>
        <div class="notification-inner-content">
            <h2>RESET YOUR PASSWORD</h2>
            <p> This email is in response for a request to reset your password.</p>
            <p>Please click the link to reset your password: <a href="{{ $data->url }}">Reset Password</a></p>
            <div class="action-button">
                <p><b>Please make sure you have deleted any saved passwords for NOFEERENTALSNYC from your browser, which can interfere with your login.</b></p>
            </div>
            <div class="settings-text">
                <p>For Chrome: Go to Tools > Settings > Advanced > Manage Passwords > then click the 3 dots by the Nofeerentalsnyc entries and choose “Remove” <br> <br>
                    For Internet Explorer: Go to Tools > Internet Options > Content Tab > Autocomplete Settings > Manage Passwords > then click the down arrow by the Nofeerentalsnyc entries and click “Remove”<br> <br>
                    For Safari: Go to Tools > Preferences > AutoFill Tab > Click “Edit” by “User names and Passwords” > Select the Nofeerentalsnyc site entries and click “Remove”</p>
                <br>
            </div>
            <p>
                If you have any questions or concerns, please contact us at <a href="#" style="color: cadetblue;">info@nofeerentalsnyc.com</a>
                <br> <br>
            </p>
            <div class="secure-nofee-rental">
                <p> <span style="background-color: #eee;">Didn’t request to reset your security information? Someone
                        may be attempting to claim your ID as their own nofeerentalsnyc ID.</span>  <span style="background-color: #eee;">Please go to <a href="#"> secure.nofeerentalsnyc.com </a> to reset your password immediately. </span></p>
                <br>
            </div>
        </div>
    </div>
@endsection