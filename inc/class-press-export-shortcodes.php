<?php

/**
 * Registers Press Export shortcodes with WP for displaying exported docs
 *
 * @author 	Tyler Bailey
 * @version 1.0
 * @package Press-Export
 * @subpackage press-export/inc
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if(!class_exists('Press_Export_Shortcodes')) :

	class Press_Export_Shortcodes extends Press_Export_Generate {

		/**
		 * Class initialization functions
		 *
		 * @return 	null
		 * @since   1.0.0
		 */
		public function __construct() {
			parent::__construct();

			// Display post documents in a grid format
			add_shortcode('pex_get_documents', array($this,'display_document_sc'));
		}

		public function display_document_sc($atts) {
			global $post;
			$docs = array();

			// Shortcode attributes
			$a = shortcode_atts(array(
				'post' => $post->ID,
				'type' => 'all',
				'style' => 'list',
			), $atts, 'hbp_display_documents');

			// Get the documents
			switch($a['type']) {
				case 'all' :
					foreach($this->writers as $key => $ext) {
						$docs[$ext] = get_post_meta($a['post'], '_' . $ext, true);
					}
				break;
				case 'pdf' :
					$docs = get_post_meta($a['post'], '_pdf', true);
				break;
				case 'docx' :
					$docs = get_post_meta($a['post'], '_docx', true);
				break;
				case 'rtf' :
					$docs = get_post_meta($a['post'], '_rtf', true);
				break;
				case 'html' :
					$docs = get_post_meta($a['post'], '_html', true);
				break;
			}

			ob_start();

			// Check to make sure the document array isn't empty
			if(is_array($docs)) {
				$doc_check = array_filter($docs);

				if(empty($doc_check))
					return false;
			} elseif(strlen($docs) < 1) {
				return false;
			}

			switch($a['style']) :
				case 'list' :
	?>
					<ul class="pex-documents">
						<?php if(is_array($docs)) : ?>
							<?php foreach($docs as $ext => $doc) : ?>
								<li>
									<a href="<?php echo $this->get_document_url($doc); ?>" class="pex-file" id="<?php echo $ext . '-pex-download'; ?>" data-type="<?php echo $ext; ?>">
										<?php echo get_the_title($a['post']) . '.' . $ext; ?>
									</a>
								</li>
							<?php endforeach; ?>
						<?php else: ?>
							<?php $ext = $a['type']; ?>
							<li>
								<a href="<?php echo $this->get_document_url($docs); ?>" class="pex-file" id="<?php echo $ext . '-pex-download'; ?>" data-type="<?php echo $ext; ?>">
									<?php echo get_the_title($a['post']) . '.' . $ext; ?>
								</a>
							</li>
						<?php endif; ?>
					</ul>
	<?php
				break;

			endswitch;

			return ob_get_clean();
		}
	}

	new Press_Export_Shortcodes();

endif;
