<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Listing Feature Approved</title>
	<style type="text/css">
		body{
			background-color: #edeff0;
			margin: 0;
			padding: 0;
			font-family: sans-serif;
			overflow-x: hidden;
		}
		.main-wrapper{
			width: 100%;
			padding:40px 15px;
			text-align: center;
			box-sizing: border-box;
		}
		.logo-img{
			margin-bottom: 30px;
		}
		.logo-img img{
			width: 210px;
			height: auto;
			cursor: pointer;
		}
		.Notification-wrapper{
			background-color: #fff;
			display: inline-block;
			max-width: 745px;
			padding: 45px 45px 10px 45px;
			border-radius: 10px;

		}

		.Notification-wrapper h2{
			color: #233772;
			font-size: 30px;
			font-weight: 700;
		}
		.Notification-wrapper b{
			color: #000;
		}
		.Notification-wrapper p{
			color: #5f6368;
			font-size: 16px;
			font-weight: 500;
			letter-spacing: 0.5px;
			line-height: 25px;

		}
		.action-button button{
			padding: 10px 35px;
		    background-color: #e77817;
		    color: #fff;
		    border: #e77817 solid 1px;
		    border-radius: 5px;
		    font-size: 16px;
		    font-weight: normal;
		    cursor: pointer;
		    margin: 60px 0px;
		}
		.action-button button:hover{
			background-color: #223971;
			border: #223971 solid 1px;
			transition: 0.3s ease-in-out;
		}
		.notification-main-footer{
			padding: 40px 0 0;
		}
		.Notification-wrap-footer p{
			padding-top: 20px;
			border-top: #eee solid 1px;
		}
		.Notification-wrap-footer b{
			color: #283e74;
		}

		.notification-main-footer p{
			color: #aaaaaa;
			font-size: 16px;
			font-weight: 500;
			margin-top: 0;
    		margin-bottom: 20px;
    		line-height: 22px;
		}
		.notification-main-footer a{
			text-decoration: none;
			margin-right: 5px;
			display: inline-block;
		}
		.notification-main-footer a:last-child{
			margin-right: 0;
		}
		@media only screen and (max-width: 991px){
			.main-wrapper {
    			padding: 20px 15px;
    		}
    		.logo-img {
			    margin-bottom: 20px;
			}
			.Notification-wrapper{
				padding: 20px 15px 10px 15px;
			}
			.Notification-wrapper img{
				width: 50px;
				height: 50px;
			}
			.Notification-wrapper h2{
				font-size: 24px;
				margin: 10px 0px;
			}
			.Notification-wrapper p{
				font-size: 14px;
			}
			.action-button button{
				margin: 15px 0px;
			}
			.notification-main-footer {
			    padding: 20px 0 0;
			}
			.notification-main-footer p {
			    font-size: 14px;
			    font-weight: 500;
			    margin-top: 0;
			    margin-bottom: 15px;
			}
		}

	</style>
</head>
<body>
	<div class="main-wrapper">
		<div class="logo-img">
			<a href="javascript:void(0)"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"></a>
		</div>
		<div class="Notification-wrapper">
			<img src="{{ asset('assets/images/feature-listing.png') }}" alt="notification-bell-icon">
			<h2> Listing Feature Approved</h2>
			<p> <b>Hi  </b> Converted 2 Bedroom and 1 Bath with double exposure in a condo located in Midtown East. Windowed Kitchen and Bath. Comfortable living and dining area. The building is located within 5 minutes walking distance to the United Nations. Modest post-war building </p>
			<div class="action-button">
                <a href="{{$data->url}}"><button type="submit">Visit Listing</button></a>
			</div>
			<div class="Notification-wrap-footer">
				<p> <b>Lorem Ipsum </b>  is simply dummy text of the printing and typesetting industry. </p>
			</div>
		</div>
		<div class="notification-main-footer">
			<p> Problems or questions? Call us at (123) 254 658 <br> or email  info@nofeerental.com   </p>
			<p> @NOFEE Rental NYC all rights reserved </p>

			<a href="javascript:void(0)"><img src="{{ asset('assets/images/fb-icon.png') }}"> </a>
			<a href="javascript:void(0)"><img src="{{ asset('assets/images/twitter-icon.png') }}"> </a>
			<a href="javascript:void(0)"><img src="{{ asset('assets/images/google-icon.png') }}"> </a>
		</div>
</body>
</html>
