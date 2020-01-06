
<!--List view listing-->
<div class="listing-wrapper">
    @foreach($buildings->fee as $building)
        <div class="listing-row">
            <div class="img-holder">
                <img src="{{ asset($building->thumbnail ?? DLI) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
            </div>
            <div class="info">
                <p class="title">{{ $building->address }}</p>
                <p class="title">Total Apartments: {{ count($building->listings) }}</p>
                <p>Posted On: {{ $building->created_at->format("m/d/y H:m A") }}</p>
                <span class="status" style="background-color:red;">Fee Building</span>
                <div class="actions-btns">
                    <a href="{{ route(whoAmI().'.editBuilding', $building->id) }}">
                        <span><img src="{{asset('assets/images/edit-icon.png')}}" alt=""></span>
                    </a>
                    <a href="{{ route(whoAmI().'.noFeeBuilding', $building->id) }}" title="Make this building No Fee">
                        <button type="button" class="border-btn">No Fee</button>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
    @if($buildings->fee->total() < 1)
        <p class="null">No Record Found</p>
    @endif
    {!! $buildings->fee->render() !!}
</div>

<!--Grid view listing-->
<div class="grid-view-wrapper">
    <div class="row">
        @foreach($buildings->fee as $building)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="listing-thumb">
                    <img src="{{ asset( $building->thumbnail ?? DLI ) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
                    <div class="info">
                        <p class="title">
                            {{ $building->address }}
                        </p>
                        <p>Posted On: {{ $building->created_at->format("m/d/y H:m A") }}</p>
                        <span class="status" style="background-color:red;">Fee Building</span>
                        <div class="list-actions-icons">
                            <a href="{{ route(whoAmI().'.editBuilding', $building->id) }}"><button><i class="fa fa-edit"></i></button></a>
                        </div>
                        <div class="actions-btns">
                            <a href="{{ route(whoAmI().'.noFeeBuilding', $building->id) }}" title="Make this building No Fee">
                                <button type="button" class="border-btn">No Fee</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if($buildings->fee->total() < 1)
            <p class="null">No Record Found</p>
        @endif
    </div>
    {!! $buildings->fee->render() !!}
</div>
