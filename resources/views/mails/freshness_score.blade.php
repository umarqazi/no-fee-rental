@extends('mails.layouts.header')
@section('title', 'Feature Listing Approved')
@section('content')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <style>
        .box-img-wraper{
            max-width: 400px;
            margin: 0 auto;
            text-align: left;
            line-height: 0;
            border: 1px solid #ddd;
            margin-bottom: 15px;
        }
        .box-img{
            display: inline-block;
            height: 140px;
            object-fit: cover;
            width: 165px;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .box-content{
            display: inline-block;
            vertical-align: top;
            width: calc(100% - 200px);
            margin-left: 10px;
            color: #808080;
            padding: 10px 10px 10px 0px;
        }
        .box-content ul li{
            display: inline-block;
            padding: 10px 10px 0px 0px;
        }
        .btn-default{
            background: #f36f21;
            color: #fff;
            text-transform: initial;
            font-size: 14px;
            padding: 0px 45px;
            border-radius: 5px;
            line-height: 45px;
            display: inline-block;
            border: none;
            outline: none !important;
            text-decoration: none;
        }
        .btn-default:hover, .btn-default:focus {
            color: #fff;
            background: #223971;
            outline: none !important;
            box-shadow: none;
        }
        @media only screen and (max-width: 576px){
            .box-img{
                display: block;
                width: 100%;
            }
            .box-content{
                display: block;
                width:calc(100% - 20px)
            }
        }

    </style>
    <div class="Notification-wrapper">
        <div class="logo-img">
            <a href="javascript:void(0)"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"></a>
        </div>
        <div class="notification-inner-content">
            <h2>FEATURED LISTING APPROVED</h2>
            <p>Your listing <b>152 West 51st Street, Theater District, Manhattan - #1914</b> freshness score is <b>low!</b></p>
            <p>You can refresh this listing by clicking the repost button from your dashboard. If the listing was rented you can update the status of the listing from your dashboard as well.</p>
        </div>
        <div class="listing-box">
            <div class="box-img-wraper">
                <div class="box-img" style="position: relative; background-image: url('/assets/images/large-view-3.jpg')">
                    <span style="width: calc(100% - 30px);position: absolute;bottom: 0px;font-size: 14px;font-weight: 500;color: #fff;background-color: rgba(0,0,0,0.4);padding: 15px;">$3295 / month</span>
                </div>
                <div class="box-content">
                    <p style="margin: 0;font-weight: 600;color: #808080">152 West 51st Sstreet, Theater District,
                        Manhattan - #1914</p>
                    <ul style="font-size: 14px;list-style-type: none; padding-left: 0; margin: 0;">
                        <li><i class="fas fa-hotel"></i> Rental</li>
                        <li><i class="fas fa-couch"></i> 3 Rooms</li>
                    </ul>
                    <ul style="font-size: 14px;list-style-type: none; padding-left: 0; margin: 0;">
                        <li><i class="fa fa-bed"></i> 1 Beds</li>
                        <li><i class="fas fa-ruler"></i> 0 ft <sup>2</sup></li>
                    </ul>
                </div>
            </div>
            <a href="#" class="btn btn-default">Manage Listings</a>

        </div>
    </div>
@endsection
