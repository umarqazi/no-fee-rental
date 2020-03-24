@extends('secured-layouts.app')
@section('title', 'Notifications')
@section('content')
    <style>
        .notification-details{
            max-width: 100%;
            width: 100%;
        }
        .notification-details .notification-main-wrapper {
            display: block;
            width: 100%;
            position: unset;
            margin-top: 10px;
            padding-top: 10px;
        }
        .notification-details .notification-main-wrapper h3{
            margin-top: 0px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            background-color: #fff;
            border-bottom: 1px solid #ddd;
            padding-left: 0px;

        }
        .notification-details .notification-main-wrapper ul li{
            display: inline-block;
            margin-right: 10px;
            vertical-align: middle;
        }
        .notification-details .notification-main-wrapper ul li:last-child{
            margin-right: 0px;
        }
        .notification-details .notification-container:before{
            display: none;
        }
        .notification-details .notification-main-wrapper .notification-inner-scroll{
            max-height: 100%;
            overflow-y: auto;
        }
        .notification-details .notification-main-wrapper .custom-control-label{
            color: #223971;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }
        .notification-details .notification-main-wrapper .notification-inner-scroll .custom-checkbox{
            margin-top: 10px;
        }
        .notification-details .notification-main-wrapper .mark-read{
            position: relative;
            right: unset;
            color: #223971;
            font-size: 14px;
            font-weight: 600;
        }
        .notification-details .notification-main-wrapper .right-side-icons{
            position: absolute;
            top: 10px;
            right: 5px;
        }
        .notification-details .notification-main-wrapper .cross-icon-noti{
            position: absolute;
            top: 0;
            right: 0;
        }
        .notification-details .notification-main-wrapper i{
            position: absolute;
            right: 30px;
            top: 0px;
            font-size: 18px;
            cursor: pointer;
        }
    </style>
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Notifications</h1>
        </div>
        <div class="block">
            <div class="notification-details">
                <div class="notification-container notification-main-wrapper">
                    <h3>
                        <ul class="first-ul">
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input checkbox-all" id="10" name="" type="checkbox" value="10">
                                    <label class="custom-control-label" for="10">Select All</label>
                                </div>
                            </li>
                            <li><a href="javascript:void(0);" class="mark-read delete-selected"> Delete</a></li>
                            <li><a href="javascript:void(0);" class="mark-read mark-selected-as-read"> Mark as read</a></li>
                        </ul>
                    </h3>
                    <div class="notification-inner-scroll" id="style-2">
                        @foreach($notifications as $key => $notification)
                            @if($notification->model !== null)
                                @if($notification->model == \App\Listing::class)
                                    @php $listing = (new $notification->model)->where('id', $notification->linked_id)->first(); @endphp
                                    <div class="notification-content {{ $notification->is_read ? '' : 'unread' }}">
                                        <a href="{{ $notification->url }}" data-id="{{ $notification->id }}">
                                            <div class="notification-inner-content">
                                                <div class="custom-control custom-checkbox">
                                                    {!! Form::checkbox('remove', $notification->id, false, ['class' => 'custom-control-input checkBoxClass', 'id' => $key]) !!}
                                                    <label class="custom-control-label" for="{{ $key }}"></label>
                                                </div>
                                                <img src="{{ is_realty_listing($listing->thumbnail ?? DLI) }}" alt=""/>
                                                <div class="listingnoti">
                                                    <ul style="display: flex">
                                                        <li><h4>{{ is_exclusive($listing) }}</h4></li>
                                                        <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60"><g id="Layer_2" data-name="Layer 2"><g id="Capa_1" data-name="Capa 1"><path class="cls-1" d="M51.21,8.79a30,30,0,0,0-42.42,0,30,30,0,0,0,0,42.42,30,30,0,0,0,42.42,0,30,30,0,0,0,0-42.42ZM31.89,43.05h-.13V47a1.76,1.76,0,0,1-3.52,0v-3.9H24.35a1.76,1.76,0,1,1,0-3.51h7.54a3.89,3.89,0,1,0,0-7.78H28.13a7.41,7.41,0,1,1,0-14.81h.12v-3.9a1.76,1.76,0,0,1,3.52,0V17h3.89a1.76,1.76,0,1,1,0,3.51H28.13a3.89,3.89,0,1,0,0,7.78h3.76a7.41,7.41,0,0,1,0,14.81Z"></path></g></g></svg>
                                                            <span>{{ number_format($listing->rent) }}</span></li>
                                                        <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 59.67 60"><g id="Layer_2" data-name="Layer 2"><g id="Capa_1" data-name="Capa 1"><path class="cls-1" d="M55.87,0h-41a3.8,3.8,0,0,0-3.81,3.81V7.39h4V4H55.68V44.61H52.61v4h3.26a3.8,3.8,0,0,0,3.8-3.81v-41A3.8,3.8,0,0,0,55.87,0Z"></path><path class="cls-1" d="M44.8,11.4h-41A3.8,3.8,0,0,0,0,15.2v41A3.8,3.8,0,0,0,3.81,60h41a3.8,3.8,0,0,0,3.8-3.81v-41A3.81,3.81,0,0,0,44.8,11.4ZM42.1,27.66a.63.63,0,0,1-.42.61.65.65,0,0,1-.73-.14l-3.2-3.21L13.61,49.22l3.2,3.2a.7.7,0,0,1,.15.74.68.68,0,0,1-.62.4H7.09a.67.67,0,0,1-.67-.66V43.65A.67.67,0,0,1,6.83,43a.68.68,0,0,1,.73.14l3.22,3.22L34.93,22.11l-3.22-3.22a.68.68,0,0,1-.14-.73.66.66,0,0,1,.61-.41h9.25a.67.67,0,0,1,.67.67Z"></path></g></g></svg>
                                                            <span>{{ number_format($listing->square_feet) }}</span></li>
                                                    </ul>
                                                    <p>{{ $notification->message }}</p>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="right-side-icons">
                                            <img src="{{ Storage::url('/assets/images/error-cross.png') }}" class="cross-icon-noti remove-single"/>
                                        </div>
                                    </div>
                                @elseif ($notification->model == \App\User::class)
                                    @php $user = (new $notification->model)->where('id', $notification->from)->first(); @endphp
                                    <div class="notification-content {{ $notification->is_read ? '' : 'unread' }}">
                                        <a href="{{ $notification->url }}" data-id="{{ $notification->id }}">
                                            <div class="notification-inner-content">
                                                <div class="custom-control custom-checkbox">
                                                    {!! Form::checkbox('remove', $notification->id, false, ['class' => 'custom-control-input checkBoxClass', 'id' => $key]) !!}
                                                    <label class="custom-control-label" for="{{ $key }}"></label>
                                                </div>
                                                <img src="{{ Storage::url($user->profile_image ?? DUI) }}" alt=""/>
                                                <div class="listingnoti">
                                                    <h4>{{ sprintf('%s %s', $user->first_name, $user->last_name) }}</h4>
                                                    <p>{{ $notification->message }}</p>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="right-side-icons">
                                            <img src="{{ Storage::url('/assets/images/error-cross.png') }}" class="cross-icon-noti remove-single"/>
                                        </div>
                                    </div>
                                @elseif ($notification->model == \App\ContactUs::class)
                                    @php $user = (new $notification->model)->where('id', $notification->linked_id)->first() @endphp
                                    <div class="notification-content {{ $notification->is_read ? '' : 'unread' }}">
                                        <a href="{{ $notification->url }}" data-id="{{ $notification->id }}">
                                            <div class="notification-inner-content">
                                                <img src="{{ Storage::url(DUI) }}" alt=""/>
                                                <div class="listingnoti">
                                                    <h4>{{ $user->username }}</h4>
                                                    <p>{{ str_limit($notification->message, 50) }}</p>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="right-side-icons">
                                            <img src="{{ Storage::url('/assets/images/error-cross.png') }}" class="cross-icon-noti remove-single"/>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                        @if($notifications->count() < 1)
                            <p class="text-center" style="margin: 15px;">No Notifications Found</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


