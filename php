
add_filter( 'woocommerce_cart_item_subtotal', 'cartflows_show_sale_regular_and_savings_styled', 10, 3 );
function cartflows_show_sale_regular_and_savings_styled( $subtotal, $cart_item, $cart_item_key ) {
    $product = $cart_item['data'];

    if ( $product->is_on_sale() ) {
        $regular_price = wc_price( $product->get_regular_price() * $cart_item['quantity'] );
        $sale_price    = wc_price( $product->get_sale_price() * $cart_item['quantity'] );

        // Calculate savings
        $savings = ( $product->get_regular_price() - $product->get_sale_price() ) * $cart_item['quantity'];
        $percentage = round( ( $savings / ( $product->get_regular_price() * $cart_item['quantity'] ) ) * 100 );

        // Styled HTML output with your requested sizes
        $subtotal  = '<div style="line-height:1.6;">';
        $subtotal .= '<span style="display:block;"><del style="opacity:0.6; font-size:18px; margin-right:8px;">' . $regular_price . '</del> ';
        $subtotal .= '<ins style="color:#e74c3c; font-weight:bold; text-decoration:none; font-size:26px;">' . $sale_price . '</ins></span>';
        $subtotal .= '<span style="display:inline-block; margin-top:6px; background:#e8f8f0; color:#27ae60; padding:4px 8px; border-radius:4px; font-size:16px; font-weight:bold;">';
        $subtotal .= 'You save ' . wc_price($savings) . ' (' . $percentage . '%)</span>';
        $subtotal .= '</div>';
    }

    return $subtotal;
}


