<?php
  if(is_page('blog')) {
    wp_redirect(home_url(), 301);
  } else {
    get_header();
    
    if(have_posts()){
      while(have_posts()){
        the_post();
        
        the_content();
        
      }
    }
    
    get_footer();
  }