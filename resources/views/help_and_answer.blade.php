
@extends('layouts.app')
@section('title', 'Help and Answer')
@section('content')

    @php
        $paged = isset($_GET['page']) ? $_GET['page'] : 1;
        $args = array(
            'post_type' => 'help_and_answers',
            'post_status' => 'publish',
            'posts_per_page' => 3,
            'paged' => $paged
        );

        $params = [
            'title' => 'banner_title',
            'sub_title' => 'banner_sub_title',
            'has_banner' => true,
            'header'  => true,
            'page_id' => 'options',
            'banner_image' => 'banner_image',
            'has_post' => false,
            'is_slug' => true
        ];

        $help_and_answers = new WP_Query($args);
        $press_counter = 2;
    @endphp

    @include('layouts.wp_master_layout', $params)

    @if ($help_and_answers->have_posts())
        <section class="page-wraper-margin-bottom">
            @while($help_and_answers->have_posts())
                @php $help_and_answers->the_post() @endphp
                    <div class="sec-content-padd {{ $press_counter % 2 == 0 ? 'bg-color-section' : '' }}">
                        <div class="container">
                            <div class="our-passion">
                                <h3>{!! the_title() !!}</h3>
                                {!! the_excerpt() !!}
                                <p><a href="{{ route('web.helpAndAnswerDetail', $help_and_answers->post->post_name) }}">Read More</a></p>
                            </div>
                        </div>
                    </div>
                    @php $press_counter++ @endphp
            @endwhile
                   {!! pagination($help_and_answers->found_posts, 3) !!}
        </section>
    @endif

@endsection
