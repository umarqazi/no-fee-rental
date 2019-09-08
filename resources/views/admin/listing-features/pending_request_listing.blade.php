
							<!--List view listing-->
							<div class="listing-wrapper">
								@foreach($listing->pending as $pl)
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
										<p>Request By: {{ $pl->agent->first_name.' '.$pl->agent->last_name }}</p>
										<p>Posted: {{ date("m/d/y H:m A", strtotime($pl->created_at)) }}</p>
										<a href="{{ route('admin.approveRequest', $pl->id) }}" title="Click To Approve"><span class="status" style="background: #ffce39;">Pending</span></a>
										<div class="actions-btns">
											<a href="{{ route('admin.editListing', $pl->id) }}"><span><img src="{{asset('admin/images/edit-icon.png')}}" alt=""></span></a>
											<span><img src="{{asset('admin/images/copy-icon.png')}}" alt=""></span>
										</div>
									</div>
								</div>
								@endforeach
								@if($listing->pending->total() < 1)
									<p class="null">No Record Found</p>
								@endif
								{!! $listing->pending->render() !!}
							</div>

							<!--Grid view listing-->
							<div class="grid-view-wrapper">
								<div class="row">
									@foreach($listing->pending as $pl)
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
												<p>Posted: {{ date("m/d/y H:m A", strtotime($pl->created_at)) }}</p>
												<a href="{{ route('admin.approveRequest', $pl->id) }}" title="Click To Approve"><span class="status" style="background: #ffce39;">Pending</span></a>
												<div class="actions-btns">
												</div>
												<div class="list-actions-icons">
													<a href="{{ route('admin.editListing', $pl->id) }}"><button><i class="fa fa-edit"></i></button></a>
													<button><i class="fa fa-copy"></i></button>
												</div>
											</div>
										</div>
									</div>
									@endforeach
									@if($listing->pending->total() < 1)
										<p class="null">No Record Found</p>
									@endif
								</div>
									{!! $listing->pending->render() !!}
							</div>
