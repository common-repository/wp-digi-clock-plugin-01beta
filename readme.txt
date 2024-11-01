=== WP DIGI CLOCK PLUGIN ===
Contributors: Sam Burdge
Donate link: http://samburdge.co.uk/
Tags: time,clock,flash,digital
Requires at least: 1.5
Tested up to: 2.3
Stable tag: trunk


== Description ==

Embeds a flash digital clock either in a post, page or within your page template.
The background and font colours are managed via the options menu.
The clock either displays the time as set on the users local machine or as set 
by your web server with an optional offset. It has 12hr (am / pm) or 24hr 
clock formats.

---------------------------------------------------------------------------------------

== Installation ==

1. Upload the wp-digi-clock folder to your wp-content/plugins folder
2. Activate the plugin from the plugins page
3. Go to Options -> WP Digi Clock to choose your colour scheme and time format options

---------------------------------------------------------------------------------------

== Usage ==

To embed in a post or page:

type in [wp_digi_clock] anywhere in a post or page.

to embed in your page template (header, footer, sidebar):

use the function wp_digital_clock() for example:

<li><h2>TIME</h2></li>

<li><?php wp_digital_clock(); ?></li>



