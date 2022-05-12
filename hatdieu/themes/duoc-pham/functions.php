<?php 
//Add description product excerpt to archive pages
add_action( 'woocommerce_after_shop_loop_item_title', 'lv_short_description_product_excerpt', 5 );
function lv_short_description_product_excerpt() {
global $post;
echo wp_trim_words ($post->post_excerpt,20); // 10 là số chữ được chỉ định giới hạn.
}


add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
     unset($fields['billing']['billing_postcode']);
unset($fields['billing']['billing_country']);
 unset($fields['billing']['billing_address_2']);
 unset($fields['billing']['billing_company']);
 unset($fields['billing']['billing_address_1']);
     return $fields;
}

function tp_custom_checkout_fields( $fields ) {$fields['city']['label'] = 'Địa chỉ'; return $fields;
}
add_filter( 'woocommerce_default_address_fields', 'tp_custom_checkout_fields' );


// Code đếm số dòng trong văn bản
function count_paragraph( $insertion, $paragraph_id, $content ) {
        $closing_p = '</p>';
        $paragraphs = explode( $closing_p, $content );
        foreach ($paragraphs as $index => $paragraph) {
                if ( trim( $paragraph ) ) {
                        $paragraphs[$index] .= $closing_p;
                }
                if ( $paragraph_id == $index + 1 ) {
                        $paragraphs[$index] .= $insertion;
                }
        }
 
        return implode( '', $paragraphs );
}

//Chèn bài liên quan vào giữa nội dung
 
add_filter( 'the_content', 'prefix_insert_post_ads' );
 
function prefix_insert_post_ads( $content ) {
 
        $related_posts= "<div class='meta-related'>".do_shortcode('[related_posts_by_tax title=""]')."</div>";
 
        if ( is_single() ) {
                return count_paragraph( $related_posts, 1, $content );
        }
 
        return $content;
}

// Add custom Theme Functions here
add_filter('widget_text','execute_php',100);
function execute_php($html){
     if(strpos($html,"<"."?php")!==false){
          ob_start();
          eval("?".">".$html);
          $html=ob_get_contents();
          ob_end_clean();
     }
     return $html;
}


?>
