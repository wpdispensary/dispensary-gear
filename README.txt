=== Dispensary Gear ===
Contributors: deviodigital
Donate link: https://www.wpdispensary.com
Tags: dispensary, cannabis, marijuana, ecommerce, wp-dispensary, gear
Requires at least: 3.0.1
Tested up to: 4.9.4
Stable tag: 1.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin adds a Gear menu type to the WP Dispensary menu plugin.

== Description ==

This plugin adds a Gear menu type to the [WP Dispensary](https://www.wpdispensary.com) menu plugin.

**Release Notes**

You can read full details in our [blog post](https://www.wpdispensary.com/dispensary-gear-add-on/).

**Requirements**

When using the Dispensary Gear plugin, [WP Dispensary](https://www.wpdispensary.com) version 1.9.18+ needs to be installed and activated in order make display the `Gear` menu type's pricing and details on individual item pages.

**Shortcode**

You can display your Dispensary Gear by adding the following shortcode:

`[wpd-gear]`

Full list of options:

`[wpd-gear title="" posts="100" info="show" image="show" imgsize="dispensary-image" class="" viewall=""]`

You can also display your Gear items by using the Dispensary Gear widget that this plugin adds.

**Contribute**

Want to help this plugin get better? Head over to [Github](https://github.com/wpdispensary/dispensary-gear) and open an issue or submit a pull request.

== Installation ==

1. In your WordPress admin dashboard, go to `Plugins` -> `Add New` and search for **Dispensary Gear** 
3. Activate the plugin and enjoy!

== Changelog ==

= 1.2.0 =
* Added `viewall` shortcode option (req: WPD 1.9.18+) in `admin/class-wpd-gear-shortcodes.php`
* Added vendor taxonomy filter and display in `admin/class-wpd-gear-data-output.php`
* Added check to hide vendors and categories if empty in `admin/class-wpd-gear-data-output.php`
* Added `wpd_gear` shortcode name for attribute filter in `admin/class-wpd-gear-shortcodes.php`
* Fixed display bug for price outputs in `admin/class-wpd-gear-shortcodes.php`
* Fixed depreciated string value in get_bloginfo function in `admin/class-wpd-gear-shortcodes.php`
* Fixed nonce error for gearpricesmeta_noncename in `admin/class-wpd-gear-metaboxes.php`
* Fixed `WP_DEBUG` notice by adding a default value for $rewrite variable in `admin/class-wpd-gear-post-type.php`
* Fixed `WP_DEBUG` notice by adding `global $post` to Gear vendors and categories in `admin/class-wpd-gear-data-output.php`
* Updated admin menu order for `Gear` in `admin/class-wpd-gear-post-type.php`
* Updated categories table code for display in `admin/class-wpd-gear-data-output.php`
* Updated default widget title from `Recent Gear` to `Dispensary Gear` in `admin/class-wpd-gear-widgets.php`

= 1.1.0 =
* Added in additional action hook in `admin/class-wpd-gear-shortcodes.php`
* Added new shortcode options in `admin/class-wpd-gear-shortcodes.php`
* Fixed term name for gear categories in `admin/class-wpd-gear-data-output.php`
* Fixed term name for gear categories in `admin/class-wpd-gear-widgets.php`
* Updated image display to include default images in `admin/class-wpd-gear-shortcodes.php`

= 1.0 =
* Initial release
