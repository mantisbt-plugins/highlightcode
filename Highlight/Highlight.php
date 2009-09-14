<?php
/**
 * Created on 22.02.2009
 *
 * Copyright (C) 2009	Kirill Krasnov
 * ICQ					82427351
 * JID					krak@jabber.ru
 * Skype				kirillkr
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

/**
 *  requires MantisPlugin.class.php
 */

require_once( config_get( 'class_path' ) . 'MantisPlugin.class.php' );

/**
 * restore 2 html tags: <pre> and <code>
 * from string like &lt;pre&gt;
 * @param string $p_string
 * @param boolean $p_multiline
 * @return string
 */
function restore_pre_code_tags( $p_string, $p_multiline = true ) {
	$t_string = $p_string;
	$tags = '';
	$t_html_pre_code_tags = "pre, code";

	if( is_blank( $t_html_pre_code_tags ) ) {
		return $t_string;
	}

	$tags = explode( ',', $t_html_pre_code_tags );
	foreach( $tags as $key => $value ) {
		if( !is_blank( $value ) ) {
			$tags[$key] = trim( $value );
		}
	}
	$tags = implode( '|', $tags );

//	$tags = 'pre|code|code\s\S+';
	$t_string = preg_replace( '/&lt;(' . $tags . ')\s*&gt;/ui', '<\\1>', $t_string );
	$t_string = preg_replace( '/&lt;\/(' . $tags . ')\s*&gt;/ui', '</\\1>', $t_string );
	$t_string = preg_replace( '/&lt;(' . $tags . ')\s*\/&gt;/ui', '<\\1 />', $t_string );
	$t_string = preg_replace( '/&lt;(code)\sclass=&quot;(\S+)&quot;\s*&gt;/ui', '<\\1 class="\\2">', $t_string );
	
	return $t_string;
}	

/**
 *  HighlightPlugin Class
 */
class HighlightPlugin extends MantisPlugin {

	/**
	 *  A method that populates the plugin information and minimum requirements.
	 */
	function register( ) {
		$this->name = plugin_lang_get( 'title' );
		$this->description = plugin_lang_get( 'description' );
		$this->page = 'config';

		$this->version = '0.4.4';
		$this->requires = array(
			'MantisCore' => '1.2.0',
		);

		$this->author = 'Krasnov Kirill';
		$this->contact = 'krasnovforum@gmail.com';
		$this->url = 'http://kkrasnov.kanet.ru';
	}

	/**
	 * Install plugin function.
	 * Switch off Mantis Core Formating
	 */
	function install() {
		helper_ensure_confirmed( plugin_lang_get( 'install_message' ), lang_get( 'plugin_install' ) );

		config_set( 'plugin_MantisCoreFormatting_process_urls', OFF );
		config_set( 'plugin_MantisCoreFormatting_process_text', OFF );

		return true;
	}

	/*
	 * Default plugin configuration.
	 */
	function hooks( ) {
		$t_hooks = array(
			'EVENT_LAYOUT_RESOURCES'  => 'print_head_highlight',
			'EVENT_DISPLAY_FORMATTED' => 'formatted',
		);
		return array_merge( parent::hooks(), $t_hooks );
	}

	/**
	 * Config function
	 */
	function config( ) {
		return array(
			'process_highlight'		=> ON,
			'style_css'	=> 'default',
		);
	}

	function print_head_highlight( ) {
		$t_st = '';
		if ( ON == plugin_config_get( 'process_highlight' ) ){
			if ( is_page_name('view.php') ) {
				$t_st .= "\t<script type=\"text/javascript\" src=\"" . plugin_file( 'highlight_pack.js' ) . "\"></script>\n";
				$t_st .= "\t<link rel=\"stylesheet\" title=\"" . plugin_config_get( 'style_css' ) . "\" href=\"" . plugin_file( 'styles/' . plugin_config_get( 'style_css' ) . '.css' ) . "\" />\n";
				$t_st .= "\t<script type=\"text/javascript\">\n";
				$t_st .= "\t\thljs.tabReplace = '<span class=\"indent\">\t</span>';\n";
				$t_st .= "\t\thljs.initHighlightingOnLoad();\n";
				$t_st .= "\t</script>\n";
			}
		}
		return $t_st;
	}

	function formatted( $p_event, $p_string, $p_multiline = true ) {
		$t_string = $p_string;

		//$t_string = string_strip_hrefs( $t_string );
		$t_string = string_html_specialchars( $t_string );
		$t_string = restore_pre_code_tags( $t_string );

		//if( $p_multiline ) {
			//$t_string = string_preserve_spaces_at_bol( $t_string );
			//$t_string = string_nl2br( $t_string );
		//}

		//$t_string = string_insert_hrefs( $t_string );

		//if( ON == plugin_config_get( 'process_buglinks' ) ) {
			//$t_string = string_process_bug_link( $t_string );
			//$t_string = string_process_bugnote_link( $t_string );
		//}

		//if( ON == plugin_config_get( 'process_vcslinks' ) ) {
		//	$t_string = string_process_cvs_link( $t_string );
		//}
		return $t_string;
	}

}
?>