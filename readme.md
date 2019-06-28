# UCF Post List Shortcode #

Provides a shortcode for displaying lists of posts.


## Description ##

This plugin provides a shortcode for displaying lists of posts.  It is written to work out-of-the-box for non-programmers, but is also extensible and customizable for developers.

Support for Advanced Custom Fields relationship fields is also available; e.g. you can query against a list of posts by one or more related posts: `[ucf-post-list meta_key="your_relationship_field" meta_value="related-post-slug-1,related-post-slug-2"]`


## Installation ##

### Manual Installation ###
1. Upload the plugin files (unzipped) to the `/wp-content/plugins` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the "Plugins" screen in WordPress
3. Configure plugin settings from the WordPress admin under "Settings > UCF Post List".

### WP CLI Installation ###
1. `$ wp plugin install --activate https://github.com/UCF/UCF-Post-List-Shortcode/archive/master.zip`.  See [WP-CLI Docs](http://wp-cli.org/commands/plugin/install/) for more command options.
2. Configure plugin settings from the WordPress admin under "Settings > UCF Post List".


## Usage ##

`[ucf-post-list]`
Generates a basic unordered list of posts, using default `get_posts()` arguments.

Generally speaking, the `[ucf-post-list]` shortcode accepts most arguments for `get_posts()` and `WP Query`.  Exceptions are noted below.


### Unique Arguments ###

`layout`
The name of the layout to use to display the list of posts.  Defaults to "default", an unstyled, unordered list of posts.

`list_title`
Heading text to display above the list of posts.  No heading is displayed by default.

`show_image`
True/false; whether or not an image for the post should be displayed.  Only applicable on layouts that support images.

`posts_per_row`
The number of posts to display per row within the chosen layout.  Only applicable on layouts that support column-based post lists.

`display_search`
True/false; whether or not a search field that searches the list of posts should be displayed.  Defaults to "false".

`search_placeholder`
The placeholder text to display in the search field (when `display_search` is enabled).

`list_id`
A unique identifier to assign to the post list.  Useful for creating specialized post lists with custom styling or functionality.  Defaults to a randomized numeric string.


`tax_relation`
A relationship between each tax_query generated by the shortcode's arguments.  See the [WP_Query taxonomy parameters documentation](https://codex.wordpress.org/Class_Reference/WP_Query#Taxonomy_Parameters) for usage.

`tax_TAXSLUG`
One or more terms to filter by within the given taxonomy.  Any registered taxonomy can be used.  Serves as a substitute for the "terms" tax_query argument for the taxonomy TAXSLUG.

`tax_TAXSLUG__field`
Specify the field type used in tax_TAXSLUG.  Serves as a substitute for the "field" tax_query argument for the taxonomy TAXSLUG.

`tax_TAXSLUG__include_children`
True/False.  Whether or not to include children for hierarchical taxonomies.  Serves as a substitute for the "include_children" tax_query argument for the taxonomy TAXSLUG.

`tax_TAXSLUG__operator`
Operator to test.  Serves as a substitute for the "operator" tax_query argument for the taxonomy TAXSLUG.


`meta_serialized_relation`
Custom argument for ACF relationship fields which defines the relation between reverse lookup posts.  Serves as a substitute for the ["relation" meta_query argument](https://codex.wordpress.org/Class_Reference/WP_Query#Custom_Field_Parameters).


### Unsupported Arguments ###

Caching parameters, "fields", and "suppress_filters" arguments are not supported in this shortcode.

In addition, "date_query" and "meta_query" are not yet supported.


## Changelog ##

### 2.0.6 ###
Bug fix
* Updated version and added Github Plugin URI

### 2.0.5 ###
Bug fix
Updated random_int to rand for backwards compatibility

### 2.0.4 ###
Enhancements
* Adds the option to apply filters to the shortcode attributes that are available per layout.

### 2.0.3 ###
Enhancements
* Added new `$size` attr to `UCF_Post_List_Common::get_image_or_fallback`, which allows you to specify the image size to retrieve.  This defaults to `large` to accommodate for sites that depend on the function previously (incorrectly) returning full-sized images, while still avoiding returning _huge_ images at least.
* Added `UCF_Post_List_Common::get_image_srcset`, which returns a srcset attribute to use for post list layouts that support thumbnails.  The srcset generated will still depend on the uploaded image size not being enormous, but should still help reduce requested filesizes overall, particularly for mobile devices.
* Updated the `card` layout to use a srcset attribute.

Other
* Fixed typo for `tax_TAXSLUG__field` param in readme

### 2.0.2 ###
Bug fixes
* Updated formatting callback for `post_parent` param from a boolean to integer.

### 2.0.1 ###
Enhancements
* Added 'count' layout, which displays the total number of requested posts

Bug fixes
* Fixed a formatting issue that prevented multiple taxonomy term values from being passed to the `tax_TAXSLUG` attribute

### 2.0.0 ###
Enhancements
* Updated layout hooks to use filters instead of actions for greater flexibility.  Layout hooks now have default values.  Note that these changes are incompatible with layout hooks available in v1.0.0 of the plugin.

### 1.0.0 ###
* Initial release


## Upgrade Notice ##

n/a


## Installation Requirements ##

jQuery must be included in the document head when using post list searches with Typeahead.js and Handlebars.


## Development & Contributing ##

NOTE: this plugin's readme.md file is automatically generated.  Please only make modifications to the readme.txt file, and make sure the `gulp readme` command has been run before committing readme changes.
