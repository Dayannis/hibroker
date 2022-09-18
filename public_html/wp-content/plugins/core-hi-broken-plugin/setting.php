<?php

function registerAssets()
{
    if (!is_admin())
    {
      
      wp_enqueue_style( 'hb_style_global', plugins_url( 'assets/styles/global.css', __FILE__ ) );
      wp_enqueue_script( 'hb_script_global', plugins_url( 'assets/scripts/global.js', __FILE__ ) );
      
      wp_enqueue_style( 'hb_style_font_awesome', plugins_url( '/assets/plugins/font-awesome/css/font-awesome.min.css', __FILE__ ) );
      
      // quote_form
      wp_enqueue_style( 'hb_style_quote_form', plugins_url( 'contents/quote_form/style.css', __FILE__ ) );
      wp_enqueue_script( 'hb_script_quote_form', plugins_url( 'contents/quote_form/script.js', __FILE__ ) );
    	
      // Library Box Country
      wp_enqueue_style( 'hb_style_textBoxCountry', plugins_url( 'assets/styles/intlTelInput.css', __FILE__ ) );
      wp_enqueue_script( 'hb_script_textBoxCountry', plugins_url( 'assets/scripts/intlTelInput.js', __FILE__ ) );
      
      //jQuery Modal -->
      //wp_enqueue_script( 'hb_script_modal', plugins_url( 'https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js') );
      //wp_enqueue_style( 'hb_style_modal', plugins_url( 'https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css') );

    }
}

add_action('init', 'registerAssets');

include 'shortcode.php';

add_shortcode( 'hb_test', 'ShortCode::test_short_hi_broken' );
add_shortcode( 'hb_quote_form', 'ShortCode::quote_form' );

include 'ajax.php';

add_action( 'wp_ajax_hb_api', 'Ajax::api' );
add_action( 'wp_ajax_nopriv_hb_api', 'Ajax::api' );