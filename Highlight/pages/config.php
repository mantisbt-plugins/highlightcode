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

html_page_top1( lang_get( 'plugin_highlight_title' ) );
html_page_top2( );

print_manage_menu( );

?>

<br/>
<form action="<?php echo plugin_page( 'config_edit' )?>" method="post">
<table align="center" class="width50" cellspacing="1">

<tr>
	<td class="form-title" colspan="3">
		<?php echo lang_get( 'plugin_highlight_title' ) . ': ' . lang_get( 'plugin_highlight_config' )?>
	</td>
</tr>

<tr>
	<td class="form-title" colspan="3">
		<?php echo lang_get( 'plugin_highlight_message' )?>
	</td>
</tr>

<tr <?php echo helper_alternate_class( )?>>
	<td class="category" width="60%">
		<?php echo lang_get( 'plugin_highlight_process_highlight' )?>
	</td>
	<td class="center" width="20%">
		<label><input type="radio" name="process_highlight" value="1" <?php echo( ON == plugin_config_get( 'process_highlight' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'plugin_highlight_enabled' )?></label>
	</td>
	<td class="center" width="20%">
		<label><input type="radio" name="process_highlight" value="0" <?php echo( OFF == plugin_config_get( 'process_highlight' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'plugin_highlight_disabled' )?></label>
	</td>
</tr>

<tr>
	<td class="center" colspan="3">
		<input type="submit" class="button" value="<?php echo lang_get( 'change_configuration' )?>" />
	</td>
</tr>

</table>
<form>

<?php
html_page_bottom1( __FILE__ );