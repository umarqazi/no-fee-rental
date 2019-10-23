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
            <i class="fas fa-search"></i>
            <div>{!! Form::text('neighborhoods', null, ['id' => 'neigh', 'placeholder' => 'Enter Neighborhood', 'class' => 'search-fld']) !!}</div>
            {!! Form::button('Search', ['class' => 'search-btn', 'type' => 'submit']) !!}
        </div>
        {!! Form::close() !!}
        <a href="" class="advance-search" data-toggle="modal" data-target="#advance-search">+ Advanced Search</a>
    </div>
</div>
{{--Advance Search--}}
@include('modals.advance_search')
