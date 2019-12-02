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
                {!! Form::select('max_price', [
           "" => "Up To Price",
           '1000'  => "Up To $1,000",
           '2000'  => "Up To $2,000",
           '3000'  => "Up To $3,000",
           '4000'  => "Up To $4,000",
           '5000'  => "Up To $5,000",],null, ['class' => 'custom-select-input']) !!}
                {!! Form::select('square_max', [
           "" => "Size",
           '100'  => "100 square",
           '200'  => "200 square",
           '300'  => "300 square",
           '400'  => "400 square",
           '500'  => "500 square",],null, ['class' => 'custom-select-input size-input']) !!}

            </div>
            {!! Form::button('Search', ['class' => 'search-btn', 'type' => 'submit']) !!}

        </div>
        {!! Form::close() !!}
        <a href="javascript:void(0);" class="advance-search" data-toggle="modal" data-target="#advance-search">+ Advanced Search</a>
    </div>
</div>
{{--Advance Search--}}
@include('modals.advance_search')
