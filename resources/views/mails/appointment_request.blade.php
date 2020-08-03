@extends('mails.layouts.header')
@section('title', 'Account Created')
@section('content')
    <style>
        .Notification-wrapper {
            background-color: #fff;
            display: inline-block;
            width: 730px;
            padding: 45px 45px 10px 45px;
            border-bottom: 2px solid #ddd;
        }
        .notification-inner-content h2{
            text-transform: uppercase;
        }
        .btn-default{
            background: #f36f21;
            color: #fff;
            text-transform: initial;
            font-size: 14px;
            padding: 0px 30px;
            border-radius: 5px;
            line-height: 45px;
            display: inline-block;
            border: none;
            outline: none !important;
        }
        .btn-default:hover, .btn-default:focus {
            color: #fff;
            background: #223971;
            outline: none !important;
            box-shadow: none;
        }
        .schedule-dateTime{
            text-align: left;
        }
        .schedule-dateTime table tr td{
            padding: 15px 0;
            text-align: left;
            font-size: 14px;
        }
        .schedule-dateTime table, th, td {
            border: 1px solid #ddd;
            border-collapse: collapse;
            border-left: 0;
            border-right: 0;
            border-bottom: 0;
        }
        .schedule-dateTime table td:first-child{
            text-align: left;
        }
        .schedule-dateTime table td:last-child{
            text-align: right;
        }

        @media only screen and (min-width: 767px){
            .Notification-wrapper{
                width: 730px;yousuf.khalid+11@techverx.com
            }
        }
    </style>
    <div class="Notification-wrapper" style="width: 730px;">
        <div class="logo-img">
            <a href="javascript:void(0)"><img src="{{ Storage::url('assets/images/logo.png') }}" alt="logo"></a>
        </div>
        <div class="notification-inner-content">
            <h2>APPOINTMENT REQUEST</h2>
        </div>
        <div class="showing-request">
            <p style="color: #808080; font-size: 16px;">You have a showing request!</p>
            <div class="see-clients-bg" style="background-color: #edeff0; padding: 10px">
                <a href="javascript:void(0)" class="btn-default" style="text-decoration: none; background: #f36f21;color: #fff;text-transform: initial;font-size: 14px;
            padding: 0px 30px;border-radius: 5px;line-height: 45px;display: inline-block;border: none;outline: none !important; cursor: pointer !important;">See Clients Details !</a>
                <p style="margin-bottom: 0;"><a href="{{ $data->url }}" style="color: #333">See rental details and accept or decline this request</a> </p>
            </div>
        </div>
        <div class="schedule-dateTime">
            <table style="width:100%; margin-top: 15px;">
                <tr>
                    <td><b>Requested Date:</b></td>
                    <td>{{ $data->appointment->appointment_date->format('d M, Y') }}</td>
                </tr>
                <tr>
                    <td><b>Requested Time:</b></td>
                    <td>{{ carbon($data->appointment->appointment_time)->format('h:i a') }}</td>
                </tr>
                <tr>
                    <td><b>Listing:</b></td>
                    <td>{{ sprintf('%s, %s', is_exclusive($data->listing), $data->listing->neighborhood->name) }}<br/>
                        <span style="font-size: 12px; color: #808080">
                            ${{ number_format($data->listing->rent) }},
                            {{ $data->listing->bedrooms < 1 ? 'Studio' : str_formatting($data->listing->bedrooms, 'Bed') }},
                            {{ str_formatting($data->listing->baths, 'Bath') }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
