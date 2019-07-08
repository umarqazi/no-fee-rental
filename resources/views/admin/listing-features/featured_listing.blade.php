

							<!--List view listing-->
							<div class="listing-wrapper">
								@foreach($listing['featured'] as $fl)
								<div class="listing-row">
									<div class="img-holder">
										<img src="{{isset($fl->thumbnail) ? asset('storage/'.$fl->thumbnail) : asset('uploads/listing/thumbnails/default.jpg')}}" alt="" style="height:205px;" class="main-img" />
									</div>
									<div class="info">
										<p class="title">{{ $fl->display_address }}</p>
										<p><i class="fa fa-tag"></i> ${{ $fl->rent }}</p>
										<p>Freshmen Score : 90%</p>
										<ul>
											<li><i class="fa fa-bed"></i> {{ $fl->bedrooms }} Bed</li>
											<li><i class="fa fa-bath"></i> {{ $fl->baths }} Bath</li>
										</ul>
										<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
										<p>Requested By: {{ $fl->agent->first_name }}</p>
										<p>Posted: {{ date("m/d/y H:m A", strtotime($fl->created_at)) }}</p>
										<a href="javascript:void(0);" onclick="active('{{ $fl->id }}', this)" title="Publish this property"><span class="status" style="background: red;">Deactive</span></a>
										<div class="actions-btns">
											<a href="{{ route('admin.editListing', $fl->id) }}"><span><img src="{{asset('admin/images/edit-icon.png')}}" alt=""></span></a>
											<span><img src="{{asset('admin/images/copy-icon.png')}}" alt=""></span>
											<a href="{{ route('admin.listingRepost', $fl->id) }}"><button type="button" class="border-btn">Repost</button></a>
											<button type="button" class="border-btn">Request Feature</button>
										</div>
									</div>
								</div>
								@endforeach
								@if(count($listing['featured']) < 1)
									<p class="null">No Record Found</p>
								@endif
								{!! $listing['featured']->render() !!}
							</div>

							<!--Grid view listing-->
							<div class="grid-view-wrapper">
								<div class="row">
									@foreach($listing['request_featured'] as $fl)
									<div class="col-lg-3 col-md-4 col-sm-6">
										<div class="listing-thumb">
											<img src="{{isset($fl->thumbnail) ? asset('storage/'.$fl->thumbnail) : asset('uploads/listing/thumbnails/default.jpg')}}" alt="" style="width: 400px;" class="main-img" />
											<div class="info">
												<p class="title">{{ $fl->display_address }}</p>
												<p><i class="fa fa-tag"></i> ${{ $fl->rent }}</p>
												<p>Freshmen Score : 90%</p>
												<ul>
													<li><i class="fa fa-bed"></i> {{ $fl->bedrooms }} Bed</li>
													<li><i class="fa fa-bath"></i> {{ $fl->baths }} Bath</li>
												</ul>
												<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
												<p>Posted: {{ date("m/d/y H:m A", strtotime($fl->created_at)) }}</p>
												<a href="javascript:void(0);" onclick="active('{{ $fl->id }}', this)" title="Publish this property"><span class="status" style="background: red;">Deactive</span></a>
												<div class="actions-btns">
													<a href="{{ route('admin.listingRepost', $fl->id) }}"><button type="button" class="border-btn">Repost</button></a>
													<button type="button" class="border-btn">Request Feature</button>
												</div>
												<div class="list-actions-icons">
													<a href="{{ route('admin.editListing', $fl->id) }}"><button><i class="fa fa-edit"></i></button></a>
													<button><i class="fa fa-copy"></i></button>
												</div>
											</div>
										</div>
									</div>
									@endforeach
									@if(count($listing['request_featured']) < 1)
										<p class="null">No Record Found</p>
									@endif
								</div>
									{!! $listing['request_featured']->render() !!}
							</div>