<?php
/*
Plugin Name: WP Digi Clock
Plugin URI: http://www.samburdge.co.uk
Description: Insert a flash digital clock into your wordpress template
Version: 1.0
Author: Sam Burdge
Author URI: http://www.samburdge.co.uk
*/
/*  Copyright 2006  Sam Burdge (sam@samburdge.co.uk)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA


COLOR PICKER SELECTOR SCRIPT IS COPYRIGHTED BY:

FREE-COLOR-PICKER.COM
HTTP://WWW.FREE-COLOR-PICKER.COM
            
PERMISSION GIVEN TO USE THIS SCRIPT IN ANY KIND
OF APPLICATIONS IF SCRIPT CODE REMAINS
UNCHANGED AND THE ANCHOR TAG "POWERED BY FCP"
REMAINS VALID AND VISIBLE TO THE USER.

*/
/* VERSION TRACKING

31/10/2007 - version (o.1 BETA). 
4/12/2007 - version (1.0). - Added features - colour pickers, server time, time offset, 12hr and 24hr formats.

*/


//add the javascript
function digiclockJS(){
	
	echo '<script type="text/javascript" src="'.get_settings('siteurl').'/wp-content/plugins/wp-digi-clock/swfobject.js"></script>
<script src="'.get_bloginfo('url').'/wp-content/plugins/wp-digi-clock/201a.js" type="text/javascript"></script>
';
}



//embed in a post or page
function wp_digi_clock($digi_clock_content) {
include('wp-clock-params.php');
if($wpc_time_format == "24"){$clock_num = "24";}
if($time_type == "server"){$st = "_st";}
global $post;
$clock_swf_embed = '<div id="wpdigiclock'.$post->ID.'"></div><script type="text/javascript">
var so = new SWFObject("'. get_settings('siteurl') . '/wp-content/plugins/wp-digi-clock/digitalclock'. $clock_num .''.$st.'.swf?textcolor='.$wpc_textcolor.'&hrs='. date('G') .'&t_offset_type='.$t_offset_type.'&t_offset='.$t_offset.'", "mymovie", "79", "20", "8", "'. $wpc_bgcolor .'");
so.write("wpdigiclock'.$post->ID.'");
</script><p>';
$digi_clock_content = preg_replace('/\[wp_digi_clock\]/',$clock_swf_embed, $digi_clock_content);
echo $digi_clock_content;
}

//embed using template tag
function wp_digital_clock($cl_id) {
include('wp-clock-params.php');
if($wpc_time_format == "24"){$clock_num = "24";}
if($time_type == "server"){$st = "_st";}
$digi_clock_embed = '<div id="wpdigiclock'.$cl_id.'"></div><script type="text/javascript">
var so = new SWFObject("'.get_settings('siteurl').'/wp-content/plugins/wp-digi-clock/digitalclock'. $clock_num .''.$st.'.swf?textcolor='.$wpc_textcolor.'&hrs='. date('G') .'&t_offset_type='.$t_offset_type.'&t_offset='.$t_offset.'", "mymovie", "79", "20", "8", "'. $wpc_bgcolor .'");
so.write("wpdigiclock'.$cl_id.'");
</script>';

echo $digi_clock_embed;
}

add_filter('the_content', 'wp_digi_clock', 150);

add_action('wp_head', 'digiclockJS');


//options page
function digi_clock_options_page(){
$clock_updated = $_GET['clock_updated'];
if($clock_updated=="true"){
$updated_wpc = '<div class="updated"><p><strong>Options saved.</strong></p></div>';}
include('wp-clock-params.php');
if($wpc_time_format == "24"){$clock_num = "24";}
if($time_type == "server"){$st = "_st";}
print $updated_wpc.'<div class="wrap">
<div id="colorpicker201" class="colorpicker201" style="margin-left: 500px;"></div>
	<h2>WP Digi Clock</h2>

<script type="text/javascript" src="'.get_settings('siteurl').'/wp-content/plugins/wp-digi-clock/swfobject.js"></script>
<div id="wpdigiclock"></div><script type="text/javascript">
var so = new SWFObject("'. get_settings('siteurl') . '/wp-content/plugins/wp-digi-clock/digitalclock'. $clock_num .''.$st.'.swf?textcolor='.$wpc_textcolor.'&hrs='. date('G') .'&t_offset_type='.$t_offset_type.'&t_offset='.$t_offset.'", "mymovie", "79", "20", "8", "'. $wpc_bgcolor .'");
so.write("wpdigiclock");
</script>

<p><b>Choose the colour scheme for your clock:</b></p>

<form method="post" action="'.get_settings('siteurl').'/wp-content/plugins/wp-digi-clock/update_params.php">
<table>
<tr><td align="right">
Font colour: </td><td>
<input type="button" onclick="showColorGrid2(\'clockfontcolor\',\'sample_1\');" value="Select Colour" />&nbsp;<input type="text" name="clockfontcolor" id="clockfontcolor" value="'.$wpc_textcolor.'" />&nbsp;
<input type="text" ID="sample_1" size="1" value="" style="background: '.$wpc_textcolor.'" />

</td></tr>
<tr><td align="right">
Background colour: </td><td>
<input type="button" onclick="showColorGrid2(\'clockbgcolor\',\'sample_2\');" value="Select Colour" />&nbsp;<input type="text" name="clockbgcolor" id="clockbgcolor" value="'.$wpc_bgcolor.'" />&nbsp;
<input type="text" ID="sample_2" size="1" value="" style="background: '.$wpc_bgcolor.'" />


</td></tr>
</table>
<p><b>Choose the time format:</b></p>
<select name="time_format">
<option value="12" ';
if($wpc_time_format=="12"){ print 'selected="selected"';}
print '>Non-military (12hr)</option>
<option value="24" ';
if($wpc_time_format=="24"){ print 'selected="selected"';}
print'>Military (24hr)</option>
</select>

<p><b>Choose the time source:</b> (local time will read the time from the users local machine, while server time reads the time from your web server)</p>
<p><input type="radio" name="time_type" value="local" ';
if($time_type=="local"){print 'checked="checked" ';} 
print '/>Local time <input type="radio" name="time_type" value="server" ';

if($time_type=="server"){print 'checked="checked" ';}
print'/>Server time</p>
<p><b>Server time offset:</b> (only applies if server time is selected)</p>
<p>Type: <input type="radio" name="t_offset_type" value="plus" ';
if($t_offset_type=="plus"){print 'checked="checked" ';}
print '/>Plus <input type="radio" name="t_offset_type" value="minus" ';
if($t_offset_type=="minus"){print 'checked="checked" ';}
print '/>Minus</p>
<p>Number of hours: <input type="text" name="t_offset" value="'.$t_offset.'" size="2" maxlength="2" /></p>

<input type="submit" value="Update Options &raquo;" />

</form>
<p>WP Digi Clock Plugin by <a href="http://www.samburdge.co.uk" target="_blank">Sam Burdge</a> 2007</p>
</div>';}

function digi_clock_admin_page(){
	add_submenu_page('options-general.php', 'WP Digi Clock', 'WP Digi Clock', 5, 'wp-digi-clock.php', 'digi_clock_options_page');
}

add_action('admin_menu', 'digi_clock_admin_page');

?>