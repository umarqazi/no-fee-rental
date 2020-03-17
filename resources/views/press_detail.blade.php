@php $data = collect($data)->first() @endphp
@extends('layouts.app')
@section('title', $data->post_title)
@section('content')
    {!! HTML::style('blog/wp-content/themes/nofeerentals/assets/css/main.css') !!}

    @php
        $params = [
            'title' => 'press_page_banner_title',
            'sub_title' => 'press_page_banner_sub_title',
            'has_banner' => true,
            'header'  => false,
            'page_id' => 'options',
            'banner_image' => 'press_page_banner_image',
            'has_post' => false,
            'is_slug' => true
        ];
    @endphp

    @include('layouts.wp_master_layout', $params)

    @if (have_posts())
        <section class="inner-pages about-us">
            <div class="container">
                @while(have_posts())
                    @php the_post() @endphp
                    <div class="our-passion">
                        <h3>{!! the_title() !!}</h3>
                        {!! the_content() !!}
                    </div>
                @endwhile
            </div>
        </section>
    @endif

@endsection
