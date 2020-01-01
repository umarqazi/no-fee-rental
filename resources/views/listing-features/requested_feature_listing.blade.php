

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
										<p>Freshness Score : {{ $rf->freshness_score }}%</p>
										<ul>
											<li><i class="fa fa-bed"></i> {{ str_formatting($rf->bedrooms, 'Bed') }}</li>
											<li><i class="fa fa-bath"></i> {{ str_formatting($rf->baths, 'Bath') }}</li>
										</ul>
										<p>Requested By: {{ $rf->agent->first_name }}</p>
										<p>Posted On: {{ date("m/d/y H:m A", strtotime($rf->created_at)) }}</p>
										<div class="actions-btns">
											<a href="{{ route('admin.repostListing', $rf->id) }}"><button type="button" class="border-btn">Repost</button></a>
                                            <a href="{{ route('admin.approveFeature', $rf->id )}}" title="Make this property featured">
                                                <button type="button" class="border-btn">Approve</button>
                                            </a>
                                            <a href="{{ route('admin.removeFeatured', $rf->id )}}" title="Reject feature request">
                                                <button type="button" class="border-btn">Cancel</button></a>
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
												<p>Freshness Score : {{ $rf->freshness_score }}%</p>
												<ul>
													<li><i class="fa fa-bed"></i> {{ str_formatting($rf->bedrooms, 'Bed') }}</li>
													<li><i class="fa fa-bath"></i> {{ str_formatting($rf->baths, 'Bath') }}</li>
												</ul>
												<p>Posted On: {{ date("m/d/y H:m A", strtotime($rf->created_at)) }}</p>
												<div class="actions-btns">
													<a href="{{ route('admin.repostListing', $rf->id) }}">
														<button type="button" class="border-btn">Repost</button>
													</a>
                                                    <a href="{{ route('admin.approveFeature', $rf->id )}}" title="Make this property featured">
                                                        <button type="button" class="border-btn">Approve</button>
                                                    </a>
                                                    <a href="{{ route('admin.removeFeatured', $rf->id )}}" title="Reject feature request">
                                                        <button type="button" class="border-btn">Cancel</button>
													</a>
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
