<?php

namespace Hhcom\ContaoFileReplace\EventListener;

use Contao\File;
use Contao\Input;

class FileReplaceListener
{
	
	/**
	 * replace the uploaded files name with the existing filename
	 */
	public function __invoke($arrFiles) 
    {		
		if (Input::get('filename')) {
			
			foreach ($arrFiles as $key => $strPath)
			{
				$objFile = new File($strPath);

				if ($objFile->exists())
				{
					$oldFilename = pathinfo(Input::get('filename'), PATHINFO_FILENAME);
					$strFolder   = str_replace($objFile->name, '', $strPath);
					$path        = $strFolder . $oldFilename . '.' . $objFile->extension;
					$objFile->renameTo($path);
				
				}
			}
			
        }
    }
}
?>