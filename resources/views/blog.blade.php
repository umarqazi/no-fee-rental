
@extends('layouts.app')
@section('title', 'Blog')
@section('content')
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    @php
        $paged = isset($_GET['page']) ? $_GET['page'] : 1;
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => WP_PAGINATION,
            'paged' => $paged
        );

        $params = [
            'title' => 'press_page_banner_title',
            'sub_title' => 'press_page_banner_sub_title',
            'has_banner' => false,
            'header'  => true,
            'page_id' => 'options',
            'banner_image' => 'press_page_banner_image',
            'has_post' => false,
            'is_slug' => true
        ];

        $blog = new WP_Query($args);
        $press_counter = 2;
    @endphp

    @include('layouts.wp_master_layout', $params)

    @if($blog->have_posts())

        <section class="inner-pages rental-guides-container blog-page">
            @while($blog->have_posts())
                @php
                    $blog->the_post();
                    $cls = "";
                    $cls1 = "";
                    if(($blog->current_post + 1) % 2 == 0) {
                        $cls = " right-content";
                        $cls1 = " order-lg-5";
                    }
                @endphp

                <div class="rental-guides-row<?php echo $cls; ?>">
                    <div class="row align-items-center">
                        <div class="col-lg-7<?php echo $cls1; ?>">
                            <img src="{!! get_the_post_thumbnail_url(get_the_ID()) !!}" alt="" class="main-img" />
                        </div>
                        <div class="col-lg-5">
                            <div class="info">
                                <h3>{!! the_title() !!}<br>
                                    <span>{!! get_the_date('j M Y') !!}</span>
                                </h3>
                                {!! the_excerpt() !!}
                                <a href="{{ route('web.blogDetail', $blog->post->post_name) }}">READ MORE</a>
                            </div>
                        </div>
                    </div>
                </div>

            @endwhile

            <div class="text-center mt-3">
                {!! pagination($blog->found_posts, WP_PAGINATION) !!}
            </div>

        </section>
    @endif

@endsection
