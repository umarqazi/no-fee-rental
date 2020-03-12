
@extends('layouts.app')
@section('title', 'Feedback')
@section('content')

    @php
        $params = [
            'title' => 'title',
            'sub_title' => 'sub_title',
            'has_banner' => true,
            'page_id' => 187,
            'header'  => true,
            'has_post' => true,
            'is_slug' => false
        ];
    @endphp

    @include('layouts.wp_master_layout', $params)

@endsection
