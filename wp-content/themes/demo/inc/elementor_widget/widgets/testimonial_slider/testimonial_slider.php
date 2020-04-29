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
class Testimonial_Slider extends Widget_Base {

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
		return 'jws_testimonial_slider';
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
		return __( 'Jws Testimonial Slider', 'fatcy' );
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
				'label' => __( 'Menu List', 'fatcy' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
				'slider_layouts',
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
			'list_name', [
				'label' => __( 'Name', 'fatcy' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'List Name' , 'fatcy' ),
				'label_block' => true,
			]
		);
        $repeater->add_control(
			'list_job', [
				'label' => __( 'Job', 'fatcy' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'List Job' , 'fatcy' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'title', [
				'label' => __( 'Title', 'fatcy' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'List Job' , 'fatcy' ),
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
				'star',
				[
					'label'     => __( 'Star Rating', 'fatcy' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => '1',
					'options'   => [
						'1'   => __( '1 Star', 'fatcy' ),
						'2'   => __( '2 Star', 'fatcy' ),
                        '3'   => __( '3 Star', 'fatcy' ),
                        '4'   => __( '4 Star', 'fatcy' ),
                        '5'   => __( '5 Star', 'fatcy' ),
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
						'list_name' => __( 'Name #1', 'fatcy' ),
					],
				],
				'title_field' => '{{{ list_name }}}',
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
			'section_slider_options',
			[
				'label'     => __( 'Slider Options', 'fatcy' ),
				'type'      => Controls_Manager::SECTION,
			]
		);

		$this->add_control(
			'navigation',
			[
				'label'     => __( 'Navigation', 'fatcy' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'both',
				'options'   => [
                    'both' => __( 'Arrows And Dots', 'fatcy' ),
					'arrows' => __( 'Arrows', 'fatcy' ),
                    'dots' => __( 'Dots', 'fatcy' ),
					'none'   => __( 'None', 'fatcy' ),
				],
			]
		);

		$this->add_responsive_control(
			'slides_to_show',
			[
				'label'          => __( 'posts to Show', 'fatcy' ),
				'type'           => Controls_Manager::NUMBER,
				'default'        => 1,
				'tablet_default' => 1,
				'mobile_default' => 1,
			]
		);

		$this->add_responsive_control(
			'slides_to_scroll',
			[
				'label'          => __( 'posts to Scroll', 'fatcy' ),
				'type'           => Controls_Manager::NUMBER,
				'default'        => 1,
				'tablet_default' => 1,
				'mobile_default' => 1,
			]
		);
        $this->add_control(
			'center_mode',
			[
				'label'        => __( 'Center Mode', 'fatcy' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			]
		);
        	$this->add_responsive_control(
			'center_padding',
			[
				'label'     => __( 'Center Padding', 'fatcy' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
				'condition' => [
					'center_mode'             => 'yes',
				],
                'selectors' => [
					'{{WRAPPER}} .slider_layout_layout5 + .custom_navs button.nav_left' => 'left: {{VALUE}};',
                    '{{WRAPPER}} .slider_layout_layout5 + .custom_navs button.nav_right' => 'right: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'autoplay',
			[
				'label'        => __( 'Autoplay', 'fatcy' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			]
		);
		$this->add_control(
			'autoplay_speed',
			[
				'label'     => __( 'Autoplay Speed', 'fatcy' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'selectors' => [
					'{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
				],
				'condition' => [
					'autoplay'             => 'yes',
				],
			]
		);
		$this->add_control(
			'pause_on_hover',
			[
				'label'        => __( 'Pause on Hover', 'fatcy' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'autoplay'             => 'yes',
				],
			]
		);

		$this->add_control(
			'infinite',
			[
				'label'        => __( 'Infinite Loop', 'fatcy' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'transition_speed',
			[
				'label'     => __( 'Transition Speed (ms)', 'fatcy' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 500,
			]
		);
		$this->end_controls_section();
		//===============TAB_STYLE==================
        $this->start_controls_section(
			'testimonials_slider_style',
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
                    '{{WRAPPER}} .testimonials_slider' => 'text-align: {{VALUE}}',
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
					'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .slick-slide' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
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
				'selector' => '{{WRAPPER}} .slider_content',
			]
		);
        $this->add_responsive_control(
					'testimonials_slider_margin',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> __( 'Margin', 'fatcy' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .slider_content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
		$this->add_responsive_control(
					'testimonials_slider_padding',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> __( 'Padding', 'fatcy' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .slider_content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
		$this->add_control(
			'testimonials_slider_title',
			[
				'label' => __( 'Title', 'fatcy' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
					'testimonials_slider_title_color',
					[
						'label' 	=> __( 'Title Color', 'fatcy' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '#333333',
						'selectors' => [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .testimonials_title' => 'color: {{VALUE}} !important;',
						],
					]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'testimonials_slider_title_typography',
				'label' => __( 'Typography', 'fatcy'),
				'selector' => '{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .testimonials_title',
			]
		);
		$this->add_responsive_control(
            'margin_title',
            [
                'label' => __( 'Margin Title', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonials_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .testimonials_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
			'testimonials_slider_des',
			[
				'label' => __( 'Description', 'fatcy' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
					'testimonials_slider_description_color',
					[
						'label' 	=> __( 'Description Color', 'fatcy' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '#333333',
						'selectors' => [
							'{{WRAPPER}} .testimonials_description' => 'color: {{VALUE}} !important;',
						],
					]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'testimonials_slider_description_typography',
				'label' => __( 'Typography', 'fatcy'),
				'selector' => '{{WRAPPER}} .testimonials_description',
			]
		);
		$this->add_responsive_control(
            'margin_des',
            [
                'label' => __( 'Margin Description', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonials_description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .testimonials_description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
			'testimonials_slider_name',
			[
				'label' => __( 'Name', 'fatcy' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
					'testimonials_slider_name_color',
					[
						'label' 	=> __( 'Name Color', 'fatcy' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '#333333',
						'selectors' => [
							'{{WRAPPER}} .testimonials_name' => 'color: {{VALUE}} !important;',
						],
					]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'testimonials_slider_name_typography',
				'label' => __( 'Typography', 'fatcy'),
				'selector' => '{{WRAPPER}} .testimonials_name',
			]
		);
		$this->add_responsive_control(
            'margin_name',
            [
                'label' => __( 'Margin Name', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonials_name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'padding_name',
            [
                'label' => __( 'Padding Name', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonials_name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
			'testimonials_slider_job',
			[
				'label' => __( 'job', 'fatcy' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
					'testimonials_slider_job_color',
					[
						'label' 	=> __( 'job Color', 'fatcy' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '#333333',
						'selectors' => [
							'{{WRAPPER}} .testimonials_job' => 'color: {{VALUE}} !important;',
						],
					]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'testimonials_slider_job_typography',
				'label' => __( 'Typography', 'fatcy'),
				'selector' => '{{WRAPPER}} .testimonials_job',
			]
		);
		$this->add_responsive_control(
            'margin_job',
            [
                'label' => __( 'Margin Job', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonials_job' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'padding_job',
            [
                'label' => __( 'Padding Job', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonials_job' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
			'testimonials_slider_avatar',
			[
				'label' => __( 'Avatar', 'fatcy' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_responsive_control(
        	'testimonials_slider_avatar_box_radius',
        	[
        		'label' 		=> __( 'Border Radius', 'fatcy' ),
        		'type' 			=> Controls_Manager::DIMENSIONS,
        		'size_units' 	=> [ 'px', 'em', '%' ],
        		'selectors' 	=> [
        			'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        		],

        		'separator' => 'before',
        	]
		);
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'testimonials_slider_avatar_box_shadow',
				'label' => __( 'Box Shadow', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider img',
			]
		);

        $this->end_controls_section();
        $this->start_controls_section(
			'testimonials_slider_arrows_style',
			[
				'label' => __( 'Arrows', 'fatcy' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
         $this->add_control(
					'arrows_color',
					[
						'label' 	=> __( 'Arrows Color', 'fatcy' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} nav.custom_navs button.nav_left i, nav.custom_navs button.nav_right i' => 'color: {{VALUE}};',
						],
					]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __( 'Border', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} nav.custom_navs button.nav_left, nav.custom_navs button.nav_right',
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background_arrows',
				'label' => __( 'Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} nav.custom_navs button.nav_left, nav.custom_navs button.nav_right',
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'testimonials_slider_dot_style',
			[
				'label' => __( 'Dots', 'fatcy' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
         $this->add_control(
					'dot_color',
					[
						'label' 	=> __( 'Color', 'fatcy' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .custom_dots .slick-dots li button' => 'background: {{VALUE}};',
						],
					]
		);
         $this->add_control(
					'dot_color_active',
					[
						'label' 	=> __( 'Color Active', 'fatcy' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .custom_dots .slick-dots li.slick-active button' => 'background: {{VALUE}};',
						],
					]
		);
         $this->add_control(
					'dot_brcolor_active',
					[
						'label' 	=> __( 'Border Color Active', 'fatcy' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .custom_dots .slick-dots li.slick-active' => 'border-color: {{VALUE}};',
						],
					]
		);
        $this->end_controls_section();
        //========================Content Link Video====================
        $this->start_controls_section(
			'content_section_link_video',
			[
				'label' => __( 'Content Link Video', 'plugin-name' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
            'icon_link_video',
            [
                'label' => __( 'Icon Link Video', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );
        $this->add_control(
            'color_icon_link_video',
            [
                'label' => __( 'Icon Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .link-video i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'font_size_icon_link_video',
            [
                'label' => __( 'Icon Size', 'plugin-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 25,
                ],
                'selectors' => [
                    '{{WRAPPER}} .link-video i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __( 'Border', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} a.link-video',
			]
		);
        $this->add_control(
			'width_link_video',
			[
				'label' => __( 'Width', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} a.link-video' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'height_link_video',
			[
				'label' => __( 'Height', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} a.link-video' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
            'margin_link_video',
            [
                'label' => __( 'Margin', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} a.link-video' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'padding_link_video',
            [
                'label' => __( 'Padding', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} a.link-video' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} a.link-video',
			]
		);

		$this->end_controls_section();
		//========================Content Icon====================
		$this->start_controls_section(
            'content_section_icon',
            [
                'label' => __( 'Content Icon', 'plugin-name' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'text_align_icon',
            [
                'label' => __( 'Alignment Icon', 'plugin-domain' ),
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
                    '{{WRAPPER}} .testimonials_icon' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'icon',
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
            'icon_color',
            [
                'label' => __( 'Icon Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonials_icon i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'font_size_icon',
            [
                'label' => __( 'Icon Size', 'plugin-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 25,
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonials_icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin_icon',
            [
                'label' => __( 'Margin Icon', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonials_icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding_icon',
            [
                'label' => __( 'Padding Services', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonials_icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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

            $dots = ($settings['navigation'] == 'dots' || $settings['navigation'] == 'both') ? 'true' : 'false';
            $arrows = ($settings['navigation'] == 'arrows' || $settings['navigation'] == 'both') ? 'true' : 'false';
            $center = ($settings['center_mode'] == 'yes') ? 'true' : 'false';
            $autoplay = ($settings['autoplay'] == 'yes') ? 'true' : 'false';
            $pause_on_hover = ($settings['pause_on_hover'] == 'yes') ? 'true' : 'false';
            $infinite = ($settings['infinite'] == 'yes') ? 'true' : 'false';
            $autoplay_speed = ($settings['autoplay_speed']) ? $settings['autoplay_speed'] : '0';
            $fade = ($settings['slider_layouts'] != 'layout1' ) ? 'false' : 'true';
            $data_slick = 'data-slick=\'{"fade":'.$fade.', "slidesToShow":'.$settings['slides_to_show'].' ,"slidesToScroll": '.$settings['slides_to_scroll'].', "autoplay": '.$autoplay.',"arrows": '.$arrows.', "dots":'.$dots.', "autoplaySpeed": '.$autoplay_speed.',"pauseOnHover":'.$pause_on_hover.',"infinite":'.$infinite.',
            "speed": '.$settings['transition_speed'].', "centerMode": '.$center.',"centerPadding": "'.$settings['center_padding'].'", "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": '.$settings['slides_to_show_tablet'].',"slidesToScroll": '.$settings['slides_to_scroll_tablet'].',"centerPadding": "'.$settings['center_padding_tablet'].'"}},
            {"breakpoint": 768,"settings":{"slidesToShow": '.$settings['slides_to_show_mobile'].',"slidesToScroll": '.$settings['slides_to_scroll_mobile'].',"centerPadding": "'.$settings['center_padding_mobile'].'"}}]}\''; 
		if ( $settings['list'] ) {
		     ?>
		      	<div class="jws_testimonials_slider_wrap <?php echo ''.$settings['slider_layouts'] .''; ?>">
                  <div class="testimonials_slider<?php echo ' slider_layout_'.$settings['slider_layouts'] .''; ?>" <?php echo wp_kses_post( $data_slick); ?>>  
            		  <?php foreach (  $settings['list'] as $item ) {
            		      $url = $item['list_url']['url'];
                          $target = $item['list_url']['is_external'] ? ' target="_blank"' : '';
                          $nofollow = $item['list_url']['nofollow'] ? ' rel="nofollow"' : ''; 
                          ?>
            				<div class="jws-slick-slider">
                                    <?php  include( 'layout/'.$settings['slider_layouts'].'.php' ); ?>   
                            </div>
            		  <?php } ?>
                  </div>
                    <div class="slider-nav-thumbnails">
                    	<?php foreach (  $settings['list'] as $item ) {?>
                    		<div class="slick-slide">
                                    <div class="items"><?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item ); ?>
                                    <div class="wrapper_curl">
                                     	<span class="curl"></span>
                                    </div>
                                 </div> 
                            </div>
                        <?php } ?>
                    </div>
                  <?php if($arrows == 'true') : ?>
                  <nav class="custom_navs">
                        <button class="button-nav nav_left"><i class="fas fa-chevron-left"></i></button>
                        <button class="button-nav nav_right"><i class="fas fa-chevron-right"></i></button>
                  </nav>
                  <?php endif; ?>
                  <?php if($settings['slider_layouts'] != 'layout1' && ($settings['navigation'] == 'dots' || $settings['navigation'] == 'both') ) : ?><div class="custom_dots"></div><?php endif; ?>
                </div>
		    <?php }  
		
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