<div class="header-bg">
    <div class="banner-wrapper wow fadeInUp " data-wow-delay="0.2s">
        <h1>NYC’s Premier Source For NO FEE Rentals</h1>
        <div class="search-property">
            <input type="text" class="search-fld" placeholder="Enter an address, Neighborhood, City or Zip Code" />
            <select class="custom-select-input">
                <option>Up To $5,000</option>
                <option>Up To $5,000</option>
                <option>Up To $5,000</option>
                <option>Up To $5,000</option>
            </select>
            <select class="custom-select-input size-input">
                <option>Size</option>
                <option>Size</option>
                <option>Size</option>
                <option>Size</option>
            </select>
            <button class="search-btn">Search</button>
        </div>
        <a href="" class="advance-search" data-toggle="modal" data-target="#advance-search">+Advanced Search</a>
    </div>
</div>

<!-- modal -->
<!-- Advance Search -->

<div class="modal fade" id="advance-search">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Advance Search</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="label">Location</label>
                            <input placeholder="Enter address, neighborhood or street" class="input-style enter-address" />
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="label">Price Range</label>
                            <div class="slider-wrapper">
                                <input type="number" min=0 max="9900" oninput="validity.valid||(value='0');" id="min_price" class="price-range-field input-style" />
                                <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
                                <input type="number" min=0 max="10000" oninput="validity.valid||(value='10000');" id="max_price" class="price-range-field input-style" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label">Beds <span>(Select all that applies)</span></label>
                            <ul class="select-bed-options">
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="beds1" name="example1">
                                        <label class="custom-control-label" for="beds1">Any</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="beds2" name="example1">
                                        <label class="custom-control-label" for="beds2">Studio</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="beds3" name="example1">
                                        <label class="custom-control-label" for="beds3">1</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="beds4" name="example1">
                                        <label class="custom-control-label" for="beds4">2</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="beds5" name="example1">
                                        <label class="custom-control-label" for="beds5">3</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="beds6" name="example1">
                                        <label class="custom-control-label" for="beds6">4+</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label">Baths <span>(Select all that applies)</span></label>
                            <ul class="select-bed-options">
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="bath1" name="example2">
                                        <label class="custom-control-label" for="bath1">Any</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="bath2" name="example2">
                                        <label class="custom-control-label" for="bath2">Studio</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="bath3" name="example2">
                                        <label class="custom-control-label" for="bath3">1</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="bath4" name="example2">
                                        <label class="custom-control-label" for="bath4">2</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="bath5" name="example2">
                                        <label class="custom-control-label" for="bath5">3</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="bath6" name="example2">
                                        <label class="custom-control-label" for="bath6">4+</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label">Keywords</label>
                            <input type="text" class="input-style" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label">Open House</label>
                            <select class="custom-select-list">
                                <option>Select</option>
                                <option>Select</option>
                                <option>Select</option>
                                <option>Select</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="label">Amenities</label>
                            <div class="row">
                                <div class="col-lg-6">
                                    <ul class="search-features-listing">
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="amenities1" name="features">
                                                <label class="custom-control-label" for="amenities1">Balcony</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="amenities2" name="features">
                                                <label class="custom-control-label" for="amenities2">Dishwasher</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="amenities3" name="features">
                                                <label class="custom-control-label" for="amenities3">Concierge</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="amenities4" name="features">
                                                <label class="custom-control-label" for="amenities4">Elevator</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="amenities5" name="features">
                                                <label class="custom-control-label" for="amenities5">Furnished</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <ul class="search-features-listing">
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="amenities6" name="features">
                                                <label class="custom-control-label" for="amenities6">Gym</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="amenities7" name="features">
                                                <label class="custom-control-label" for="amenities7">In-unit Laundry</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="amenities8" name="features">
                                                <label class="custom-control-label" for="amenities8">On-site Parking</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="amenities9" name="features">
                                                <label class="custom-control-label" for="amenities9">Terrace</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="amenities10" name="features">
                                                <label class="custom-control-label" for="amenities10">Pets Allowed</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label">Unit Features</label>
                            <ul class="search-features-listing">
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="unit1" name="features">
                                        <label class="custom-control-label" for="unit1">Furnished</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="unit2" name="features">
                                        <label class="custom-control-label" for="unit3">Laundry in Unit</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="unit4" name="features">
                                        <label class="custom-control-label" for="unit4">Private Ourdoor Space</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="unit5" name="features">
                                        <label class="custom-control-label" for="unit5">Parking Space</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label">Pet Policy</label>
                            <ul class="search-features-listing">
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="pet1" name="features">
                                        <label class="custom-control-label" for="pet1">Cats Allowed</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="pet2" name="features">
                                        <label class="custom-control-label" for="pet2">Dogs Allowed</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label">Year Built</label>
                            <div class="year-built">
                                <input type="text" class="input-style" />
                                <span>To</span>
                                <input type="text" class="input-style" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label">Square Feet</label>
                            <div class="year-built">
                                <input type="text" class="input-style" />
                                <span>To</span>
                                <input type="text" class="input-style" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 text-center mt-4 mb-4">
                        <button type="button" class="btn-default">Search</button>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>