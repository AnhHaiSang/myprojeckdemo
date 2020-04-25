<?php
namespace Elementor;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Gallery extends Widget_Base {

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
		return 'Gallery';
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
		return __( 'Gallery', 'fatcy' );
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
		
        //=========================Menu List=============================
        $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Pet Care List', 'fatcy' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
				'gallery_layouts',
				[
					'label'     => __( 'Layout', 'fatcy' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'layout1',
					'options'   => [
						'layout1'   => __( 'layout 1', 'fatcy' ),
						'layout2'   => __( 'layout 2', 'fatcy' ),
                        'layout3'   => __( 'layout 3', 'fatcy' ),
                        'layout4'   => __( 'layout 4', 'fatcy' ),
                        'layout5'   => __( 'layout 5', 'fatcy' ),
                        'layout6'   => __( 'layout 6', 'fatcy' ),
                        'layout7'   => __( 'layout 7', 'fatcy' ),
                        'layout8'   => __( 'layout 8', 'fatcy' ),
					],
				]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'gallery_categories',
			[
				'label' => __( 'Categories', 'fatcy' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		 $this->add_control( //option chỉ định category hiển thị theo cái gì (ví dụ: ở đây hiển thị theo default)
            'orderby_blog',
            [
                'label'     => __( 'Order by', 'fatcy' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'price',
                'options'   => [
                    'id'       => __( 'Id', 'fatcy' ),
                    'date'       => __( 'Date', 'fatcy' ),
                    'title'      => __( 'Title', 'fatcy' ),
                    'price'      => __( 'Price', 'fatcy' ),
                    'popularity' => __( 'Popularity', 'fatcy' ),
                    'rating'     => __( 'Rating', 'fatcy' ),
                    'rand'       => __( 'Random', 'fatcy' ),
                    'menu_order' => __( 'Menu Order', 'fatcy' ),
                ],
               
            ]
        );
        $this->add_control( //options sắp xếp hiển thị của category A-Z hoặc Z-A
            'order_blog',
            [
                'label'     => __( 'Order', 'fatcy' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'desc',
                'options'   => [
                    'desc' => __( 'Descending', 'fatcy' ),//hiển thị theo chiều ngược Z-A
                    'asc'  => __( 'Ascending', 'fatcy' ),//hiển thị theo chiều thuận A-Z
                ],
               
            ]
        );
        $this->end_controls_section();
		//===============TAB_STYLE==================
        $this->start_controls_section(
			'gallery_style',
			[
				'label' => __( 'Content', 'fatcy' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'text_align',
            [
                'label' => __( 'Alignment', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'plugin-domain' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'plugin-domain' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'plugin-domain' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .gallery_wrap' => 'text-align: {{VALUE}}',
                ],
            ]
        );
       
       	$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} li.items',
			]
		);
		$this->add_control(
			'margin_li',
			[
				'label' => __( 'Margin', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} li.items' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'padding_li',
			[
				'label' => __( 'Padding', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} li.items' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
        $this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} button.btn.btn-default' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __( 'Typography', 'plugin-domain' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} button.btn.btn-default',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border_button',
				'label' => __( 'Border', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} button.btn.btn-default',
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background_button',
				'label' => __( 'Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} button.btn.btn-default',
			]
		);
        
        $this->end_controls_section();
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
		$target_link_video = $settings['website_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow_link_video = $settings['website_link']['nofollow'] ? ' rel="nofollow"' : '';
        $fade = ($settings['gallery_layouts'] != 'layout1' ) ? 'false' : 'true';
			?>
		      	<div class="gallery_wrap <?php echo ''.$settings['gallery_layouts'] .''; ?>">
		      		<div class="wrapper-categories-petty">
                  		<ul class="lists-cat"> 
                  			<li class="items"><button type="button" class="btn btn-default is-checked" data-filter="*">All</button></li>
                  			
				            <!-- options -->
				            <?php 
				            $hide_empty = true ;
				            $args = array(
				                'type'      => 'post_type', 
				                'child_of'  => 1,
				                'parent'    => ''
				            );
				            $categories = get_terms( 'category' );
				            $ordering_args = WC()->query->get_catalog_ordering_args( $settings['orderby_blog'], $settings['order_blog'] );
				            $orderby = $settings['orderby_blog'];
				            $order = $settings['order_blog'];
				            $the_query = new \WP_Query( $args );
				            // var_dump($categories);
				            if( !empty($categories) ){
				               foreach ( $categories as $category )  {
				            ?> 
				            <li class="items" >
				            	<?php 
				            	echo '<div class="cat-name">
				            	<button type="button" class="btn btn-default" data-filter=".'. $category->slug .'">'. $category->name .'</button>
				            	</div>' 
				            	;?>
				            </li> <?php } ?>
				        </ul> <?php } ?>
                  	</div>
                  	<div class="gallery_content <?php echo ' gallery_layouts_'.$settings['gallery_layouts'] .''; ?>">
                  		<ul class="list_content" id="gallery">  
	            		 <?php 
	            		 	$the_query = new \WP_Query( $args );
	                        ?>
	                        <?php  include( 'layout/'.$settings['gallery_layouts'].'.php' ); ?>
	                        <?php 
	            		   ?>
	                  	</ul>
                  	</div>
                </div>
		    <?php 
		
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