
@extends('layouts.app')
@section('title', 'Rent Calculator')
@section('content')

    @php
        $params = [
            'title' => 'title',
            'sub_title' => 'sub_title',
            'has_banner' => true,
            'page_id' => 233,
            'header'  => true,
            'has_post' => true,
            'is_slug' => false
        ];
    @endphp

    @include('layouts.wp_master_layout', $params)

@endsection
