

{!! Form::hidden('user_id') !!}
{!! Form::hidden('visibility') !!}
@if($action !== 'Copy')
    {!! Form::hidden('unique_slug') !!}
@endif
{!! Form::hidden('building_id') !!}
{!! Form::hidden('neighborhood_id') !!}

@if(isset($listing->thumbnail))
    {!! Form::hidden('old_thumbnail', $listing->thumbnail) !!}
@endif

@if(isset($listing->freshness_score))
    {!! Form::hidden('freshness_score', null) !!}
@endif