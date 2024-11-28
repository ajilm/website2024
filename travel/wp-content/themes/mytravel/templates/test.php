<?php
/**

 * Template Name: test

 */

 get_header(); 
 
  
// $args = array(
//     'post_type'      => 'destination',  
//     'posts_per_page' => 10,    
//     'order'          => 'DESC',  
//     'orderby'        => 'date',   
// ); 
// $query = new WP_Query($args); 
// if ($query->have_posts()) :
//     while ($query->have_posts()) : $query->the_post();
       
//         echo '<h2>' . get_the_title() . '</h2>';
// 		echo get_the_post_thumbnail_url(get_the_ID(),'full');
       
//     endwhile; 
//     wp_reset_postdata();
// else :
//     echo 'No posts found.';
// endif;
?>
<button id="brn">CLicccccck</button>


<script>
    jQuery(document).ready(function($) {
    $('#my-button').click(function() {
        $.ajax({
            url: ajaxurl, // The AJAX URL defined by WordPress
            type: 'POST',
            data: {
                action: 'testapi', // The PHP action to execute
                //some_data: 'my_value',     // Any data you want to send
            },
            success: function(response) {
                // Handle the response from the server
                console.log(response);
            },
        });
    });
});

</script>
<?php 


 get_footer();?>