
@extends('layouts.app')
@section('title', 'Press')
@section('content')

    @php
        $paged = isset($_GET['page']) ? $_GET['page'] : 1;
        $args = array(
            'post_type' => 'press_cptui',
            'post_status' => 'publish',
            'posts_per_page' => WP_PAGINATION,
            'paged' => $paged
        );

        $params = [
            'title' => 'press_page_banner_title',
            'sub_title' => 'press_page_banner_sub_title',
            'has_banner' => true,
            'header'  => true,
            'page_id' => 'options',
            'banner_image' => 'press_page_banner_image',
            'has_post' => false,
            'is_slug' => true
        ];

        $press = new WP_Query($args);
        $press_counter = 2;
    @endphp

    @include('layouts.wp_master_layout', $params)

    @if ($press->have_posts())
        <section class="page-wraper-margin-bottom">
            @while($press->have_posts())
                @php $press->the_post() @endphp
                <div class="sec-content-padd {{ $press_counter % 2 == 0 ? 'bg-color-section' : '' }}">
                    <div class="container">
                        <div class="our-passion">
                            <h3>{!! the_title() !!}</h3>
                            {!! the_excerpt() !!}
                            <p><a href="{{ route('web.pressDetail', $press->post->post_name) }}">Read More</a></p>
                        </div>
                    </div>
                </div>
                @php $press_counter++ @endphp
            @endwhile
            {!! pagination($press->found_posts, WP_PAGINATION) !!}
        </section>
    @endif

@endsection
