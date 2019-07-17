
							<!--List view listing-->
							<div class="listing-wrapper">
								@foreach($listing['pending'] as $pl)
								<div class="listing-row">
									<div class="img-holder">
										<img src="{{isset($pl->thumbnail) ? asset('storage/'.$pl->thumbnail) : asset('uploads/listing/thumbnails/default.jpg')}}" alt="" style="height: 205px;" class="main-img" />
									</div>
									<div class="info">
										<p class="title">{{ $pl->display_address }}</p>
										<p><i class="fa fa-tag"></i> ${{ $pl->rent }}</p>
										<p>Freshmen Score : 90%</p>
										<ul>
											<li><i class="fa fa-bed"></i> {{ $pl->bedrooms }} Bed</li>
											<li><i class="fa fa-bath"></i> {{ $pl->baths }} Bath</li>
										</ul>
										<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
										<p>Posted: {{ date("m/d/y H:m A", strtotime($pl->created_at)) }}</p>
										<span class="status" style="background: #ffce39;">Pending</span>
										<div class="actions-btns">
											<a href="{{ route('agent.editListing', $pl->id) }}"><span><img src="{{asset('assets/images/edit-icon.png')}}" alt=""></span></a>
											<span><img src="{{asset('assets/images/copy-icon.png')}}" alt=""></span>
										</div>
									</div>
								</div>
								@endforeach
								@if(count($listing['pending']) < 1)
									No Record Found
								@endif
								{!! $listing['pending']->render() !!}
							</div>

							<!--Grid view listing-->
							<div class="grid-view-wrapper">
								<div class="row">
									@foreach($listing['pending'] as $pl)
									<div class="col-lg-3 col-md-4 col-sm-6">
										<div class="listing-thumb">
											<img src="{{isset($pl->thumbnail) ? asset('storage/'.$pl->thumbnail) : asset('uploads/listing/thumbnails/default.jpg')}}" alt="" style="width: 400px;" class="main-img" />
											<div class="info">
												<p class="title">{{ $pl->display_address }}</p>
												<p><i class="fa fa-tag"></i> ${{ $pl->rent }}</p>
												<p>Freshmen Score : 90%</p>
												<ul>
													<li><i class="fa fa-bed"></i> {{ $pl->bedrooms }} Bed</li>
													<li><i class="fa fa-bath"></i> {{ $pl->baths }} Bath</li>
												</ul>
												<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
												<p>Posted: {{ date("m/d/y H:m A", strtotime($pl->created_at)) }}</p>
												<span class="status" style="background: #ffce39;">Pending</span>
												<div class="list-actions-icons">
													<a href="{{ route('agent.editListing', $pl->id) }}"><button><i class="fa fa-edit"></i></button></a>
													<button><i class="fa fa-copy"></i></button>
												</div>
											</div>
										</div>
									</div>
									@endforeach
									@if(count($listing['pending']) < 1)
										No Record Found
									@endif
								</div>
									{!! $listing['pending']->render() !!}
							</div>