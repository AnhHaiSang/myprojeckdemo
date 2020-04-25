<?php
function jwstheme_autoCompileLess($inputFile, $outputFile) {
    if (class_exists('lessc')) {
        require_once( ABSPATH.'/wp-admin/includes/file.php' );	
    	WP_Filesystem();
    	global $wp_filesystem, $jws_option;
     
        $less = new lessc();
    
        $less->setFormatter("classic");
        $less->setPreserveComments(true);
    	/*Styling Options*/

    	$main_color = (isset($jws_option['main-color']) && $jws_option['main-color']) ? $jws_option['main-color']: '#ed2121';
        $main_color2 = (isset($jws_option['main-color2']) && $jws_option['main-color2']) ? $jws_option['main-color2']: '#006666';
        $main_color3 = (isset($jws_option['main-color3']) && $jws_option['main-color3']) ? $jws_option['main-color3']: '#b9f1eb';
        
        $font1 = (isset($jws_option['font1']['font-family'])&& $jws_option['font1']['font-family'])?$jws_option['font1']['font-family']: 'Montserrat';
        $color1 = (isset($jws_option['color1'])&& $jws_option['color1'])?$jws_option['color1']: '#333333';
        $color2 = (isset($jws_option['color2'])&& $jws_option['color2'])?$jws_option['color2']: '#959595';
        $color_courses = (isset($jws_option['color_courses'])&& $jws_option['color_courses'])?$jws_option['color_courses']: '#ff9800';
        $color_courses_hover = (isset($jws_option['color_courses_hover'])&& $jws_option['color_courses_hover'])?$jws_option['color_courses_hover']: '#ee8809';
        $fontbody = (isset($jws_option['opt-typography-body']['color'])&& $jws_option['opt-typography-body']['color'])?$jws_option['opt-typography-body']['color']: '#585858';
        $variables = array(
    		"main_color" => $main_color,
            "main_color2" => $main_color2,
            "main_color3" => $main_color3,
            "font_1" => $font1,
            "color_1" => $color1,
            "color_2" => $color2,
            "color_courses" => $color_courses,
            "color_courses_hover" => $color_courses_hover,
            "color_body" => $fontbody,
            
    		
        );
        $less->setVariables($variables);
        $cacheFile = $inputFile.".cache";
        if (file_exists($cacheFile)) {
                $cache = unserialize($wp_filesystem->get_contents($cacheFile));
        } else {
                $cache = $inputFile;
        }
        $newCache = $less->cachedCompile($inputFile);
        if (!is_array($cache) || $newCache["updated"] > $cache["updated"]) {
                $wp_filesystem->put_contents($cacheFile, serialize($newCache));
                $wp_filesystem->put_contents($outputFile, $newCache['compiled']);
        }
    }
}
function jwstheme_addLessStyle() {
	try {
		$inputFile = JWS_ABS_PATH.'/assets/css/less/style.less';
		$outputFile = JWS_ABS_PATH.'/assets/css/style.css';
		jwstheme_autoCompileLess($inputFile, $outputFile);
  
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
}


add_action('wp_enqueue_scripts', 'jwstheme_addLessStyle');

