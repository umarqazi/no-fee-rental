<style>
    .ui-menu {
        max-width: 850px;
        width: 100%;
    }
</style>
<div class="header-bg">
    <div class="banner-wrapper wow fadeInUp " data-wow-delay="0.2s">
        <h1>NYC’s Premier Source For NO FEE Rentals</h1>
        {!! Form::open(['url' => route('list.search'), 'method' => 'get', 'id' => 'search']) !!}
        <div class="search-property">

            <div style="position:relative;">
                <i class="fas fa-search"></i>
                {!! Form::text('neighborhoods', null, ['id' => 'neigh', 'placeholder' => 'Enter Neighborhood', 'class' => 'search-fld']) !!}
                {{--<select class="custom-select-input">
                    <option>Up To $5,000</option>
                    <option>Up To $5,000</option>
                    <option>Up To $5,000</option>
                    <option>Up To $5,000</option>
                </select>--}}
                {{--<select class="custom-select-input size-input">
                    <option>Size</option>
                    <option>Size</option>
                    <option>Size</option>
                    <option>Size</option>
                </select>--}}
                {!! Form::select('priceRange',  config('formfields.search.price') ,null, ['class' => 'custom-select-input']) !!}
                {!! Form::select('beds', config('formfields.search.beds'),null, ['class' => 'custom-select-input size-input']) !!}

            </div>
            {!! Form::button('Search', ['class' => 'search-btn', 'type' => 'submit']) !!}

        </div>
        <span id="search-error-message"></span>
        {!! Form::close() !!}

        <a href="javascript:void(0);" class="advance-search" data-toggle="modal" data-target="#advance-search">+ Advanced Search</a>
    </div>
</div>
{{--Advance Search--}}
@include('modals.advance_search')
