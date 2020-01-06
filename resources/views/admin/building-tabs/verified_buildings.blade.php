
<!--List view listing-->
<div class="listing-wrapper">
    @foreach($buildings->no_fee as $building)
        <div class="listing-row">
            <div class="img-holder">
                <img src="{{ asset($building->thumbnail ?? DLI) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
            </div>
            <div class="info">
                <p class="title">{{ $building->address }}</p>
                <p class="title">Total Apartments: {{ count($building->listings) }}</p>
                <p>Posted On: {{ $building->created_at->format("m/d/y H:m A") }}</p>
                <span class="status" style="background-color:#223970;">No Fee Building</span>
                <div class="actions-btns">
                    <a href="{{ route(whoAmI().'.editBuilding', $building->id) }}">
                        <span><img src="{{asset('assets/images/edit-icon.png')}}" alt=""></span>
                    </a>
                    <a href="{{ route(whoAmI().'.feeBuilding', $building->id) }}" title="Make this building fee">
                        <button type="button" class="border-btn">Fee</button>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
    @if($buildings->no_fee->total() < 1)
        <p class="null">No Record Found</p>
    @endif
    {!! $buildings->no_fee->render() !!}
</div>

<!--Grid view listing-->
<div class="grid-view-wrapper">
    <div class="row">
        @foreach($buildings->no_fee as $building)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="listing-thumb">
                    <img src="{{ asset( $building->thumbnail ?? DLI ) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
                    <div class="info">
                        <p class="title">
                            {{ $building->address }}
                        </p>
                        <p>Posted On: {{ $building->created_at->format("m/d/y H:m A") }}</p>
                        <span class="status" style="background-color:#223970;">No Fee Building</span>
                        <div class="list-actions-icons">
                            <a href="{{ route(whoAmI().'.editBuilding', $building->id) }}"><button><i class="fa fa-edit"></i></button></a>
                        </div>
                        <div class="actions-btns">
                            <a href="{{ route(whoAmI().'.feeBuilding', $building->id) }}" title="Make this building fee">
                                <button type="button" class="border-btn">Fee</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if($buildings->no_fee->total() < 1)
            <p class="null">No Record Found</p>
        @endif
    </div>
    {!! $buildings->no_fee->render() !!}
</div>
