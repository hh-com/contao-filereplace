<?php
/**
 * Update the upload field in backend only if in relplace mode..
 */
use Contao\Input;
use Contao\Image;
use Contao\Backend;
use Contao\StringUtil;

if (Input::get('do') == 'files' && Input::get('act') == 'move' && Input::get('mode') == '2' && Input::get('filename')) {
	
	$existingFilename = sprintf($GLOBALS['TL_LANG']['tl_files']['replaceheadline'], Input::get('filename'));

	$GLOBALS['TL_MOOTOOLS'][] = "
	<script>
	document.addEventListener('DOMContentLoaded', function(event) {
		document.querySelector('input[type=file]').removeAttribute('multiple');
		document.querySelector('input[type=file]').setAttribute('accept','.".pathinfo(Input::get('filename'), PATHINFO_EXTENSION)."');
		document.querySelector('.tl_formbody_edit').insertAdjacentHTML('afterbegin', '<h2 class=\'tl_submit_container\'>".$existingFilename."</h2>');
	});</script>";	
}

$GLOBALS['TL_DCA']['tl_files']['list']['operations']['replace'] = array(
	'label'               => &$GLOBALS['TL_LANG']['tl_files']['replace'],
	'href'                => 'act=move&amp;mode=2',
	'icon'                => 'sync.svg',
	'button_callback'     => array('tl_files_replace', 'replaceFile')
);

class tl_files_replace extends Backend
{
	
	/**
	 * Return the upload file button
	 *
	 * @param array  $row
	 * @param string $href
	 * @param string $label
	 * @param string $title
	 * @param string $icon
	 * @param string $attributes
	 *
	 * @return string
	 */
	public function replaceFile($row, $href, $label, $title, $icon, $attributes)
	{
		
		if (isset($row['type']) && $row['type'] == 'file' && !isset($GLOBALS['TL_DCA']['tl_files']['config']['closed']) && !isset($GLOBALS['TL_DCA']['tl_files']['config']['notCreatable']) && Input::get('act') != 'select')
		{
			$foldername = str_replace( "/".$row['fileNameEncoded'],'',$row['id']);
			return '<a href="' . $this->addToUrl($href . '&amp;pid=' . $foldername . '&amp;filename=' . $row['fileNameEncoded'] ) . '" title="' . StringUtil::specialchars($title) . '" ' . $attributes . '>' . Image::getHtml($icon, $label) . '</a> ';
		}

		return ' ';
	}
	

}


?>