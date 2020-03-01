@extends('secured-layouts.app')
@section('title', 'Saved Searches')
@section('content')
    <style>
        .property-info p{
            color: inherit;
        }
    </style>
    {{--    @dd($searches[0]->keywords)--}}
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Saved Searches</h1>
        </div>
        <div class="block saved-search-container">
            <div class="block-body">
                <div class="search-header">
                    <div>
                        Name of Saved Search
                    </div>
                    <div>
                        Search Criteria
                    </div>
                    <div>
                        View
                    </div>
                    <div>
                        Delete
                    </div>
                </div>
                @if(count($searches) > 0)
                    @foreach($searches as $search)
                        @php $criteria = toObject($search->keywords); @endphp
                        <div class="search-list">
                            <div>
                                <div class="property-info">
                                    {{-- <img src="assets/images/listing-img.jpg" alt="">--}}
                                    <div class="info">
                                        <p><strong>Beds: {{ !empty($criteria->beds) ? implode(',', $criteria->beds) : 'Any' }}</strong></p>
                                        <p><strong>Baths: {{ !empty($criteria->baths) ? implode(',', $criteria->baths) : 'Any' }}</strong></p>
                                        <p><strong>Neighborhood: {!! !empty($criteria->neighborhoods)
                                            ? "<a href='javascript:void(0);'
                                                title='".implode(', ', $criteria->neighborhoods)."'>".
                                                str_formatting(count($criteria->neighborhoods), 'Neighborhood')
                                                ."</a>"
                                            : 'N/A' !!}</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>Price: </p>
                                <p>Min Price: ${{ number_format($criteria->min_price) }}</p>
                                <p>Max Price: ${{ number_format($criteria->max_price) }}</p>
                            </div>
                            <div>
                                <a href="{{ $search->url }}"><i class="fa fa-eye view-icon"></i></a>
                            </div>
                            <div>
                                <a href="javascript:void(0);" class="remove-save-search" id="{{ $search->id }}"><i class="fa fa-trash view-icon"></i></a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="save-search-keywords">
                        <span>No Keywords Found</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
    {!! HTML::script('assets/js/save-search.js') !!}
@endsection
