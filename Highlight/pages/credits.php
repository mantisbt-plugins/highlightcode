<?php
/*
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

auth_reauthenticate( );
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );

html_page_top1( plugin_lang_get( 'title' ) );
html_page_top2( );

print_manage_menu( );

?>
<table align="center" class="width50" cellspacing="1">
	<tr>
		<td class="form-title" colspan="3"><?php echo plugin_lang_get( 'credits' ); ?>:</td>
	</tr>
	<tr>
		<td class="category" colspan="3"><a href="http://www.mantisbt.org/forums/memberlist.php?mode=viewprofile&u=16947">Crayon</a></td>
	</tr>
</table>
<?php
html_page_bottom1( );