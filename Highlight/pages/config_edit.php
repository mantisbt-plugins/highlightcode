<?php
/*
 * Copyright (C) 2009-2010	Kirill Krasnov
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

form_security_validate( 'plugin_Highlight_manage_config' );
auth_reauthenticate( );
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );

$f_style_css = gpc_get_string( 'style_css', 'default' );
$f_process_highlight = gpc_get_int( 'process_highlight', ON );

if( plugin_config_get( 'process_highlight' ) != $f_process_highlight ) {
	plugin_config_set( 'process_highlight', $f_process_highlight );
}

if( plugin_config_get( 'style_css' ) != $f_style_css ) {
	plugin_config_set( 'style_css', $f_style_css );
}

form_security_purge( 'plugin_Highlight_manage_config' );
print_successful_redirect( plugin_page( 'config', true ) );
