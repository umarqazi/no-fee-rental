@php $data = collect($data)->first() @endphp
@extends('layouts.app')
@section('title', $data->post_title)
@section('content')

    @php
        $params = [
            'title' => 'press_page_banner_title',
            'sub_title' => 'press_page_banner_sub_title',
            'has_banner' => false,
            'header'  => false,
            'page_id' => 'options',
            'banner_image' => 'press_page_banner_image',
            'has_post' => false,
            'is_slug' => true
        ];
    @endphp

    @include('layouts.wp_master_layout', $params)

    @if(have_posts())
        @while(have_posts())
            @php the_post() @endphp

            <section class="inner-pages blog-page single-post">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="text-left">
                                <h3>{!! the_title() !!} <br> <span>{!! get_the_date('j M Y') !!}</span></h3>
                                <img src="{!! get_the_post_thumbnail_url(get_the_ID()) !!}" alt="" class="featured-img">
                                {!! the_content() !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            {!! dynamic_sidebar() !!}
                        </div>
                        <div class="col-lg-12">
                            <div class="text-center">
                                <a href="{{ URL::previous() }}" class="btn-default mt-5">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        @endwhile
    @endif
@endsection
