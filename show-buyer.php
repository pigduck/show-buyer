<?php
/*
 * Plugin Name: RCM Show Buyer
 * Plugin URI: https://piglet.me/
 * Description: RCM Stock Tools
 * Version: 0.1.0
 * Author: heiblack
 * Author URI: https://piglet.me
 * License:  GPL 3.0
 * Domain Path: /languages
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
*/


add_action( 'woocommerce_single_product_summary', function () {
    global $product;
    $total = $product->get_total_sales();
    if ( $total ) {
        echo '<p>已銷售:' . $total . '</p>';
    }
});

add_filter( 'manage_edit-product_columns', function ( $columns ){
    //rcm_bought 為自訂名稱，建議加上自己的前綴
    $columns['rcm_bought'] = __( '已購買人數');
    return $columns;
}, 9999 );
add_action( 'manage_product_posts_custom_column', function ( $column, $product_id ){
    if ( $column == 'rcm_bought' ) {
        $product = wc_get_product( $product_id );
        echo $product->get_total_sales();
    }
}, 10, 2 );
