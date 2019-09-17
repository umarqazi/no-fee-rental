<section class="featured-properties">
    <div class="container-lg">
        <h2 class="text-center">Featured Properties</h2>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#tab1">Recent</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#tab2">Cheapest</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#tab3">Popular</a>
            </li><li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#tab4">Pet Policy</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content wow fadeInUp" data-wow-delay="0.2s">
            <div class="tab-pane active" id="tab1">
                <div class="property-listing">
                    @foreach($featured_listings as $key => $fl)
                    <div class="property-thumb">
                        <div class="check-btn">
                            <a href="{{ route('listing.detail', $fl->id) }}"><button class="btn-default" data-toggle="modal" data-target="#check-availability">View Details</button></a>
                        </div>
                        <span class="heart-icon"></span>
                        <img src="{{ asset('storage/'.$fl->thumbnail) }}" alt="" class="main-img" />
                        <div class="info">
                            <a href="#">
                                <p>$ {{ $fl->rent }} </p>
                                <ul>
                                    <li><i class="fa fa-bed"></i> {{ $fl->bedrooms }}</li>
                                    <li><i class="fa fa-bath"></i> {{ $fl->baths }}</li>
                                </ul>
                            </a>
                            <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="tab2">
                <div class="property-listing">
                    <div class="property-thumb">
                        <div class="check-btn">
                            <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                        </div>
                        <span class="heart-icon"></span>
                        <img src="assets/images/gallery-img.jpg" alt="" class="main-img" />
                        <div class="info">
                            <a href="#" class="info-link-text">
                                <p> $3,200 / Month </p> <small> 2 bed , 1 bath </small>
                                <p> 88 Get Rich Avenue, Manhattan, Ny </p>
                            </a>
                            <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                        </div>
                        <div class="feaure-policy-text">
                            <p>$3,200 / Month </p>
                            <span>2 bed , 1 bath </span>
                        </div>
                    </div>
                    <div class="property-thumb">
                        <div class="check-btn">
                            <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                        </div>
                        <span class="heart-icon"></span>
                        <img src="assets/images/gallery-img.jpg" alt="" class="main-img" />
                        <div class="info">
                            <a href="#">
                                <p>$3,200 / Month </p>
                                <ul>
                                    <li><i class="fa fa-bed"></i> 2</li>
                                    <li><i class="fa fa-bath"></i> 2</li>
                                </ul>
                            </a>
                            <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                        </div>
                    </div>
                    <div class="property-thumb">
                        <div class="check-btn">
                            <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                        </div>
                        <span class="heart-icon"></span>
                        <img src="assets/images/gallery-img.jpg" alt="" class="main-img" />
                        <div class="info">
                            <a href="#">
                                <p>$3,200 / Month </p>
                                <ul>
                                    <li><i class="fa fa-bed"></i> 2</li>
                                    <li><i class="fa fa-bath"></i> 2</li>
                                </ul>
                            </a>
                            <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab3">
                <div class="property-listing">
                    <div class="property-thumb">
                        <div class="check-btn">
                            <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                        </div>
                        <span class="heart-icon"></span>
                        <img src="assets/images/gallery-img.jpg" alt="" class="main-img" />
                        <div class="info">
                            <a href="#">
                                <p>$3,200 / Month </p>
                                <ul>
                                    <li><i class="fa fa-bed"></i> 2</li>
                                    <li><i class="fa fa-bath"></i> 2</li>
                                </ul>
                            </a>
                            <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                        </div>
                    </div>
                    <div class="property-thumb">
                        <div class="check-btn">
                            <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                        </div>
                        <span class="heart-icon"></span>
                        <img src="assets/images/gallery-img.jpg" alt="" class="main-img" />
                        <div class="info">
                            <a href="#">
                                <p>$3,200 / Month </p>
                                <ul>
                                    <li><i class="fa fa-bed"></i> 2</li>
                                    <li><i class="fa fa-bath"></i> 2</li>
                                </ul>
                            </a>
                            <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                        </div>
                    </div>
                    <div class="property-thumb">
                        <div class="check-btn">
                            <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                        </div>
                        <span class="heart-icon"></span>
                        <img src="assets/images/gallery-img.jpg" alt="" class="main-img" />
                        <div class="info">
                            <a href="#">
                                <p>$3,200 / Month </p>
                                <ul>
                                    <li><i class="fa fa-bed"></i> 2</li>
                                    <li><i class="fa fa-bath"></i> 2</li>
                                </ul>
                            </a>
                            <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="tab4">
                <div class="property-listing">
                    <div class="property-thumb">
                        <div class="check-btn">
                            <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                        </div>
                        <span class="heart-icon"></span>
                        <img src="assets/images/gallery-img.jpg" alt="" class="main-img" />
                        <div class="info">
                            <a href="#">
                                <p>$3,200 / Month </p>
                                <ul>
                                    <li><i class="fa fa-bed"></i> 2</li>
                                    <li><i class="fa fa-bath"></i> 2</li>
                                </ul>
                            </a>
                            <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                        </div>
                    </div>
                    <div class="property-thumb">
                        <div class="check-btn">
                            <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                        </div>
                        <span class="heart-icon"></span>
                        <img src="assets/images/gallery-img.jpg" alt="" class="main-img" />
                        <div class="info">
                            <a href="#">
                                <p>$3,200 / Month </p>
                                <ul>
                                    <li><i class="fa fa-bed"></i> 2</li>
                                    <li><i class="fa fa-bath"></i> 2</li>
                                </ul>
                            </a>
                            <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                        </div>
                    </div>
                    <div class="property-thumb">
                        <div class="check-btn">
                            <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                        </div>
                        <span class="heart-icon"></span>
                        <img src="assets/images/gallery-img.jpg" alt="" class="main-img" />
                        <div class="info">
                            <a href="#">
                                <p>$3,200 / Month </p>
                                <ul>
                                    <li><i class="fa fa-bed"></i> 2</li>
                                    <li><i class="fa fa-bath"></i> 2</li>
                                </ul>
                            </a>
                            <a href="javascript:void(0)" class="btn viewfeature-btn"> View </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="#" class="btn-default">view all</a>
            </div>
        </div>
    </div>
</section>
