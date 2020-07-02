<?php

class FileReplace extends \Controller
{
	
	/**
	 * replace the uploaded files name with the existing filename
	 */
	public function replaceUploadedFile($arrFiles) 
    {
		if (\Input::get('filename')) {
			
			foreach ($arrFiles as $key => $strPath)
			{
				$objFile = new File($strPath);

				if ($objFile->exists())
				{
					$oldFilename = pathinfo(\Input::get('filename'), PATHINFO_FILENAME);
					$strFolder   = str_replace($objFile->name, '', $strPath);
					$path        = $strFolder . $oldFilename . '.' . $objFile->extension;
					$objFile->renameTo($path);
					if (version_compare(VERSION, '4.0', "<"))
					{
						$objFile->close();
					}
				}
			}
			
        }
    }
}
?>