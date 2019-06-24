@extends('agent.layouts.app')
@section('title', 'no fee rental')
@section('content')
<div class="wrapper">
			<div class="heading-wrapper">
				<h1>Listings</h1>
				<a href="add-new-list.html" class="btn-default">New Listing</a>
			</div>
			<div class="block listing-container">
				<div class="heading-wrapper pl-0">
					<ul class="nav nav-pills">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="pill" href="#listing-active">Active ( 86 )</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="pill" href="#listing-inactive">Inactive ( 1686 )</a>
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
						<input type="number" class="filter-input" placeholder="All Beds" />
						<input type="number" class="filter-input" placeholder="All Baths" />
						<button class="btn-default">Filter</button>
					</div>
				</div>
				<div class="block-body">
					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane active" id="listing-active">

							<!--List view listing-->
							<div class="listing-wrapper">
								<div class="listing-row">
									<div class="img-holder">
										<img src="assets/images/listing-img.jpg" alt="" class="main-img" />
									</div>
									<div class="info">
										<p class="title">West 96th Street</p>
										<p><i class="fa fa-tag"></i> $5,870</p>
										<p>Freshmen Score : 90%</p>
										<ul>
											<li><i class="fa fa-bed"></i> 2 Bed</li>
											<li><i class="fa fa-bath"></i> 1 Bath</li>
										</ul>
										<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
										<p>Posted: 04/30/19 06:04AM</p>
										<span class="status">Active</span>
										<div class="actions-btns">
											<span><img src="assets/images/edit-icon.png" alt=""></span>
											<span><img src="assets/images/copy-icon.png" alt=""></span>
											<button type="button" class="border-btn">Repost</button>
											<button type="button" class="border-btn">Request Feature</button>
										</div>
									</div>
								</div>

								<div class="listing-row">
									<div class="img-holder">
										<img src="assets/images/listing-img.jpg" alt="" class="main-img" />
									</div>
									<div class="info">
										<p class="title">West 96th Street</p>
										<p><i class="fa fa-tag"></i> $5,870</p>
										<p>Freshmen Score : 90%</p>
										<ul>
											<li><i class="fa fa-bed"></i> 2 Bed</li>
											<li><i class="fa fa-bath"></i> 1 Bath</li>
										</ul>
										<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
										<p>Posted: 04/30/19 06:04AM</p>
										<span class="status">Active</span>
										<div class="actions-btns">
											<span><img src="assets/images/edit-icon.png" alt=""></span>
											<span><img src="assets/images/copy-icon.png" alt=""></span>
											<button type="button" class="border-btn">Repost</button>
											<button type="button" class="border-btn">Request Feature</button>
										</div>
									</div>
								</div>

								<div class="listing-row">
									<div class="img-holder">
										<img src="assets/images/listing-img.jpg" alt="" class="main-img" />
									</div>
									<div class="info">
										<p class="title">West 96th Street</p>
										<p><i class="fa fa-tag"></i> $5,870</p>
										<p>Freshmen Score : 90%</p>
										<ul>
											<li><i class="fa fa-bed"></i> 2 Bed</li>
											<li><i class="fa fa-bath"></i> 1 Bath</li>
										</ul>
										<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
										<p>Posted: 04/30/19 06:04AM</p>
										<span class="status">Active</span>
										<div class="actions-btns">
											<span><img src="assets/images/edit-icon.png" alt=""></span>
											<span><img src="assets/images/copy-icon.png" alt=""></span>
											<button type="button" class="border-btn">Repost</button>
											<button type="button" class="border-btn">Request Feature</button>
										</div>
									</div>
								</div>

								<div class="listing-row">
									<div class="img-holder">
										<img src="assets/images/listing-img.jpg" alt="" class="main-img" />
									</div>
									<div class="info">
										<p class="title">West 96th Street</p>
										<p><i class="fa fa-tag"></i> $5,870</p>
										<p>Freshmen Score : 90%</p>
										<ul>
											<li><i class="fa fa-bed"></i> 2 Bed</li>
											<li><i class="fa fa-bath"></i> 1 Bath</li>
										</ul>
										<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
										<p>Posted: 04/30/19 06:04AM</p>
										<span class="status">Active</span>
										<div class="actions-btns">
											<span><img src="assets/images/edit-icon.png" alt=""></span>
											<span><img src="assets/images/copy-icon.png" alt=""></span>
											<button type="button" class="border-btn">Repost</button>
											<button type="button" class="border-btn">Request Feature</button>
										</div>
									</div>
								</div>
							</div>

							<!--Grid view listing-->
							<div class="grid-view-wrapper">
								<div class="row">
									<div class="col-lg-3 col-md-4 col-sm-6">
										<div class="listing-thumb">
											<img src="assets/images/listing-img.jpg" alt="" class="main-img" />
											<div class="info">
												<p class="title">West 96th Street</p>
												<p><i class="fa fa-tag"></i> $5,870</p>
												<p>Freshmen Score : 90%</p>
												<ul>
													<li><i class="fa fa-bed"></i> 2 Bed</li>
													<li><i class="fa fa-bath"></i> 1 Bath</li>
												</ul>
												<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
												<p>Posted: 04/30/19 06:04AM</p>
												<span class="status">Active</span>
												<div class="actions-btns">
													<button type="button" class="border-btn">Repost</button>
													<button type="button" class="border-btn">Request Feature</button>
												</div>
												<div class="list-actions-icons">
													<button><i class="fa fa-edit"></i></button>
													<button><i class="fa fa-copy"></i></button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-4 col-sm-6">
										<div class="listing-thumb">
											<img src="assets/images/listing-img.jpg" alt="" class="main-img" />
											<div class="info">
												<p class="title">West 96th Street</p>
												<p><i class="fa fa-tag"></i> $5,870</p>
												<p>Freshmen Score : 90%</p>
												<ul>
													<li><i class="fa fa-bed"></i> 2 Bed</li>
													<li><i class="fa fa-bath"></i> 1 Bath</li>
												</ul>
												<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
												<p>Posted: 04/30/19 06:04AM</p>
												<span class="status">Active</span>
												<div class="actions-btns">
													<button type="button" class="border-btn">Repost</button>
													<button type="button" class="border-btn">Request Feature</button>
												</div>
												<div class="list-actions-icons">
													<button><i class="fa fa-edit"></i></button>
													<button><i class="fa fa-copy"></i></button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-4 col-sm-6">
										<div class="listing-thumb">
											<img src="assets/images/listing-img.jpg" alt="" class="main-img" />
											<div class="info">
												<p class="title">West 96th Street</p>
												<p><i class="fa fa-tag"></i> $5,870</p>
												<p>Freshmen Score : 90%</p>
												<ul>
													<li><i class="fa fa-bed"></i> 2 Bed</li>
													<li><i class="fa fa-bath"></i> 1 Bath</li>
												</ul>
												<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
												<p>Posted: 04/30/19 06:04AM</p>
												<span class="status">Active</span>
												<div class="actions-btns">
													<button type="button" class="border-btn">Repost</button>
													<button type="button" class="border-btn">Request Feature</button>
												</div>
												<div class="list-actions-icons">
													<button><i class="fa fa-edit"></i></button>
													<button><i class="fa fa-copy"></i></button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-4 col-sm-6">
										<div class="listing-thumb">
											<img src="assets/images/listing-img.jpg" alt="" class="main-img" />
											<div class="info">
												<p class="title">West 96th Street</p>
												<p><i class="fa fa-tag"></i> $5,870</p>
												<p>Freshmen Score : 90%</p>
												<ul>
													<li><i class="fa fa-bed"></i> 2 Bed</li>
													<li><i class="fa fa-bath"></i> 1 Bath</li>
												</ul>
												<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
												<p>Posted: 04/30/19 06:04AM</p>
												<span class="status">Active</span>
												<div class="actions-btns">
													<button type="button" class="border-btn">Repost</button>
													<button type="button" class="border-btn">Request Feature</button>
												</div>
												<div class="list-actions-icons">
													<button><i class="fa fa-edit"></i></button>
													<button><i class="fa fa-copy"></i></button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-4 col-sm-6">
										<div class="listing-thumb">
											<img src="assets/images/listing-img.jpg" alt="" class="main-img" />
											<div class="info">
												<p class="title">West 96th Street</p>
												<p><i class="fa fa-tag"></i> $5,870</p>
												<p>Freshmen Score : 90%</p>
												<ul>
													<li><i class="fa fa-bed"></i> 2 Bed</li>
													<li><i class="fa fa-bath"></i> 1 Bath</li>
												</ul>
												<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
												<p>Posted: 04/30/19 06:04AM</p>
												<span class="status">Active</span>
												<div class="actions-btns">
													<button type="button" class="border-btn">Repost</button>
													<button type="button" class="border-btn">Request Feature</button>
												</div>
												<div class="list-actions-icons">
													<button><i class="fa fa-edit"></i></button>
													<button><i class="fa fa-copy"></i></button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-4 col-sm-6">
										<div class="listing-thumb">
											<img src="assets/images/listing-img.jpg" alt="" class="main-img" />
											<div class="info">
												<p class="title">West 96th Street</p>
												<p><i class="fa fa-tag"></i> $5,870</p>
												<p>Freshmen Score : 90%</p>
												<ul>
													<li><i class="fa fa-bed"></i> 2 Bed</li>
													<li><i class="fa fa-bath"></i> 1 Bath</li>
												</ul>
												<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
												<p>Posted: 04/30/19 06:04AM</p>
												<span class="status">Active</span>
												<div class="actions-btns">
													<button type="button" class="border-btn">Repost</button>
													<button type="button" class="border-btn">Request Feature</button>
												</div>
												<div class="list-actions-icons">
													<button><i class="fa fa-edit"></i></button>
													<button><i class="fa fa-copy"></i></button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-4 col-sm-6">
										<div class="listing-thumb">
											<img src="assets/images/listing-img.jpg" alt="" class="main-img" />
											<div class="info">
												<p class="title">West 96th Street</p>
												<p><i class="fa fa-tag"></i> $5,870</p>
												<p>Freshmen Score : 90%</p>
												<ul>
													<li><i class="fa fa-bed"></i> 2 Bed</li>
													<li><i class="fa fa-bath"></i> 1 Bath</li>
												</ul>
												<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
												<p>Posted: 04/30/19 06:04AM</p>
												<span class="status">Active</span>
												<div class="actions-btns">
													<button type="button" class="border-btn">Repost</button>
													<button type="button" class="border-btn">Request Feature</button>
												</div>
												<div class="list-actions-icons">
													<button><i class="fa fa-edit"></i></button>
													<button><i class="fa fa-copy"></i></button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
						<div class="tab-pane fade" id="listing-inactive">

							<!--List view listing-->
							<div class="listing-wrapper">
								<div class="listing-row">
									<div class="img-holder">
										<img src="assets/images/listing-img.jpg" alt="" class="main-img" />
									</div>
									<div class="info">
										<p class="title">West 96th Street</p>
										<p><i class="fa fa-tag"></i> $5,870</p>
										<p>Freshmen Score : 90%</p>
										<ul>
											<li><i class="fa fa-bed"></i> 2 Bed</li>
											<li><i class="fa fa-bath"></i> 1 Bath</li>
										</ul>
										<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
										<p>Posted: 04/30/19 06:04AM</p>
										<span class="status">Active</span>
										<div class="actions-btns">
											<span><img src="assets/images/edit-icon.png" alt=""></span>
											<span><img src="assets/images/copy-icon.png" alt=""></span>
											<button type="button" class="border-btn">Repost</button>
											<button type="button" class="border-btn">Request Feature</button>
										</div>
									</div>
								</div>

								<div class="listing-row">
									<div class="img-holder">
										<img src="assets/images/listing-img.jpg" alt="" class="main-img" />
									</div>
									<div class="info">
										<p class="title">West 96th Street</p>
										<p><i class="fa fa-tag"></i> $5,870</p>
										<p>Freshmen Score : 90%</p>
										<ul>
											<li><i class="fa fa-bed"></i> 2 Bed</li>
											<li><i class="fa fa-bath"></i> 1 Bath</li>
										</ul>
										<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
										<p>Posted: 04/30/19 06:04AM</p>
										<span class="status">Active</span>
										<div class="actions-btns">
											<span><img src="assets/images/edit-icon.png" alt=""></span>
											<span><img src="assets/images/copy-icon.png" alt=""></span>
											<button type="button" class="border-btn">Repost</button>
											<button type="button" class="border-btn">Request Feature</button>
										</div>
									</div>
								</div>

								<div class="listing-row">
									<div class="img-holder">
										<img src="assets/images/listing-img.jpg" alt="" class="main-img" />
									</div>
									<div class="info">
										<p class="title">West 96th Street</p>
										<p><i class="fa fa-tag"></i> $5,870</p>
										<p>Freshmen Score : 90%</p>
										<ul>
											<li><i class="fa fa-bed"></i> 2 Bed</li>
											<li><i class="fa fa-bath"></i> 1 Bath</li>
										</ul>
										<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
										<p>Posted: 04/30/19 06:04AM</p>
										<span class="status">Active</span>
										<div class="actions-btns">
											<span><img src="assets/images/edit-icon.png" alt=""></span>
											<span><img src="assets/images/copy-icon.png" alt=""></span>
											<button type="button" class="border-btn">Repost</button>
											<button type="button" class="border-btn">Request Feature</button>
										</div>
									</div>
								</div>

								<div class="listing-row">
									<div class="img-holder">
										<img src="assets/images/listing-img.jpg" alt="" class="main-img" />
									</div>
									<div class="info">
										<p class="title">West 96th Street</p>
										<p><i class="fa fa-tag"></i> $5,870</p>
										<p>Freshmen Score : 90%</p>
										<ul>
											<li><i class="fa fa-bed"></i> 2 Bed</li>
											<li><i class="fa fa-bath"></i> 1 Bath</li>
										</ul>
										<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
										<p>Posted: 04/30/19 06:04AM</p>
										<span class="status">Active</span>
										<div class="actions-btns">
											<span><img src="assets/images/edit-icon.png" alt=""></span>
											<span><img src="assets/images/copy-icon.png" alt=""></span>
											<button type="button" class="border-btn">Repost</button>
											<button type="button" class="border-btn">Request Feature</button>
										</div>
									</div>
								</div>
							</div>

							<!--Grid view listing-->
							<div class="grid-view-wrapper">
								<div class="row">
									<div class="col-lg-3 col-md-4 col-sm-6">
										<div class="listing-thumb">
											<img src="assets/images/listing-img.jpg" alt="" class="main-img" />
											<div class="info">
												<p class="title">West 96th Street</p>
												<p><i class="fa fa-tag"></i> $5,870</p>
												<p>Freshmen Score : 90%</p>
												<ul>
													<li><i class="fa fa-bed"></i> 2 Bed</li>
													<li><i class="fa fa-bath"></i> 1 Bath</li>
												</ul>
												<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
												<p>Posted: 04/30/19 06:04AM</p>
												<span class="status">Active</span>
												<div class="actions-btns">
													<button type="button" class="border-btn">Repost</button>
													<button type="button" class="border-btn">Request Feature</button>
												</div>
												<div class="list-actions-icons">
													<button><i class="fa fa-edit"></i></button>
													<button><i class="fa fa-copy"></i></button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-4 col-sm-6">
										<div class="listing-thumb">
											<img src="assets/images/listing-img.jpg" alt="" class="main-img" />
											<div class="info">
												<p class="title">West 96th Street</p>
												<p><i class="fa fa-tag"></i> $5,870</p>
												<p>Freshmen Score : 90%</p>
												<ul>
													<li><i class="fa fa-bed"></i> 2 Bed</li>
													<li><i class="fa fa-bath"></i> 1 Bath</li>
												</ul>
												<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
												<p>Posted: 04/30/19 06:04AM</p>
												<span class="status">Active</span>
												<div class="actions-btns">
													<button type="button" class="border-btn">Repost</button>
													<button type="button" class="border-btn">Request Feature</button>
												</div>
												<div class="list-actions-icons">
													<button><i class="fa fa-edit"></i></button>
													<button><i class="fa fa-copy"></i></button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-4 col-sm-6">
										<div class="listing-thumb">
											<img src="assets/images/listing-img.jpg" alt="" class="main-img" />
											<div class="info">
												<p class="title">West 96th Street</p>
												<p><i class="fa fa-tag"></i> $5,870</p>
												<p>Freshmen Score : 90%</p>
												<ul>
													<li><i class="fa fa-bed"></i> 2 Bed</li>
													<li><i class="fa fa-bath"></i> 1 Bath</li>
												</ul>
												<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
												<p>Posted: 04/30/19 06:04AM</p>
												<span class="status">Active</span>
												<div class="actions-btns">
													<button type="button" class="border-btn">Repost</button>
													<button type="button" class="border-btn">Request Feature</button>
												</div>
												<div class="list-actions-icons">
													<button><i class="fa fa-edit"></i></button>
													<button><i class="fa fa-copy"></i></button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-4 col-sm-6">
										<div class="listing-thumb">
											<img src="assets/images/listing-img.jpg" alt="" class="main-img" />
											<div class="info">
												<p class="title">West 96th Street</p>
												<p><i class="fa fa-tag"></i> $5,870</p>
												<p>Freshmen Score : 90%</p>
												<ul>
													<li><i class="fa fa-bed"></i> 2 Bed</li>
													<li><i class="fa fa-bath"></i> 1 Bath</li>
												</ul>
												<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
												<p>Posted: 04/30/19 06:04AM</p>
												<span class="status">Active</span>
												<div class="actions-btns">
													<button type="button" class="border-btn">Repost</button>
													<button type="button" class="border-btn">Request Feature</button>
												</div>
												<div class="list-actions-icons">
													<button><i class="fa fa-edit"></i></button>
													<button><i class="fa fa-copy"></i></button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-4 col-sm-6">
										<div class="listing-thumb">
											<img src="assets/images/listing-img.jpg" alt="" class="main-img" />
											<div class="info">
												<p class="title">West 96th Street</p>
												<p><i class="fa fa-tag"></i> $5,870</p>
												<p>Freshmen Score : 90%</p>
												<ul>
													<li><i class="fa fa-bed"></i> 2 Bed</li>
													<li><i class="fa fa-bath"></i> 1 Bath</li>
												</ul>
												<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
												<p>Posted: 04/30/19 06:04AM</p>
												<span class="status">Active</span>
												<div class="actions-btns">
													<button type="button" class="border-btn">Repost</button>
													<button type="button" class="border-btn">Request Feature</button>
												</div>
												<div class="list-actions-icons">
													<button><i class="fa fa-edit"></i></button>
													<button><i class="fa fa-copy"></i></button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-4 col-sm-6">
										<div class="listing-thumb">
											<img src="assets/images/listing-img.jpg" alt="" class="main-img" />
											<div class="info">
												<p class="title">West 96th Street</p>
												<p><i class="fa fa-tag"></i> $5,870</p>
												<p>Freshmen Score : 90%</p>
												<ul>
													<li><i class="fa fa-bed"></i> 2 Bed</li>
													<li><i class="fa fa-bath"></i> 1 Bath</li>
												</ul>
												<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
												<p>Posted: 04/30/19 06:04AM</p>
												<span class="status">Active</span>
												<div class="actions-btns">
													<button type="button" class="border-btn">Repost</button>
													<button type="button" class="border-btn">Request Feature</button>
												</div>
												<div class="list-actions-icons">
													<button><i class="fa fa-edit"></i></button>
													<button><i class="fa fa-copy"></i></button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-4 col-sm-6">
										<div class="listing-thumb">
											<img src="assets/images/listing-img.jpg" alt="" class="main-img" />
											<div class="info">
												<p class="title">West 96th Street</p>
												<p><i class="fa fa-tag"></i> $5,870</p>
												<p>Freshmen Score : 90%</p>
												<ul>
													<li><i class="fa fa-bed"></i> 2 Bed</li>
													<li><i class="fa fa-bath"></i> 1 Bath</li>
												</ul>
												<p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
												<p>Posted: 04/30/19 06:04AM</p>
												<span class="status">Active</span>
												<div class="actions-btns">
													<button type="button" class="border-btn">Repost</button>
													<button type="button" class="border-btn">Request Feature</button>
												</div>
												<div class="list-actions-icons">
													<button><i class="fa fa-edit"></i></button>
													<button><i class="fa fa-copy"></i></button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection