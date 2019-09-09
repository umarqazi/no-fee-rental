

							<!--List view listing-->
							<div class="listing-wrapper">
								@foreach($listing->inactive as $il)
								<div class="listing-row">
									<div class="img-holder">
                                        <img src="{{isset($il->thumbnail) ? ((!empty($il->realty_id)) ? $il->thumbnail : asset('storage/'.$il->thumbnail)) : asset('uploads/listing/thumbnails/default.jpg')}}" alt="" style="height: 205px; width: 100%;" class="main-img" />
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
                                            <a href="{{ route('agent.editListing', $il->id) }}"><span><img src="{{asset('assets/images/edit-icon.png')}}" alt=""></span></a>
                                            <a href="{{ route('agent.copyListing', $il->id) }}"><span><img src="{{asset('assets/images/copy-icon.png')}}" alt=""></span></a>
											<a href="{{ route('agent.listingRepost', $il->id) }}"><button type="button" class="border-btn">Repost</button></a>
										</div>
									</div>
								</div>
								@endforeach
								@if($listing->inactive->total() < 1)
									No Record Found
								@endif
								{!! $listing->inactive->render() !!}
							</div>

							<!--Grid view listing-->
							<div class="grid-view-wrapper">
								<div class="row">
									@foreach($listing->inactive as $il)
									<div class="col-lg-3 col-md-4 col-sm-6">
										<div class="listing-thumb">
                                            <img src="{{isset($il->thumbnail) ? ((!empty($il->realty_id)) ? $il->thumbnail : asset('storage/'.$il->thumbnail)) : asset('uploads/listing/thumbnails/default.jpg')}}" alt="" style="height: 205px; width: 100%;" class="main-img" />
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
												</div>
												<div class="list-actions-icons">
                                                    <a href="{{ route('agent.editListing', $il->id) }}"><button><i class="fa fa-edit"></i></button></a>
                                                    <a href="{{ route('agent.copyListing', $il->id) }}"><button><i class="fa fa-copy"></i></button></a>
												</div>
											</div>
										</div>
									</div>
									@endforeach
									@if($listing->inactive->total() < 1)
										No Record Found
									@endif
								</div>
									{!! $listing->inactive->render() !!}
							</div>
