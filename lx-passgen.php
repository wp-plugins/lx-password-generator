<?php
/* 
Plugin Name: LX Password Generator
Plugin URI: http://lx6g.com/2011/01/passgen-for-wordpress/
Version: 1.0.2
Author: Alex Granovsky
Author URI: http://lx6g.com
Description: Simple yet nifty password generation form to be placed in any page or post you like.
Copyright 2010 Alexander Granovsky  (alex@granovsky.fm)
*/

define('LXPASSGEN_PLUGIN_URL', plugin_dir_url( __FILE__ ));

              
if (!class_exists("lxPassGen")) {
	class lxPassGen {
		function lxPassGen() {
			wp_register_style('lx-passgen.css', LXPASSGEN_PLUGIN_URL . 'lx-passgen.css');
			wp_enqueue_style('lx-passgen.css');
			wp_register_script('lx-passgen.js', LXPASSGEN_PLUGIN_URL . 'lx-passgen.js');
			wp_enqueue_script('lx-passgen.js');
		}
	
		function init() {
        }

		function gen_pass($args){
			$defaults = array('length' => '8', 'upper' => '1', 'lower' => '1', 'digits' => '1', 'special' => '0');
  	   		$args = wp_parse_args( $args, $defaults );
	        extract( $args, EXTR_SKIP );
    	    $length = preg_replace("/[^0-9]/", '', $length);
        	$lower = preg_replace("/[^0-9]/", '', $lower);
    	    $digits = preg_replace("/[^0-9]/", '', $digits);
	        $special = preg_replace("/[^0-9]/", '', $special);
    	    if ($length < 4 or $length > 64)
				$length = 8;        
        
	        $html = "<!-- LX PassGen--><div class='passgen'>";
    	    $html .= "<form name='lxPassGenForm'>";
        	$html .= '<p>Password length (4 - 64)  <input name="length" size=4 value=' .$length. ' onChange="checkLength();"></p>';
	        $html .= "<p>Options<br/>";
    	    $html .= "<span class='passgen-list-item'><label><input type='checkbox' name='lower' ".(($lower=='1')?"checked":"").">lower-case letters</label></span><br/>";
        	$html .= "<span class='passgen-list-item'><label><input type='checkbox' name='upper' ".(($upper=='1')?"checked":"").">upper-case letters</label></span><br/>";
	        $html .= "<span class='passgen-list-item'><label><input type='checkbox' name='digits' ".(($digits=='1')?"checked":"").">digits</label></span><br/>";
    	    $html .= "<span class='passgen-list-item'><label><input type='checkbox' name='special' ".(($special=='1')?"checked":"").">special characters</label></span><br/>";
        	$html .= "</p>";
	        $html .= "<p><input type='button' value=' Generate Password ' onClick='generatePassword()'></p>";
    	    $html .= "<p>Your new password<br/><input type='text' name='result' value='' size='40'></p></form></div>";
        
        	return $html;
		}


		function show_passgen($atts){
			extract(shortcode_atts(array('length' => '8', 'upper' => '1', 'lower' => '1', 'digits' => '1', 'special' => '0'), $atts));
	    	$args = array('length' => $length, 'upper' => $upper, 'lower' => $lower, 'digits' => $digits, 'special' => $special);
    		$html = lxPassGen::gen_pass($args);
    		return $html;
		}


	}
}

if (class_exists("lxPassGen")) {$pg = new lxPassGen();}
if (isset($pg)) {
add_shortcode('passgen', array(&$pg,'show_passgen'),1); // setup shortcode [passgen]
}
?>
