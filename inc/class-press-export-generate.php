<?php

/**
 * Generates a document files from the published WP Post
 *
 * @author 	Tyler Bailey
 * @version 1.0
 * @package Press-Export
 * @subpackage press-export/inc
 */


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if(!class_exists('Press_Export_Generate')) :

	class Press_Export_Generate extends Press_Export_Base {

		/**
	     * Location of the domPDF library
	     *
	     * @since 1.0.0
	     *
	     * @type string
	     */
		private $domPDFRenderPath;

		/**
	     * PhpWord Class Object
	     *
	     * @since 1.0.0
	     *
	     * @type object
	     */
		private $php_word;

		/**
	     * The document formats we are generating
	     *
	     * @since 1.0.0
	     *
	     * @type array
	     */
		protected $writers;

		/**
		 * Class initialization functions
		 *
		 * @return 	null
		 * @since   1.0.0
		 */
		public function __construct() {

			parent::__construct();

			// Require/register the Autoloader
			require_once PE_GLOBAL_DIR . 'vendor/autoload.php';
			\PhpOffice\PhpWord\Autoloader::register();
			$this->domPDFRenderPath = PE_GLOBAL_DIR . 'vendor/dompdf/dompdf';
			\PhpOffice\PhpWord\Settings::setPdfRendererPath($this->domPDFRenderPath);
			\PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');

			// Istantiate the PhpWord() object
			$this->php_word = new \PhpOffice\PhpWord\PhpWord();

			// Set writers
			$this->writers = array('Word2007' => 'docx', 'HTML' => 'html', 'RTF' => 'rtf', 'PDF' => 'pdf');

			// Hook into the publish action
			add_action( 'publish_post',  array($this, 'generate_doc'), 10, 2 );
		}

		/**
		 * Generates the files after a post is published
		 *
		 * @param	int $ID
		 * @param	object $post
		 * @return 	null || string
		 * @since   1.0.0
		 */
		public function generate_doc($ID, $post) {

			// Make sure the post was returned & published
			if($ID && $ID > 0) {

				// Set default document styles
				$this->set_doc_styles();

				// Add the main document section
				$section = $this->php_word->addSection();

				// Set post title and content in document
				$section->addTitle(htmlspecialchars($post->post_title), 1);

				// Set document properties (i.e. creator, company, description, title, etc...)
				$this->set_doc_properties($post);

				// Set file name
				$filename = $post->post_name;

				if($this->write($filename, $this->writers, $post, $section)) {

					foreach($this->writers as $format => $extension) {
						$result_file = $filename . '.' . $extension;
						if(file_exists($this->export_dir . '/' . $result_file)) {

							// Associate the document with the post in post_meta
							update_post_meta($post->ID, '_' . $extension, $result_file);
						}
					}

				} else {
					echo "Error generating documents.";
				}
			} else {
				echo "Post not found.";
			}
		}


		/**
		 * Write documents
		 *
		 * @param 	string $filename
		 * @param 	array $writers
		 * @param	object $post
		 * @param	object $section
		 * @return 	boolean
		 * @since   1.0.0
		 */
		private function write($filename, $writers, $post, $section) {

			$post_content = apply_filters('the_content', $post->post_content);

			// Apply HTML Formatting
			\PhpOffice\PhpWord\Shared\Html::addHtml($section, $post_content);

		    // Loop through formats ($writers)
		    foreach ($writers as $format => $extension) {
		        if (null !== $extension) {

					// Actually write the documents
		            $target_file = $this->export_dir . $filename . '.' . $extension;
		            $this->php_word->save($target_file, $format);
		        } else {
		        	return false;
		        }
		    }
		    return true;
		}

		/**
		 * Set document properties embedded within file
		 *
		 * @param 	object $post
		 * @return 	null
		 * @since	1.0.0
		 */
		private function set_doc_properties($post) {
			$properties = $this->php_word->getDocInfo();
			$properties->setCreator(get_the_author());
			$properties->setCompany(get_bloginfo('name')); // change to make it a dynamic setting
			$properties->setTitle(htmlspecialchars($post->post_title));
			$properties->setDescription(htmlspecialchars($post->post_excerpt));
		}

		/**
		 * Set document paragraph and font styles
		 *
		 * @return 	null
		 * @since	1.0.0
		 */
		private function set_doc_styles() {

			// Default Title Styles
			$this->php_word->addParagraphStyle('TitleStyle', array('spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(24)));
			$title_style = array('color' => '000', 'size' => 18, 'bold' => true);
			$this->php_word->addTitleStyle(1, $title_style, 'TitleStyle');

			// Default Paragraph Styles
			$this->php_word->setDefaultParagraphStyle(
				array(
					'spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(12)
				)
			);
		}
	}

endif;
