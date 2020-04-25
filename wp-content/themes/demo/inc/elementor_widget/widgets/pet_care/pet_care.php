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
class Pet_Cares extends Widget_Base {

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
		return 'jws_pet_care';
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
		return __( 'Jws Pet Care', 'fatcy' );
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
				'pet_care_layouts',
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
		$repeater = new \Elementor\Repeater();
        $repeater->add_control(
			'image',
			[
				'label' => __( 'Choose Avatar', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
        $repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'large',
				'separator' => 'none',
			]
		);
        $repeater->add_control(
			'list_url',
			[
				'label' => __( 'Link', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'plugin-domain' ),
				'show_external' => true,
				'default' => [
					'url' => '#',
				],
			]
		);
		$repeater->add_control(
			'list_title', [
				'label' => __( 'Title', 'fatcy' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Title' , 'fatcy' ),
				'label_block' => true,
			]
		);
        $repeater->add_control(
			'list_description', [
				'label' => __( 'Description', 'fatcy' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => __( 'Default description', 'fatcy' ),
				'placeholder' => __( 'Type your description here', 'fatcy' ),
			]
		);
        $repeater->add_control(
			'icon_diamond',
			[
				'label' => __( 'Icon', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);
		$this->add_control(
			'list',
			[
				'label' => __( 'Menu List', 'fatcy' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_name' => __( 'Item #1', 'fatcy' ),
					],
				],
				'title_field' => '{{{ list_name }}}',
			]
		);

		$this->end_controls_section();

        
		//===============TAB_STYLE==================
        $this->start_controls_section(
			'pet_care_style',
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
                    '{{WRAPPER}} .pet_care' => 'text-align: {{VALUE}}',
                ],
            ]
        );
       $this->add_responsive_control(
			'column_gap',
			[
				'label'     => __( 'Columns Gap', 'zahar' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws_pet_care_wrap .pet_care .slick-slide' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .jws_pet_care_wrap .pet_care' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
                    '{{WRAPPER}} .slider_layout_layout5 + .custom_navs button.nav_left' => 'margin-left: calc( {{SIZE}}{{UNIT}}/2 + 25px );',
                    '{{WRAPPER}} .slider_layout_layout5 + .custom_navs button.nav_right' => 'margin-right: calc( {{SIZE}}{{UNIT}}/2 + 25px );',
				],
			]
		);
       	$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .pet_care_content',
			]
		);
        $this->add_responsive_control(
					'pet_care_margin',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> __( 'Margin', 'fatcy' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .pet_care_content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
		$this->add_responsive_control(
					'pet_care_padding',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> __( 'Padding', 'fatcy' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .pet_care_content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
		$this->add_control(
			'pet_care_title',
			[
				'label' => __( 'Title', 'fatcy' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
					'pet_care_title_color',
					[
						'label' 	=> __( 'Title Color', 'fatcy' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '#333333',
						'selectors' => [
							'{{WRAPPER}} .jws_pet_care_wrap .pet_care .testimonials_title' => 'color: {{VALUE}} !important;',
						],
					]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'pet_care_title_typography',
				'label' => __( 'Typography', 'fatcy'),
				'selector' => '{{WRAPPER}} .jws_pet_care_wrap .pet_care .testimonials_title',
			]
		);
		$this->add_responsive_control(
            'margin_title',
            [
                'label' => __( 'Margin Title', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .jws_pet_care_wrap .pet_care.pet_care_layouts_layout1 .jws-pet-care .row.row-eq-height .col-xl-8.col-lg-7.col-12 .pet_care_content h2.testimonials_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'padding_title',
            [
                'label' => __( 'Padding Title', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .jws_pet_care_wrap .pet_care.pet_care_layouts_layout1 .jws-pet-care .row.row-eq-height .col-xl-8.col-lg-7.col-12 .pet_care_content h2.testimonials_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
			'pet_care_des',
			[
				'label' => __( 'Description', 'fatcy' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
					'pet_care_description_color',
					[
						'label' 	=> __( 'Description Color', 'fatcy' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '#333333',
						'selectors' => [
							'{{WRAPPER}} .jws_pet_care_wrap .pet_care .testimonials_description' => 'color: {{VALUE}} !important;',
						],
					]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'pet_care_description_typography',
				'label' => __( 'Typography', 'fatcy'),
				'selector' => '{{WRAPPER}} .jws_pet_care_wrap .pet_care .testimonials_description',
			]
		);
		$this->add_responsive_control(
            'margin_des',
            [
                'label' => __( 'Margin Description', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .jws_pet_care_wrap .pet_care .testimonials_description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'padding_des',
            [
                'label' => __( 'Padding Description', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .jws_pet_care_wrap .pet_care .testimonials_description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
			'pet_care_avatar',
			[
				'label' => __( 'Avatar', 'fatcy' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_responsive_control(
        	'pet_care_avatar_box_radius',
        	[
        		'label' 		=> __( 'Border Radius', 'fatcy' ),
        		'type' 			=> Controls_Manager::DIMENSIONS,
        		'size_units' 	=> [ 'px', 'em', '%' ],
        		'selectors' 	=> [
        			'{{WRAPPER}} .jws_pet_care_wrap .pet_care img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        		],

        		'separator' => 'before',
        	]
		);
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pet_care_avatar_box_shadow',
				'label' => __( 'Box Shadow', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .jws_pet_care_wrap .pet_care img',
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
            $fade = ($settings['pet_care_layouts'] != 'layout1' ) ? 'false' : 'true';
		     ?>
		      	<div class="jws_pet_care_wrap <?php echo ''.$settings['pet_care_layouts'] .''; ?>">
                  <div class="pet_care<?php echo ' pet_care_layouts_'.$settings['pet_care_layouts'] .''; ?>">  
            		 <?php 
            		 	$i = 1;
            		 	foreach (  $settings['list'] as $item ) {
            		    $url = $item['list_url']['url'];
                        $target = $item['list_url']['is_external'] ? ' target="_blank"' : '';
                        $nofollow = $item['list_url']['nofollow'] ? ' rel="nofollow"' : ''; 
                        $position = ($i%2 == 0) ? esc_attr('box-right') : esc_attr('box-left');
                        ?>
            				<div class="jws-pet-care <?php echo $position ?>">
                                    <?php  include( 'layout/'.$settings['pet_care_layouts'].'.php' ); ?>
                                    <div class="rhombus">
                                    	<div class="rhombus_position">
                                    		<span class="icon-rhombus">
                                    			<?php \Elementor\Icons_Manager::render_icon( $item['icon_diamond'], [ 'aria-hidden' => 'true' ] ); ?>
                                    		</span>
                                    	</div>
                                    </div>
                                    <div class="box-empty"></div>  
                            </div>
                            <?php $i ++;
            		  } ?>
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