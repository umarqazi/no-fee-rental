
{{--Normal Search--}}

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

{{--Advance Search--}}
@include('features.advance_search')
