=== Press Export ===
Contributors: tyb
Tags: word, doc, docx, pdf, rtf, html, documents, export, export post, word, office, phpword, phpoffice, press, export
Requires at least: 3.5
Tested up to: 4.4.5
Stable tag: 1.0.0
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt

Generate basic DOCX, PDF, RTF and HTML files of your posts on the fly.

== Description ==
This plugin uses the popular PhpWord library to generate basic documents of your posts. Simply install & activate the plugin and begin publishing posts. Your documents will be generated on the fly as you publish the post and stored in the WordPress `/uploads/` directory.

To Do:
-------------
* Add in wp-admin notices
* Translation/multilingual compatibility
* Add \'Uninstall\' function to remove all generated documents and created directory
* Create options page to allow the user to select which documents get generated on the fly.
* Create shortcode to return the document URLs for a given post. (Will replace existing `get_document_url($file);` function)
* Create Upgrade Notices



== Installation ==
1. Add the \'press-export\' plugin to your `/plugins/` directory.
2. Activate the plugin.