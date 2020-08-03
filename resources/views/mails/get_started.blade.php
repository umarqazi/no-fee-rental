@extends('mails.layouts.header')
@section('title', 'Get Started')
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
        table tr td{
            text-align: left;
        }

        @media only screen and (min-width: 767px){
            .Notification-wrapper{
                width: 730px;
            }
        }
    </style>
    <div class="Notification-wrapper" style="width: 730px;">
        <div class="logo-img">
            <a href="javascript:void(0)"><img src="{{ Storage::url('assets/images/logo.png') }}" alt="logo"></a>
        </div>
        <div class="notification-inner-content">
            <h2>Get Started Request</h2>
        </div>
        {{--<div class="showing-request">--}}
            {{--<div class="see-clients-bg" style="background-color: #edeff0; padding: 10px">--}}
                {{--<a href="javascript:void(0)" class="btn-default" style="text-decoration: none; background: #f36f21;color: #fff;text-transform: initial;font-size: 14px;--}}
            {{--padding: 0px 30px;border-radius: 5px;line-height: 45px;display: inline-block;border: none;outline: none !important; cursor: pointer !important;">See Clients Details !</a>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="schedule-dateTime">
            <table style="width:100%; margin-top: 15px;">
                <tr>
                    <td><b>Requested Date:</b></td>
                    <td>{{ now()->format('d M, Y') }}</td>
                </tr>
                <tr>
                    <td><b>Requested Time:</b></td>
                    <td>{{ now()->format('h:i a') }}</td>
                </tr>
                <tr>
                    <td><b>Finding In:</b></td>
                    <td>{{ implode(', ', $data->request->neighborhood) }}</td>
                </tr>
                <tr>
                    <td><b>Beds:</b></td>
                    <td>{{ count($data->request->beds) > 1 ? 'Between '.str_replace('0.5', 'Studio', implode(', ', $data->request->beds)). 'Beds' : implode(', ', $data->request->beds) }}</td>
                </tr>
                <tr>
                    <td><b>Renter Move Date:</b></td>
                    <td>{{ carbon(genericDateFormat($data->request->move_in_date))->format('d M, Y') }}</td>
                </tr>
                <tr>
                    <td><b>Renter Budget:</b></td>
                    <td>${{ $data->request->price }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
