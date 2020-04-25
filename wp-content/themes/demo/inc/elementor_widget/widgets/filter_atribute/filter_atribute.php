<?php

//namespace JwsElementor\Widgets\Woo;
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

 
class Product_Atribute_Filter extends Widget_Base {

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
		return 'jws_product_filter_atribute';
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
		return __( 'Jws Product Atribute Filter', 'fatcy' );
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
	 * Note that currently Elementor supports only one filter_layout.
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
        $this->add_control(
				'attribute',
				[
					'label'     => __( 'Select Attribute', 'fatcy' ),
					'type'      => Controls_Manager::SELECT2,
					'multiple'  => false,
					'default'   => '',
					'options'   => $this->get_product_attr(),
				]
		);
        $this->add_control(
			'query_type',
			[
				'label' => __( 'Query type', 'fatcy' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'and',
				'options' => [
					'and' => esc_html__( 'AND', 'fatcy' ),
					'or'  => esc_html__( 'OR', 'fatcy' )
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'filter_layout_style',
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
				'name' => 'content_typography',
				'label' => __( 'Typography', 'fatcy'),
				'selector' => '{{WRAPPER}} .jws_filter_title',
			]
		);
        $this->add_control(
					'label_color',
					[
						'label' 	=> __( 'Label Color ( Tyle Attr Label )', 'fatcy' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .jws_filter_attr li:not(.show-color):not(.show-image) .nav-title span' => 'color: {{VALUE}};',
						],
					]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'label' => __( 'Typography', 'fatcy'),
				'selector' => '{{WRAPPER}} .jws_filter_attr li:not(.show-color):not(.show-image) .nav-title span ',
			]
		);
        $this->add_control(
					'active_color',
					[
						'label' 	=> __( 'Color Choosed ( Tyle Attr Label )', 'fatcy' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .jws_filter_attr li:not(.show-color):not(.show-image).chosen .nav-title span' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .jws_filter_attr li:not(.show-color):not(.show-image).chosen .nav-title:before ' => 'background-color: {{VALUE}};  border-color:{{VALUE}};',
						],
					]
		);

        $this->end_controls_section();
	}
    /**
	 * Return the currently viewed taxonomy name.
	 * @return string
	 */
	protected function get_current_taxonomy() {
		return is_tax() ? get_queried_object()->taxonomy : '';
	}

	/**
	 * Return the currently viewed term ID.
	 * @return int
	 */
	protected function get_current_term_id() {
		return absint( is_tax() ? get_queried_object()->term_id : 0 );
	}

	/**
	 * Return the currently viewed term slug.
	 * @return int
	 */
	protected function get_current_term_slug() {
		return absint( is_tax() ? get_queried_object()->slug : 0 );
	}


	/**
	 * Get current page URL for layered nav items.
	 * @return string
	 */
	protected function get_page_base_url( $taxonomy ) {
		if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
			$link = home_url();
		} elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id( 'shop' ) ) ) {
			$link = get_post_type_archive_link( 'product' );
		} elseif ( is_product_category() ) {
			$link = get_term_link( get_query_var( 'product_cat' ), 'product_cat' );
		} elseif ( is_product_tag() ) {
			$link = get_term_link( get_query_var( 'product_tag' ), 'product_tag' );
		} else {
			$queried_object = get_queried_object();
			$link           = get_term_link( $queried_object->slug, $queried_object->taxonomy );
		}
		// Min/Max
		if ( isset( $_GET['min_price'] ) ) {
			$link = add_query_arg( 'min_price', wc_clean( $_GET['min_price'] ), $link );
		}

		if ( isset( $_GET['max_price'] ) ) {
			$link = add_query_arg( 'max_price', wc_clean( $_GET['max_price'] ), $link );
		}
        
        if ( isset( $_GET['item_columns'] ) ) {
			$link = add_query_arg( 'item_columns', wc_clean( $_GET['item_columns'] ), $link );
		}

		if ( isset( $_GET['item_layout'] ) ) {
			$link = add_query_arg( 'item_layout', wc_clean( $_GET['item_layout'] ), $link );
		}
        
		// Orderby
		if ( isset( $_GET['orderby'] ) ) {
			$link = add_query_arg( 'orderby', wc_clean( $_GET['orderby'] ), $link );
		}

		/**
		 * Search Arg.
		 * To support quote characters, first they are decoded from &quot; entities, then URL encoded.
		 */
		if ( get_search_query() ) {
			$link = add_query_arg( 's', rawurlencode( wp_specialchars_decode( get_search_query() ) ), $link );
		}

		// Post Type Arg
		if ( isset( $_GET['post_type'] ) ) {
			$link = add_query_arg( 'post_type', wc_clean( $_GET['post_type'] ), $link );
		}

		// Min Rating Arg
		if ( isset( $_GET['min_rating'] ) ) {
			$link = add_query_arg( 'min_rating', wc_clean( $_GET['min_rating'] ), $link );
		}

		// All current filters
		if ( $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes() ) {
			foreach ( $_chosen_attributes as $name => $data ) {
				if ( $name === $taxonomy ) {
					continue;
				}
				$filter_name = sanitize_title( str_replace( 'pa_', '', $name ) );
				if ( ! empty( $data['terms'] ) ) {
					$link = add_query_arg( 'filter_' . $filter_name, implode( ',', $data['terms'] ), $link );
				}
				if ( 'or' == $data['query_type'] ) {
					$link = add_query_arg( 'query_type_' . $filter_name, 'or', $link );
				}
			}
		}

		return $link;
	}

	/**
	 * Count products within certain terms, taking the main WP query into consideration.
	 *
	 * @param  array  $term_ids
	 * @param  string $taxonomy
	 * @param  string $query_type
	 *
	 * @return array
	 */
	protected function get_filtered_term_product_counts( $term_ids, $taxonomy, $query_type ) {
		global $wpdb;

		$tax_query  = WC_Query::get_main_tax_query();
		$meta_query = WC_Query::get_main_meta_query();
        
		if ( 'or' === $query_type ) {
			foreach ( $tax_query as $key => $query ) {
				
					unset( $tax_query[$key] );
			
			}
		}

		$meta_query     = new WP_Meta_Query( $meta_query );
		$tax_query      = new WP_Tax_Query( $tax_query );
		$meta_query_sql = $meta_query->get_sql( 'post', $wpdb->posts, 'ID' );
		$tax_query_sql  = $tax_query->get_sql( $wpdb->posts, 'ID' );

		// Generate query
		$query           = array();
		$query['select'] = "SELECT COUNT( DISTINCT {$wpdb->posts}.ID ) as term_count, terms.term_id as term_count_id";
		$query['from']   = "FROM {$wpdb->posts}";
		$query['join']   = "
			INNER JOIN {$wpdb->term_relationships} AS term_relationships ON {$wpdb->posts}.ID = term_relationships.object_id
			INNER JOIN {$wpdb->term_taxonomy} AS term_taxonomy USING( term_taxonomy_id )
			INNER JOIN {$wpdb->terms} AS terms USING( term_id )
			" . $tax_query_sql['join'] . $meta_query_sql['join'];

		$query['where'] = "
			WHERE {$wpdb->posts}.post_type IN ( 'product' )
			AND {$wpdb->posts}.post_status = 'publish'
			" . $tax_query_sql['where'] . $meta_query_sql['where'] . "
			AND terms.term_id IN (" . implode( ',', array_map( 'absint', $term_ids ) ) . ")
		";

		if ( $search = WC_Query::get_main_search_query_sql() ) {
			$query['where'] .= ' AND ' . $search;
		}

		$query['group_by'] = "GROUP BY terms.term_id";
		$query             = apply_filters( 'woocommerce_get_filtered_term_product_counts_query', $query );
		$query             = implode( ' ', $query );
		$results           = $wpdb->get_results( $query );

		return wp_list_pluck( $results, 'term_count', 'term_count_id' );
	}

	/**
	 * Show list based layered nav.
	 *
	 * @param  array  $terms
	 * @param  string $taxonomy
	 * @param  string $query_type
	 *
	 * @return bool Will nav display?
	 */
     
	protected function layered_nav_list( $terms, $taxonomy, $query_type, $show_color ,$show_image ) {
		// List display
		echo '<ul class="jws_filter_attr block block2">';

		$term_counts        = $this->get_filtered_term_product_counts( wp_list_pluck( $terms, 'term_id' ), $taxonomy, $query_type );
		$_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();
		$found              = false;

		foreach ( $terms as $term ) {
			$current_values = isset( $_chosen_attributes[$taxonomy]['terms'] ) ? $_chosen_attributes[$taxonomy]['terms'] : array();
			$option_is_set  = in_array( $term->slug, $current_values );
			$count          = isset( $term_counts[$term->term_id] ) ? $term_counts[$term->term_id] : 0;

			// skip the term for the current archive
			if ( $this->get_current_term_id() === $term->term_id ) {
				continue;
			}

			// Only show options with count > 0
			if ( 0 < $count ) {
				$found = true;
			} elseif ( 'and' === $query_type && 0 === $count && ! $option_is_set ) {
				continue;
			}

			$filter_name    = 'filter_' . sanitize_title( str_replace( 'pa_', '', $taxonomy ) );
			$current_filter = isset( $_GET[$filter_name] ) ? explode( ',', wc_clean( $_GET[$filter_name] ) ) : array();
			$current_filter = array_map( 'sanitize_title', $current_filter );

			if ( ! in_array( $term->slug, $current_filter ) ) {
				$current_filter[] = $term->slug;
			}

			$link = $this->get_page_base_url( $taxonomy );

			// Add current filters to URL.
			foreach ( $current_filter as $key => $value ) {
				// Exclude query arg for current term archive term
				if ( $value === $this->get_current_term_slug() ) {
					unset( $current_filter[$key] );
				}

				// Exclude self so filter can be unset on click.
				if ( $option_is_set && $value === $term->slug ) {
					unset( $current_filter[$key] );
				}
			}

			if ( ! empty( $current_filter ) ) {
				$link = add_query_arg( $filter_name, implode( ',', $current_filter ), $link );

				// Add Query type Arg to URL
				if ( $query_type === 'or' && ! ( 1 === sizeof( $current_filter ) && $option_is_set ) ) {
					$link = add_query_arg( 'query_type_' . sanitize_title( str_replace( 'pa_', '', $taxonomy ) ), 'or', $link );
				}
			}

			$color = '';
            $image = '';
			if ( $show_color ) {
				$color = get_term_meta( $term->term_id, 'color', true );
				if ( is_wp_error( $color ) || ! $color ) {
					$show_color = false;
				}

			}
            if ( $show_image ) {
				$image = get_term_meta( $term->term_id, 'image', true );
				if ( is_wp_error( $image ) || ! $image ) {
					$show_image = false;
				}

			}
            
			$css_class = $show_color ? 'show-color ' : '';
            $css_class .= $show_image ? 'show-image ' : '';
			echo '<li class="wc-layered-nav-term ' . esc_attr( $css_class ) . ( $option_is_set ? 'chosen' : '' ) . '">';


			echo wp_kses(( $count > 0 || $option_is_set ) ? '<a href="' . esc_url( apply_filters( 'woocommerce_layered_nav_link', $link ) ) . '">' : '<span>','');

			if ( $show_color ) {

				list( $r, $g, $b ) = sscanf( $color, "#%02x%02x%02x" );

				printf(
					'<span class="swatch swatch-color" style="background-color:%s;color:%s;" title="%s"></span>',
					esc_attr( $color ),
					esc_attr( "rgba($r,$g,$b,0.5)" ),
					esc_attr( $term->name )
				);

			}
            
            if ( $show_image ) {

                $images = wp_get_attachment_image_src($image);
				printf(
					'<span class="swatch swatch-image" style="background-image:url(%s)" title="%s"></span>',
					esc_attr( $images[0] ),
					esc_attr( $term->name )
				);

			}

			echo '<span class="nav-title"><span>' . esc_html( $term->name ) . '</span></span>';


			echo wp_kses(( $count > 0 || $option_is_set ) ? '</a> ' : '</span> ','');

			echo apply_filters( 'fatcy_color_filter_nav_count', '<span class="count-atr">(' . absint( $count ) . ')</span>', $count, $term );

			echo '</li>';
		}

		echo '</ul>';

		return $found;
	}

	/**
	 * Get attribute's properties
	 *
	 * @param string $attribute
	 *
	 * @return object
	 */
	protected function get_tax_attribute( $attribute ) {
		global $wpdb;

		$attr = $wpdb->get_row( "SELECT * FROM " . $wpdb->prefix . "woocommerce_attribute_taxonomies WHERE attribute_name = '$attribute'" );

		return $attr;
	}

    
     protected function get_product_attr() {
        $attributes = array();
        if (class_exists('Woocommerce')) {
            $attributes_tax = wc_get_attribute_taxonomies();
        }else {
            $attributes_tax = '';
        }
        foreach ($attributes_tax as $attribute) {
            $attributes[$attribute->attribute_name] = $attribute->attribute_name;
        }
        return $attributes;
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
        if ( \Elementor\Plugin::$instance->editor->is_edit_mode()  ) {
             if(!empty($settings['text'])) {
                echo '<h3 class="jws_filter_title">'.$settings['text'].'<i class="fas fa-chevron-down"></i></h3>';
            }
            echo esc_html('Jws Product Atribute Filter will display in frontend , avoid javascript conflicts','fatcy');  
        } else { 
        if ( ! is_post_type_archive( 'product' ) && ! is_tax( get_object_taxonomies( 'product' ) ) ) {
			return;
		} 
        
		$_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();
		$taxonomy           = 'pa_'.$settings['attribute'];
		$query_type         = $settings['query_type'];
       
		if ( ! taxonomy_exists( $taxonomy ) ) {
			return;
		}

		$get_terms_args = array( 'hide_empty' => '1' );

		$orderby = wc_attribute_orderby( $taxonomy );

		switch ( $orderby ) {
			case 'name' :
				$get_terms_args['orderby']    = 'name';
				$get_terms_args['menu_order'] = false;
				break;
			case 'id' :
				$get_terms_args['orderby']    = 'id';
				$get_terms_args['order']      = 'ASC';
				$get_terms_args['menu_order'] = false;
				break;
			case 'menu_order' :
				$get_terms_args['menu_order'] = 'ASC';
				break;
		}

		$terms = get_terms( $taxonomy, $get_terms_args );

		if ( 0 === sizeof( $terms ) ) {
			return;
		}
        
		switch ( $orderby ) {
			case 'name_num' :
				usort( $terms, '_wc_get_product_terms_name_num_usort_callback' );
				break;
			case 'parent' :
				usort( $terms, '_wc_get_product_terms_parent_usort_callback' );
				break;
		}

		ob_start();

        if(!empty($settings['text'])) {
                echo '<h3 class="jws_filter_title">'.$settings['text'].'<i class="fas fa-chevron-down"></i></h3>';
        }

		$attr = $this->get_tax_attribute( $settings['attribute'] );

		$show_color = false;
        $show_image = false;
		if ( $attr && $attr->attribute_type == 'color' ) {
			$show_color = true;
		}
        if ( $attr && $attr->attribute_type == 'image' ) {
			$show_image = true;
		}

		// Use select by default if plugin Soo Product Attribute Swatches is not installed
		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}

		if ( ! function_exists( 'ta_wc_variation_swatches_constructor' ) ) {
			$show_color = false;
            $show_image = false;
		}
        
        ?>
        <div class="<?php echo esc_attr($taxonomy);  ?>"><?php 
		$found = $this->layered_nav_list( $terms, $taxonomy, $query_type, $show_color , $show_image );
        ?>
        </div>
        <?php

		// Force found when option is selected - do not force found on taxonomy attributes
		if ( ! is_tax() && is_array( $_chosen_attributes ) && array_key_exists( $taxonomy, $_chosen_attributes ) ) {
			$found = true;
		}

		if ( ! $found ) {
			ob_end_clean();
		} else {
			echo ob_get_clean();
		}
        }
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