<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="p-thankyou">

	<?php if ( get_field('order_received_banner', 'option') ) : ?>
  	<div class="p-thankyou__hero lazy" data-src="<?php the_field('order_received_banner', 'option'); ?>">
			<?php if( get_field('order_received_title', 'option') ): ?>
				<h1 class="p-thankyou__title"><?php the_field('order_received_title', 'option'); ?></h1>
			<?php endif; ?>
    </div>
  <?php endif; ?>

	<div class="woocommerce-order">

		<?php if ( $order ) : ?>

			<?php if ( $order->has_status( 'failed' ) ) : ?>
				<div class="p-thankyou__fail">
					<div class="container container_narrow">

						<h3 class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></h3>

						<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
							<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
							<?php if ( is_user_logged_in() ) : ?>
								<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My account', 'woocommerce' ); ?></a>
							<?php endif; ?>
						</p>
					</div>		
				</div>

			<?php else : ?>
				<div class="p-thankyou__overview">
					<div class="container container_narrow">
						<h4 class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); ?></h4>

						<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

							<li class="woocommerce-order-overview__order order">
								<?php _e( 'Order number:', 'woocommerce' ); ?>
								<strong><?php echo $order->get_order_number(); ?></strong>
							</li>

							<li class="woocommerce-order-overview__date date">
								<?php _e( 'Date:', 'woocommerce' ); ?>
								<strong><?php echo wc_format_datetime( $order->get_date_created() ); ?></strong>
							</li>

							<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
								<li class="woocommerce-order-overview__email email">
									<?php _e( 'Email:', 'woocommerce' ); ?>
									<strong><?php echo $order->get_billing_email(); ?></strong>
								</li>
							<?php endif; ?>

							<li class="woocommerce-order-overview__total total">
								<?php _e( 'Total:', 'woocommerce' ); ?>
								<strong><?php echo $order->get_formatted_order_total(); ?></strong>
							</li>

							<?php if ( $order->get_payment_method_title() ) : ?>
								<li class="woocommerce-order-overview__payment-method method">
									<?php _e( 'Payment method:', 'woocommerce' ); ?>
									<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
								</li>
							<?php endif; ?>

						</ul>
					</div>	
				</div>

			<?php endif; ?>

			<div class="container container_narrow">
				
					
						<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
				
					
						<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>
				
				
			</div>
			
		<?php else : ?>
			<div class="container container_narrow">
				<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p>
			</div>
		<?php endif; ?>
		
		<?php if ( get_field('order_received_bottom_banner', 'option') ) : ?>
			<section class="section section_image lazy" data-src="<?php the_field('order_received_bottom_banner', 'option'); ?>"></section>
		<?php endif; ?>

	</div>
</div>

