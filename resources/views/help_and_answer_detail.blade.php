{!! HTML::style('/blog/wp-content/plugins/kingcomposer/assets/css/animate.css') !!}
{!! HTML::style('/blog/wp-content/plugins/kingcomposer/assets/css/icons.css') !!}
@php $data = collect($data)->first() @endphp
@extends('layouts.app')
@section('title', $data->post_title)
@section('content')

    @php
        $params = [
            'title' => 'banner_title',
            'sub_title' => 'banner_sub_title',
            'has_banner' => true,
            'page_id' => 'options',
            'header'  => false,
            'banner_image' => 'banner_image',
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
