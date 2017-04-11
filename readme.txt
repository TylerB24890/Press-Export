=== Press Export ===
Contributors: TyB
Tags: word, doc, docx, pdf, rtf, html, documents, export, export post, word, office, phpword, phpoffice, press, export
Requires at least: 3.5
Tested up to: 4.7.3
Stable tag: 0.5.0
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt

Generate basic DOCX, PDF, RTF and HTML files of your posts on publish.

== Description ==

This plugin uses the popular PhpWord library to generate basic documents of your posts. Simply install & activate the plugin and begin publishing posts. Your documents will be generated on the fly as you publish the post and stored in the WordPress `/uploads/` directory. You can use the shortcode provided to access those documents.

= Note: = This plugin is still in beta. It works, but with limited options. Feel free to contribute!

== Installation ==

1. Upload the `press-export` directory to your `/wp-content/plugins/` directory.
2. Activate the plugin.

== Usage ==
1. Simply install the plugin and activate using the directions above. Post documents will be generated when you update or publish a post.
2. Use the shortcode to link to documents:
	* `[pex_get_documents]`
		* `post` = The post ID (Default: current post ID)
		* `type` = The type of document to return - values: 'all', 'pdf', 'html', 'rtf', 'docx' (Default: 'all')
		* `style` = The style to return the documents in - Current values: 'list' (more to come in v. 1.0.0)

	* Example: `[pex_get_documents post="4" type="pdf"]` will return a link to the PDF document for post with the ID 4.

== To Do ==
1. Add in wp-admin notices (error messages/upgrade notices)
2. Create options page to allow the user to select which documents get generated on the fly.
3. Create shortcode to return the document URLs for a given post. (Will replace existing `get_document_url($file);` function)
4. Give ability to export a post manually (checkbox)

== Changelog ==

= 0.5.0 =
* Initial Release
