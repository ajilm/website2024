<?php
/**
 * Template Name: News Template
 * Description:  
 */
get_header();
?>  
<?php //the_content();?>
<button id="myButton">Click Me!</button>
<div id="response"></div>

<script type="text/javascript">
       jQuery(document).ready(function($) { console.log('dom 1');
         
            $('#myButton').click(function() { console.log('step 1');
                // AJAX request
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',  // WP AJAX URL
                    type: 'POST',
                    data: {
                        action: 'getnews_data', // PHP function
                        name: 'John Doe'  // Data to send
                    },
                    success: function(response) {  console.log('step 2');
                        $('#response').html('Response from server: ' + response);
                    },
                    error: function() {  console.log('step 3');
                        $('#response').html('There was an error.');
                    }
                });
            });
        });
    </script> 
<?php get_footer(); ?>