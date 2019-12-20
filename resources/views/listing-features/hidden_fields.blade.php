

{!! Form::hidden('visibility') !!}
{!! Form::hidden('user_id') !!}
@if(isset($listing->thumbnail))
    {!! Form::hidden('old_thumbnail', $listing->thumbnail) !!}
@endif
@if(isset($listing->building_id))
    {!! Form::hidden('building_id', $listing->building_id) !!}
@endif

@if(isset($listing->freshness_score))
    {!! Form::hidden('freshness_score', null) !!}
@endif