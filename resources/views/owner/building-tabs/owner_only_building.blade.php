
<!--List view listing-->
<div class="listing-wrapper">
    @foreach($buildings->owner_only as $building)
        <div class="listing-row">
            <div class="img-holder">
                <img src="{{ asset($building->thumbnail ?? DLI) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
            </div>
            <div class="info">
                <p class="title">{{ $building->address }}</p>
                <p class="title">Total Apartments: {{ count($building->listings) }}</p>
                <p>Posted On: {{ $building->created_at->format("m/d/y H:m A") }}</p>
                @if($building->type === FEE)
                    <span class="status" style="background-color:red;">Fee Building</span>
                @else
                    <span class="status" style="background-color:#223970;">No Fee Building</span>
                @endif
                <div class="actions-btns">
                    <a href="{{ route(whoAmI().'.editBuilding', $building->id) }}">
                        <span><img src="{{asset('assets/images/edit-icon.png')}}" alt=""></span>
                    </a>
                    @if($building->type === FEE)
                        <a href="{{ route(whoAmI().'.noFeeBuilding', $building->id) }}" title="Make this building No Fee">
                            <button type="button" class="border-btn">No Fee</button>
                        </a>
                    @else
                        <a href="{{ route(whoAmI().'.feeBuilding', $building->id) }}" title="Make this building Fee">
                            <button type="button" class="border-btn">Fee</button>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    @if($buildings->owner_only->total() < 1)
        <p class="null">No Record Found</p>
    @endif
    {!! $buildings->owner_only->render() !!}
</div>

<!--Grid view listing-->
<div class="grid-view-wrapper">
    <div class="row">
        @foreach($buildings->owner_only as $building)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="listing-thumb">
                    <img src="{{ asset( $building->thumbnail ?? DLI ) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
                    <div class="info">
                        <p class="title">
                            {{ $building->address }}
                        </p>
                        <p>Posted On: {{ $building->created_at->format("m/d/y H:m A") }}</p>
                        @if($building->type === FEE)
                            <span class="status" style="background-color:red;">Fee Building</span>
                        @else
                            <span class="status" style="background-color:#223970;">No Fee Building</span>
                        @endif
                        <div class="list-actions-icons">
                            <a href="{{ route(whoAmI().'.editBuilding', $building->id) }}"><button><i class="fa fa-edit"></i></button></a>
                        </div>
                        <div class="actions-btns">
                            @if($building->type === FEE)
                                <a href="{{ route(whoAmI().'.noFeeBuilding', $building->id) }}" title="Make this building No Fee">
                                    <button type="button" class="border-btn">No Fee</button>
                                </a>
                            @else
                                <a href="{{ route(whoAmI().'.feeBuilding', $building->id) }}" title="Make this building Fee">
                                    <button type="button" class="border-btn">Fee</button>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if($buildings->owner_only->total() < 1)
            <p class="null">No Record Found</p>
        @endif
    </div>
    {!! $buildings->owner_only->render() !!}
</div>
