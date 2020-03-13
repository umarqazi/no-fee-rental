
{!! HTML::style('wp') !!}
{!! HTML::style('blog') !!}


@if($header)
    @php wp_head() @endphp
@endif

@php
        $title = get_field($title, $page_id);
        $sub_title = get_field($sub_title, $page_id);

        if($is_slug) {
            $banner_img = get_field($banner_image, $page_id);
        } else {
            $page_data = get_page( $page_id );
            $banner_img = get_the_post_thumbnail_url($page_id);
        }
@endphp

@if($has_banner)
    <div class="blog-banner-img-wrapper">
        <div class="blog-banner-text">

            @if($title)
                <h4>{{ $title }}</h4>
            @endif

            @if($sub_title)
                <h5>{{ $sub_title }}</h5>
            @endif

        </div>

        @if($banner_img)
            <div class="banner-bg" style="background-image: url({{ $banner_img }})"></div>
        @endif

    </div>
@endif

@if($has_post)
    {!! $page_data->post_content !!}
@endif

<script>
    {!! get_field('add_js_code_here', $page_id) !!}
</script>

{!! HTML::script('/blog/wp-content/plugins/kingcomposer/assets/frontend/js/kingcomposer.min.js') !!}
