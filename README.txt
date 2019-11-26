=== Dispensary Gear ===
Contributors: wpdispensary, deviodigital
Donate link: https://www.wpdispensary.com
Tags: weed, dispensary, cannabis, marijuana, wp-dispensary, ecommerce, gear
Requires at least: 3.0.1
Tested up to: 5.3
Stable tag: 2.0.3
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

= 2.0.3 =
*   Added minified version of admin CSS in `admin/css/wpd-gear-admin.min.css`
*   Updated admin widget color styles to remove green bg color in `admin/css/wpd-gear-admin.css`
*   Updated admin widget title in `admin/class-wpd-gear-widgets.php`
*   Updated `$wpd_gear_slug_cap` in the widget description in `admin/class-wpd-gear-widgets.php`
*   Updated `.pot` file with text strings for localization in `languages/wpd-gear.pot`
*   General code cleanup throughout multiple files

= 2.0.2 =
*   Updated function name for Gear custom post type in `admin/class-wpd-gear-post-type.php`

= 2.0.1 =
*   Bugfix changed function names in the activator for post type and taxonomies in `includes/class-wpd-gear-activator.php`
*   Updated featured images array to include `wpd-thumbnail` size in `admin/class-wpd-gear-widgets.php`
*   Updated REST API data to include `wpd-thumbnail` size in `admin/class-wpd-gear-rest-api.php`
*   General code cleanup throughout multiple files

= 2.0 =
*   Added `orderby` and `meta_key` shortcode attributes in `admin/class-wpd-gear-shortcodes.php`
*   Updated eCommerce display to remove comma between categories in `admin/wpd-gear-functions.php`
*   Updated select options for featured image sizes in widgets in `admin/class-wpd-gear-widgets.php`
*   Updated product titles to use h2 wrapper in `admin/class-wpd-gear-shortcodes.php`
*   Updated `.pot` file with text strings for localization in `languages/wpd-gear.pot`
*   General code cleanup throughout multiple files

= 1.9 =
*   Added 'prices' REST API endpoint in `admin/class-wpd-gear-rest-api.php`
*   Added 'details' REST API endpoint in `admin/class-wpd-gear-rest-api.php`
*   Added REST API endpoint for various featured image sizes in `admin/class-wpd-gear-rest-api.php`

= 1.8.2 =
*   Bug fix pass the ID argument to prices and image helper functions in `admin/class-wpd-gear-shortcodes.php`

= 1.8.1 =
*   Updated the widget to pass the post ID to the `wpd_product_image` helper function in `admin/class-wpd-gear-widgets.php`

= 1.8 =
*   Added gear prices to `get_wpd_all_prices_simple` filter in `admin/wpd-gear-functions.php`
*   Added gear to `wpd_menu_types` helper function in `admin/wpd-gear-functions.php`
*   Added gear to `wpd_top_sellers_metabox` filter in `admin/class-wpd-gear-metaboxes.php`
*   Updated widget to use the `wpd_product_image` helper function in `admin/class-wpd-gear-widgets.php`
*   Updated code to escape `$_POST` metabox data in `admin/class-wpd-gear-metaboxes.php`
*   Updated gear category taxonomy `show_in_rest` value to `true` in `admin/class-wpd-gear-taxonomies.php`
*   Updated shortcode to use `get_wpd_product_image` helper function in `admin/class-wpd-gear-shortcodes.php`
*   Updated product title to use `get_the_title` function in `admin/class-wpd-gear-shortcodes.php`
*   WordPress Coding Standards updates in `admin/class-wpd-gear-shortcodes.php`

= 1.7.1 =
*   Removed custom REST API codes for Gear category endpoint in `admin/class-wpd-gear-rest-api.php`

= 1.7 =
*   Added Gear category to the eCommerce add-on's single item display in `admin/wpd-gear-functions.php`
*   Removed extra `}` in the Gear helper functions in `admin/wpd-gear-functions.php`
*   Updated text strings for localization in `admin/wpd-gear-functions.php`
*   Updated `.pot` file with new text strings for localization in `languages/wpd-gear.pot`
*   General code cleanup

= 1.6 =
*   Added 2 helper functions `get_wpd_gear_prices_simple` and `wpd_gear_prices_simple` in `admin/wpd-gear-functions.php`
*   Added 2 action hooks `wpd_gear_widget_inside_loop_before` and `wpd_gear_widget_inside_loop_before` in `admin/class-wpd-gear-widgets.php`
*   Updated shortcode to use the new prices helper functions in `admin/class-wpd-gear-shortcode.php`
*   Updated text for admin `post_updated_messages` in `admin/class-wpd-gear-post-type.php`

= 1.5 =
*   Updated `Gear` display text to change based on custom permalink base in `admin/class-wpd-gear-post-type.php`
*   Updated `Gear` display text to change based on custom permalink base in `admin/class-wpd-gear-shortcodes.php`
*   Updated `Gear` display text to change based on custom permalink base in `admin/class-wpd-gear-widgets.php`
*   Updated translatable text to work with variable in `admin/class-wpd-gear-post-type.php`
*   Updated translatable text to work with variable in `admin/class-wpd-gear-post-type.php`
*   Updated shortcode to use the `wpd_currency_code` function in `admin/class-wpd-gear-shortcodes.php`
*   Updated Price/Donation display option updates in `admin/class-wpd-gear-shortcodes.php`
*   Updated various text strings to be translatable in `admin/class-wpd-gear-data-output.php`
*   Updated various text strings to be translatable in `admin/class-wpd-gear-metaboxes.php`
*   Updated various text strings to be translatable in `admin/class-wpd-gear-shortcodes.php`
*   Updated `.pot` file with new text strings for localization in `languages/wpd-gear.pot`

= 1.4 =
*   Added `.pot` file for localization in `languages/wpd-gear.pot`
*   Added permalink settings option for `gear` base in `admin/class-wpd-gear-post-type.php`
*   Updated permalink base codes for `gear` custom post type in `admin/class-wpd-gear-post-type.php`

= 1.3 =
*   Add admin screen thumbnails to Gear menu type in `admin/class-wpd-gear-post-type.php`
*   Add `categories` endpoint to the REST API in `admin/class-wpd-gear-rest-api.php`
*   Remove `wpd_gear_category` REST API endpoint in `admin/class-wpd-gear-post-type.php`
*   Update Gear category wording in `admin/class-wpd-gear-taxonomies.php`
*   Update `gear_category` endpoint name in `admin/class-wpd-gear-rest-api.php`

= 1.2.1 =
*   Added custom widths to the Prices metabox input fields in `admin/class-wpd-gear-metaboxes.php`
*   Added filter for the new table placement in **WP Dispensary v2.0+**   in `admin/class-wpd-gear-data-output.php`
*   Updated admin submenu order number in `admin/wpd-gear-post-type.php`

= 1.2.0 =
*   Added `viewall` shortcode option (req: WPD 1.9.18+) in `admin/class-wpd-gear-shortcodes.php`
*   Added vendor taxonomy filter and display in `admin/class-wpd-gear-data-output.php`
*   Added check to hide vendors and categories if empty in `admin/class-wpd-gear-data-output.php`
*   Added `wpd_gear` shortcode name for attribute filter in `admin/class-wpd-gear-shortcodes.php`
*   Fixed display bug for price outputs in `admin/class-wpd-gear-shortcodes.php`
*   Fixed depreciated string value in get_bloginfo function in `admin/class-wpd-gear-shortcodes.php`
*   Fixed nonce error for gearpricesmeta_noncename in `admin/class-wpd-gear-metaboxes.php`
*   Fixed `WP_DEBUG` notice by adding a default value for $rewrite variable in `admin/class-wpd-gear-post-type.php`
*   Fixed `WP_DEBUG` notice by adding `global $post` to Gear vendors and categories in `admin/class-wpd-gear-data-output.php`
*   Updated admin menu order for `Gear` in `admin/class-wpd-gear-post-type.php`
*   Updated categories table code for display in `admin/class-wpd-gear-data-output.php`
*   Updated default widget title from `Recent Gear` to `Dispensary Gear` in `admin/class-wpd-gear-widgets.php`

= 1.1.0 =
*   Added in additional action hook in `admin/class-wpd-gear-shortcodes.php`
*   Added new shortcode options in `admin/class-wpd-gear-shortcodes.php`
*   Fixed term name for gear categories in `admin/class-wpd-gear-data-output.php`
*   Fixed term name for gear categories in `admin/class-wpd-gear-widgets.php`
*   Updated image display to include default images in `admin/class-wpd-gear-shortcodes.php`

= 1.0 =
*   Initial release
