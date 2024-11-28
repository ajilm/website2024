<?php 
/**
 * Plugin Name: myStockAPI
 * Description: A simple plugin to demonstrate AJAX in WordPress.
 * Version: 1.0
 * Author: Your Name
 */
 
//JEVZO419QLMCJ09V - API key

function apikeyval()
{ $apikey = 'JEVZO419QLMCJ09V';
    return $apikey;
} 

add_action('wp_ajax_getnews_data', 'getnews_callback'); // For logged-in users
add_action('wp_ajax_nopriv_getnews_data', 'getnews_callback'); // For non-logged-in users
function getnews_callback() {
    // Handle the AJAX request here
   // $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : 'No Name';
  
    //     $json = file_get_contents('https://www.alphavantage.co/query?function=NEWS_SENTIMENT&topics=financial_markets&apikey='.apikeyval()); 
    //     $data = json_decode($json,true);
    //     echo '<pre>';
    //     print_r($data);
    //     echo '</pre>';


    // Example usage
$symbol = 'BTC'; // Replace with desired stock symbol
$market = 'EUR'; // Replace with desired stock symbol
$apikey = apikeyval(); // Replace with your Alpha Vantage API key
echo $api_url = get_alpha_vantage_api_url($symbol, $market,$apikey);
 
$json = file_get_contents($api_url); 
$data = json_decode($json,true);
echo '<pre>';
print_r($data);
echo '</pre>';

   exit;
}
add_action('wp_ajax_getnews_callback', 'getnews_callback');


// Function to generate Alpha Vantage API URL for Indian stock markets
function get_alpha_vantage_api_url($symbol, $market, $apikey) {
    // Base URL for Alpha Vantage
    $base_url = 'https://www.alphavantage.co/query';
    
    // Construct the complete URL with parameters 
     $api_url = sprintf('%s?function=DIGITAL_CURRENCY_DAILY&symbol=%s&market=%s&apikey=%s',$base_url, $symbol,$market, $apikey);
    
    
    return $api_url; // Return the complete API URL
}


 
