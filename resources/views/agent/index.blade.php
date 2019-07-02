@extends('secured-layouts.app')
@section('title', 'no fee rental')
@section('content')
<div class="wrapper">
			<div class="heading-wrapper">
				<h1>Listings</h1>
				<a href="{{ route('agent.addListing') }}" class="btn-default">New Listing</a>
			</div>
			<div class="block listing-container">
				<div class="heading-wrapper pl-0">
					<ul class="nav nav-pills">
						<li class="nav-item">
							<a class="nav-link active" id="active" data-toggle="pill" href="#listing-active">Active ( {{ count($listing['active']) }} )</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="deactive" data-toggle="pill" href="#listing-inactive">Inactive ( {{ count($listing['inactive']) }} )</a>
						</li>
					</ul>
					<div class="filter-wrapper">
						<div class="listing-views">
							<span><i class="fa fa-th-list list-view-btn active"></i></span>
							<span><i class="fa fa-th grid-view-btn"></i></span>
						</div>
						<span class="sort-bt">
							<i class="fa fa-sort-amount-down"></i>
							<span>Sort By</span>
						</span>
						<form action="{{ route('agent.listingSearch') }}" id="search" method="post">
							@csrf
							<input value="{{ !empty(Request::get('beds')) ? Request::get('beds') : '' }}" type="number" name="beds" class="filter-input" placeholder="All Beds" />
							<input value="{{ !empty(Request::get('baths')) ? Request::get('baths') : '' }}" type="number" name="baths" class="filter-input" placeholder="All Baths" />
							<button type="submit" class="btn-default">Filter</button>
						</form>
					</div>
				</div>
				<div class="block-body">
					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane active" id="listing-active">

							<!--List view listing-->
							<div class="listing-wrapper">
								@foreach($listing['active'] as $al)
								<div class="listing-row">
									<div class="img-holder">
										<img src="{{isset($al->thumbnail) ? asset('uploads/listing/thumbnails/'.$al->thumbnail) : asset('uploads/listing/thumbnails/default.jpg')}}" alt="" style="height: 205px;" class="main-img" />
									</div>
									<div class="info">
										<p class="title">{{ $al->display_address }}</p>
										<p><i class="fa fa-tag"></i> ${{ $al->rent }}</p>
										<p>Freshmen Score : 90%</p>
										<ul>
											<li><i class="fa fa-bed"></i> {{ $al->bedrooms }} Bed</li>
											<li><i class="fa fa-bath"></i> {{ $al->baths }} Bath</li>
										</ul>
										<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
										<p>Posted: {{ date("m/d/y H:m A", strtotime($al->created_at)) }}</p>
										<a href="{{ route('agent.listingStatus', $al->id) }}" title="Unpublish this property"><span class="status">Active</span></a>
										<div class="actions-btns">
											<a href="{{ route('agent.editListing', $al->id) }}"><span><img src="{{asset('agent/images/edit-icon.png')}}" alt=""></span></a>
											<span><img src="{{asset('agent/images/copy-icon.png')}}" alt=""></span>
											<a href="{{ route('agent.listingRepost', $al->id) }}"><button type="button" class="border-btn">Repost</button></a>
											<button type="button" class="border-btn">Request Feature</button>
										</div>
									</div>
								</div>
								@endforeach
								@if(count($listing['active']) < 1)
									No Record Found
								@endif
								{!! $listing['active']->render() !!}
							</div>

							<!--Grid view listing-->
							<div class="grid-view-wrapper">
								<div class="row">
									@foreach($listing['active'] as $al)
									<div class="col-lg-3 col-md-4 col-sm-6">
										<div class="listing-thumb">
											<img src="{{isset($al->thumbnail) ? asset('uploads/listing/thumbnails/'.$al->thumbnail) : asset('uploads/listing/thumbnails/default.jpg')}}" alt="" style="width: 400px;" class="main-img" />
											<div class="info">
												<p class="title">{{ $al->display_address }}</p>
												<p><i class="fa fa-tag"></i> ${{ $al->rent }}</p>
												<p>Freshmen Score : 90%</p>
												<ul>
													<li><i class="fa fa-bed"></i> {{ $al->bedrooms }} Bed</li>
													<li><i class="fa fa-bath"></i> {{ $al->baths }} Bath</li>
												</ul>
												<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
												<p>Posted: {{ date("m/d/y H:m A", strtotime($al->created_at)) }}</p>
												<a href="{{ route('agent.listingStatus', $al->id) }}" title="Unpublish this property"><span class="status">Active</span></a>
												<div class="actions-btns">
													<a href="{{ route('agent.listingRepost', $al->id) }}"><button type="button" class="border-btn">Repost</button></a>
													<button type="button" class="border-btn">Request Feature</button>
												</div>
												<div class="list-actions-icons">
													<button><i class="fa fa-edit"></i></button>
													<button><i class="fa fa-copy"></i></button>
												</div>
											</div>
										</div>
									</div>
									@endforeach
									@if(count($listing['active']) < 1)
										No Record Found
									@endif
								</div>
									{!! $listing['active']->render() !!}
							</div>

						</div>
						<div class="tab-pane fade" id="listing-inactive">

							<!--List view listing-->
							<div class="listing-wrapper">
								@foreach($listing['inactive'] as $il)
								<div class="listing-row">
									<div class="img-holder">
										<img src="{{isset($il->thumbnail) ? asset('uploads/listing/thumbnails/'.$il->thumbnail) : asset('uploads/listing/thumbnails/default.jpg')}}" alt="" style="height:205px;" class="main-img" />
									</div>
									<div class="info">
										<p class="title">{{ $il->display_address }}</p>
										<p><i class="fa fa-tag"></i> ${{ $il->rent }}</p>
										<p>Freshmen Score : 90%</p>
										<ul>
											<li><i class="fa fa-bed"></i> {{ $il->bedrooms }} Bed</li>
											<li><i class="fa fa-bath"></i> {{ $il->baths }} Bath</li>
										</ul>
										<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
										<p>Posted: {{ date("m/d/y H:m A", strtotime($il->created_at)) }}</p>
										<a href="{{ route('agent.listingStatus', $il->id) }}" title="Publish this property"><span class="status" style="background: red;">Deactive</span></a>
										<div class="actions-btns">
											<span><img src="{{asset('agent/images/edit-icon.png')}}" alt=""></span>
											<span><img src="{{asset('agent/images/copy-icon.png')}}" alt=""></span>
											<a href="{{ route('agent.listingRepost', $il->id) }}"><button type="button" class="border-btn">Repost</button></a>
											<button type="button" class="border-btn">Request Feature</button>
										</div>
									</div>
								</div>
								@endforeach
								@if(count($listing['inactive']) < 1)
									No Record Found
								@endif
								{!! $listing['inactive']->render() !!}
							</div>

							<!--Grid view listing-->
							<div class="grid-view-wrapper">
								<div class="row">
									@foreach($listing['inactive'] as $il)
									<div class="col-lg-3 col-md-4 col-sm-6">
										<div class="listing-thumb">
											<img src="{{isset($il->thumbnail) ? asset('uploads/listing/thumbnails/'.$il->thumbnail) : asset('uploads/listing/thumbnails/default.jpg')}}" alt="" style="width: 400px;" class="main-img" />
											<div class="info">
												<p class="title">{{ $il->display_address }}</p>
												<p><i class="fa fa-tag"></i> ${{ $il->rent }}</p>
												<p>Freshmen Score : 90%</p>
												<ul>
													<li><i class="fa fa-bed"></i> {{ $il->bedrooms }} Bed</li>
													<li><i class="fa fa-bath"></i> {{ $il->baths }} Bath</li>
												</ul>
												<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
												<p>Posted: {{ date("m/d/y H:m A", strtotime($il->created_at)) }}</p>
												<a href="{{ route('agent.listingStatus', $il->id) }}" title="Publish this property"><span class="status" style="background: red;">Deactive</span></a>
												<div class="actions-btns">
													<a href="{{ route('agent.listingRepost', $il->id) }}"><button type="button" class="border-btn">Repost</button></a>
													<button type="button" class="border-btn">Request Feature</button>
												</div>
												<div class="list-actions-icons">
													<button><i class="fa fa-edit"></i></button>
													<button><i class="fa fa-copy"></i></button>
												</div>
											</div>
										</div>
									</div>
									@endforeach
									@if(count($listing['inactive']) < 1)
										No Record Found
									@endif
								</div>
									{!! $listing['inactive']->render() !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection