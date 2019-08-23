@extends('layouts.app')
@section('title', 'No Fee Rental | Search')
@section('content')
    <div class="header-bg inner-pages-banner"></div>
    <div class="clearfix"></div>
    <section class="property-wrap main-wrapper">
        <div class="container-lg">
            <div class='row'>
                <div class='col-md-3'>
                    <div class='search-box'>
                        <form class='search-form'>
                            <input class='form-control' placeholder='ex: Ruby, Rails,' type='text'>
                            <button class='btn btn-link search-btn'>
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dropdown dropdown-price-range">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                            Price Range
                        </button>
                        <div class="dropdown-menu">
                            <div class="form-group">
                                <div class="slider-wrapper">
                                    <input type="number" min=0 max="9900" oninput="validity.valid||(value='0');" id="min_price" class="price-range-field input-style" />
                                    <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
                                    <input type="number" min=0 max="10000" oninput="validity.valid||(value='10000');" id="max_price" class="price-range-field input-style" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="dropdown dropdown-price-range">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                            Size
                        </button>
                        <div class="dropdown-menu size-dropdown">
                            <label class="label">Beds</label>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-secondary">Any</button>
                                <button type="button" class="btn btn-secondary">Studio</button>
                                <button type="button" class="btn btn-secondary">1</button>
                                <button type="button" class="btn btn-secondary">2</button>
                                <button type="button" class="btn btn-secondary">3</button>
                                <button type="button" class="btn btn-secondary">4+</button>
                            </div>
                            <label class="label">Beds</label>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-secondary">Any</button>
                                <button type="button" class="btn btn-secondary">Studio</button>
                                <button type="button" class="btn btn-secondary">1</button>
                                <button type="button" class="btn btn-secondary">2</button>
                                <button type="button" class="btn btn-secondary">3</button>
                                <button type="button" class="btn btn-secondary">4+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="#" class="btn update-btn">Update </a>
                </div>
            </div>
        </div>

        <div class="container-lg new-found-results ">
            <div class="row">
                <div class="col-md-8 show-class">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>{{ $results->total() }} Results found </h4>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sel1" style="    position: absolute;margin-left: -80px;padding: 10px;">Sort By:</label>
                                <select class="form-control" id="sel1">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--List view listing-->
                    <div class="listing-wrapper ">
                        @foreach($results as $result)
                            <div class="listing-row">
                            <div class="img-holder">
                                <img src="{{ !empty($result->thumbnail)
                                    ? asset('storage/'.$result->thumbnail)
                                    : asset('storage/uploads/listing/thumbnails/default.jpg')
                                }}" alt="" class="main-img" />
                                <i class="fa fa-star"></i>
                                <label>${{ $result->rent }}/month</label>
                            </div>
                            <div class="info">
                                <p class="title">{{ $result->street_address }}</p>
                                <p><i class="fa fa-tag"></i> ${{ $result->rent }}</p>
                                <p>Freshmen Score : 90%</p>
                                <ul>
                                    <li><i class="fa fa-bed"></i> {{ $result->bedrooms }} Bed</li>
                                    <li><i class="fa fa-bath"></i> {{ $result->baths }} Bath</li>
                                </ul>
                                <p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
                                <p>Posted: {{ date('m/d/y h:m:i', strtotime($result->created_at)) }}</p>

                                <div class="actions-btns">
                                    <button type="button" class="border-btn">Repost</button>
                                    <button type="button" class="border-btn">Request Feature</button>
                                </div>
                            </div>
                        </div>
                            {!! Form::hidden('map_location', $result->map_location, ['class' => 'map_location']) !!}
                        @endforeach
                    </div>
                    {{ $results->render() }}
                </div>
                <div class="col-md-4 propertyy-map-sec">
                    <div id="map"></div>
                    <div class="minimize-button">
                        <i class="fa fa-arrow-left aroows"> </i>
                        <span class="fa fa-arrow-right aroows"> </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
{!! HTML::script('assets/js/map.js') !!}
@endsection
