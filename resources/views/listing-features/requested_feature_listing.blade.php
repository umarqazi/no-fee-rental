

							<!--List view listing-->
							<div class="listing-wrapper">
								@foreach($listing->request_featured as $rf)
								<div class="listing-row">
									<div class="img-holder">
										<img src="{{ asset($rf->thumbnail ?? DLI) }}" alt="" style="height:205px;" class="main-img" />
									</div>
									<div class="info">
										<p class="title">{{ $rf->display_address }}</p>
										<p><i class="fa fa-tag"></i> ${{ ($rf->rent) ?   number_format($rf->rent,0) : 'None' }}</p>
										<p>Freshness Score : 90%</p>
										<ul>
											<li><i class="fa fa-bed"></i> {{ $rf->bedrooms }} Bed</li>
											<li><i class="fa fa-bath"></i> {{ $rf->baths }} Bath</li>
										</ul>
										<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
										<p>Requested By: {{ $rf->agent->first_name }}</p>
										<p>Posted: {{ date("m/d/y H:m A", strtotime($rf->created_at)) }}</p>
										<a href="{{ route('admin.approveFeature', $rf->id )}}" title="Make this property featured"><span class="status" style="background: blue;margin-right: 60px;">Approve</span></a>
										<a href="{{ route('admin.removeFeatured', $rf->id )}}" title="Reject feature request"><span class="status" style="background: red;">Cancel</span></a>
										<div class="actions-btns">
											<a href="{{ route('admin.editListing', $rf->id) }}"><span><img src="{{asset('admin/images/edit-icon.png')}}" alt=""></span></a>
											<span><img src="{{asset('admin/images/copy-icon.png')}}" alt=""></span>
											<a href="{{ route('admin.repostListing', $rf->id) }}"><button type="button" class="border-btn">Repost</button></a>
										</div>
									</div>
								</div>
								@endforeach
								@if($listing->request_featured->total() < 1)
									<p class="null">No Record Found</p>
								@endif
								{!! $listing->request_featured->render() !!}
							</div>

							<!--Grid view listing-->
							<div class="grid-view-wrapper">
								<div class="row">
									@foreach($listing->request_featured as $rf)
									<div class="col-lg-3 col-md-4 col-sm-6">
										<div class="listing-thumb">
											<img src="{{ asset($rf->thumbnail ?? DLI) }}" alt="" style="height:205px;" class="main-img" />
											<div class="info">
												<p class="title">{{ str_limit($rf->display_address, $limit = 25, $end = '...') }}</p>
												<p><i class="fa fa-tag"></i> ${{ ($rf->rent) ?   number_format($rf->rent,0) : 'None' }}</p>
												<p>Freshness Score : 90%</p>
												<ul>
													<li><i class="fa fa-bed"></i> {{ $rf->bedrooms }} Bed</li>
													<li><i class="fa fa-bath"></i> {{ $rf->baths }} Bath</li>
												</ul>
												<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
												<p>Posted: {{ date("m/d/y H:m A", strtotime($rf->created_at)) }}</p>
												<a href="{{ route('admin.approveFeature', $rf->id )}}" title="Make this property featured"><span class="status-approve" style="background: blue;">Approve</span></a>
												<a href="{{ route('admin.removeFeatured', $rf->id )}}" title="Reject feature request"><span class="status" style="background: red;">Cancel</span></a>
												<div class="actions-btns">
													<a href="{{ route('admin.repostListing', $rf->id) }}"><button type="button" class="border-btn">Repost</button></a>
												</div>
												<div class="list-actions-icons">
													<a href="{{ route('admin.editListing', $rf->id) }}"><button><i class="fa fa-edit"></i></button></a>
													<button><i class="fa fa-copy"></i></button>
												</div>
											</div>
										</div>
									</div>
									@endforeach
									@if($listing->request_featured->total() < 1)
										<p class="null">No Record Found</p>
									@endif
								</div>
									{!! $listing->request_featured->render() !!}
							</div>
