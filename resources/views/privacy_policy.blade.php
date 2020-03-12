
@extends('layouts.app')
@section('title', 'Privacy Policy')
@section('content')

    @php
        $params = [
            'title' => 'title',
            'sub_title' => 'sub_title',
            'has_banner' => true,
            'header'  => true,
            'page_id' => 3,
            'has_post' => true,
            'is_slug' => false
        ];
    @endphp

    @include('layouts.wp_master_layout', $params)

@endsection
