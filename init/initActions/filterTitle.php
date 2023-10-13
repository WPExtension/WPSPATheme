<?php 


  add_filter('the_title', function( $title ) {
   
     if( is_home() || is_page(2) ) {
        return "<i> $title </i>";
     }

  });  