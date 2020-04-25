<?php

use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Product_Price_Filter extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'jws_product_price_filter';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Jws Product Price Filter', 'fatcy' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-site-search';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'jws-elements' ];
	}


	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
        $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Layout', 'fatcy' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
			'text',
			[
				'label' => __( 'Title', 'fatcy' ),
				'type' =>  Controls_Manager::TEXT,
				'default' => __( '', 'fatcy' ),
			]
          
		);
        $this->end_controls_section();
		$this->start_controls_section(
			'sorting_style',
			[
				'label' => __( 'Style', 'fatcy' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
					'title_color',
					[
						'label' 	=> __( 'Title Color', 'fatcy' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .jws_filter_title' => 'color: {{VALUE}};',
						],
					]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'fatcy'),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .jws_filter_title',
			]
		);
        $this->add_control(
					'main_color',
					[
						'label' 	=> __( 'Slidet Color', 'fatcy' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .ui-slider .ui-slider-handle , {{WRAPPER}} .ui-slider .ui-slider-range ' => 'background-color: {{VALUE}};',
						],
					]
		);
        $this->add_control(
					'price_color',
					[
						'label' 	=> __( 'Price Color', 'fatcy' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .price_slider_amount .price_label' => 'color: {{VALUE}};',
						],
					]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __( 'Typography', 'fatcy'),
				'selector' => '{{WRAPPER}} .price_slider_amount .price_label',
			]
		);
        $this->add_control(
					'btn_color',
					[
						'label' 	=> __( 'Button Color', 'fatcy' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .price_slider_amount .button' => 'color: {{VALUE}};',
						],
					]
		);
        $this->add_control(
					'btn_bgcolor',
					[
						'label' 	=> __( 'Button Background Color', 'fatcy' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .price_slider_amount .button' => 'background-color: {{VALUE}};',
						],
					]
		);
        $this->add_control(
					'btn_color2',
					[
						'label' 	=> __( 'Button Color Hover', 'fatcy' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .price_slider_amount .button:hover' => 'color: {{VALUE}};',
						],
					]
		);
        $this->add_control(
					'btn_bgcolor2',
					[
						'label' 	=> __( 'Button Background Color Hover', 'fatcy' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .price_slider_amount .button:hover' => 'background-color: {{VALUE}};',
						],
					]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'label' => __( 'Typography', 'fatcy'),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .price_slider_amount .button',
			]
		);

        $this->end_controls_section();
	}
    	/**
	 * Get filtered min price for current products.
	 *
	 * @return int
	 */
	protected function get_filtered_price() {
		global $wpdb;

		$args       = WC()->query->get_main_query()->query_vars;
		$tax_query  = isset( $args['tax_query'] ) ? $args['tax_query'] : array();
		$meta_query = isset( $args['meta_query'] ) ? $args['meta_query'] : array();

		if ( ! is_post_type_archive( 'product' ) && ! empty( $args['taxonomy'] ) && ! empty( $args['term'] ) ) {
			$tax_query[] = WC()->query->get_main_tax_query();
		}

		foreach ( $meta_query + $tax_query as $key => $query ) {
			if ( ! empty( $query['price_filter'] ) || ! empty( $query['rating_filter'] ) ) {
				unset( $meta_query[ $key ] );
			}
		}

		$meta_query = new WP_Meta_Query( $meta_query );
		$tax_query  = new WP_Tax_Query( $tax_query );
		$search     = WC_Query::get_main_search_query_sql();

		$meta_query_sql   = $meta_query->get_sql( 'post', $wpdb->posts, 'ID' );
		$tax_query_sql    = $tax_query->get_sql( $wpdb->posts, 'ID' );
		$search_query_sql = $search ? ' AND ' . $search : '';

		$sql = "
			SELECT min( min_price ) as min_price, MAX( max_price ) as max_price
			FROM {$wpdb->wc_product_meta_lookup}
			WHERE product_id IN (
				SELECT ID FROM {$wpdb->posts}
				" . $tax_query_sql['join'] . $meta_query_sql['join'] . "
				WHERE {$wpdb->posts}.post_type IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_post_type', array( 'product' ) ) ) ) . "')
				AND {$wpdb->posts}.post_status = 'publish'
				" . $tax_query_sql['where'] . $meta_query_sql['where'] . $search_query_sql . '
			)';

		$sql = apply_filters( 'woocommerce_price_filter_sql', $sql, $meta_query_sql, $tax_query_sql );

		return $wpdb->get_row( $sql ); // WPCS: unprepared SQL ok.
	}
	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings();
        echo '<div class="jws_filter_price_slider">';
        if ( \Elementor\Plugin::$instance->editor->is_edit_mode()  ) {
            if(!empty($settings['text'])) {
                echo '<h3 class="jws_filter_title">'.$settings['text'].'<i class="fas fa-chevron-down"></i></h3>';
            }
            echo esc_html('Jws Product Price Filter will display in frontend , avoid javascript conflicts','fatcy');
        } else {
        global $wp;

		// Requires lookup table added in 3.6.
		if ( version_compare( get_option( 'woocommerce_db_version', null ), '3.6', '<' ) ) {
			return;
		}

		if ( ! is_shop() && ! is_product_taxonomy() ) {
			return;
		}

		// If there are not posts and we're not filtering, hide the widget.
		if ( ! WC()->query->get_main_query()->post_count && ! isset( $_GET['min_price'] ) && ! isset( $_GET['max_price'] ) ) { // WPCS: input var ok, CSRF ok.
			return;
		}

		wp_enqueue_script( 'wc-price-slider' );
	

		// Round values to nearest 1 by default.
		$step = max( apply_filters( 'woocommerce_price_filter_widget_step', 1 ), 1 );

		// Find min and max price in current result set.
		$prices    = $this->get_filtered_price();
		$min_price = $prices->min_price;
		$max_price = $prices->max_price;

		// Check to see if we should add taxes to the prices if store are excl tax but display incl.
		$tax_display_mode = get_option( 'woocommerce_tax_display_shop' );

		if ( wc_tax_enabled() && ! wc_prices_include_tax() && 'incl' === $tax_display_mode ) {
			$tax_class = apply_filters( 'woocommerce_price_filter_widget_tax_class', '' ); // Uses standard tax class.
			$tax_rates = WC_Tax::get_rates( $tax_class );

			if ( $tax_rates ) {
				$min_price += WC_Tax::get_tax_total( WC_Tax::calc_exclusive_tax( $min_price, $tax_rates ) );
				$max_price += WC_Tax::get_tax_total( WC_Tax::calc_exclusive_tax( $max_price, $tax_rates ) );
			}
		}

		$min_price = apply_filters( 'woocommerce_price_filter_widget_min_amount', floor( $min_price / $step ) * $step );
		$max_price = apply_filters( 'woocommerce_price_filter_widget_max_amount', ceil( $max_price / $step ) * $step );

		// If both min and max are equal, we don't need a slider.
		if ( $min_price === $max_price ) {
			return;
		}

		$current_min_price = isset( $_GET['min_price'] ) ? floor( floatval( wp_unslash( $_GET['min_price'] ) ) / $step ) * $step : $min_price; // WPCS: input var ok, CSRF ok.
		$current_max_price = isset( $_GET['max_price'] ) ? ceil( floatval( wp_unslash( $_GET['max_price'] ) ) / $step ) * $step : $max_price; // WPCS: input var ok, CSRF ok.

	

		if ( '' === get_option( 'permalink_structure' ) ) {
			$form_action = remove_query_arg( array( 'page', 'paged', 'product-page' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
		} else {
			$form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( trailingslashit( $wp->request ) ) );
		}
        if(!empty($settings['text'])) {
                echo '<h3 class="jws_filter_title">'.$settings['text'].'<i class="fas fa-chevron-down"></i></h3>';
        }
		echo '<form method="get" action="' . esc_url( $form_action ) . '">
			<div class="price_slider_wrapper">
				
				<div class="price_slider_amount" data-step="' . esc_attr( $step ) . '">
                    <div class="price_label" style="display:none;">
						'. ' <span class="from"></span><span> - </span><span class="to"></span>
					</div>
                </div>

				<div class="price_slider" style="display:none;" ></div>
				<div class="price_slider_amount" data-step="' . esc_attr( $step ) . '">
					<label class="container-discount">Discount
						<input type="checkbox" name="discount" class="discount-inp" id="inp-dis">
						<span class="checkmark" id="checked-dis"></span>
					</label>
					<input type="text" id="min_price" name="min_price" value="' . esc_attr( $current_min_price ) . '" data-min="' . esc_attr( $min_price ) . '" placeholder="' . esc_attr__( 'Min price', 'fatcy' ) . '" />
					<input type="text" id="max_price" name="max_price" value="' . esc_attr( $current_max_price ) . '" data-max="' . esc_attr( $max_price ) . '" placeholder="' . esc_attr__( 'Max price', 'fatcy' ) . '" />
					<button type="submit" class="button">' . esc_html__( 'Filter', 'fatcy' ) . '</button>
					' . wc_query_string_form_fields( null, array( 'min_price', 'max_price', 'paged' ), '', true ) . '
					<div class="clear"></div>
				</div>
			</div>
		</form>'; // WPCS: XSS ok.
    }
    echo '</div>';
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _content_template() {}
}