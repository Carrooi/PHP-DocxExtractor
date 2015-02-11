<?php

namespace Carrooi\DocxExtractor;
use ZipArchive;
use DOMDocument;

/**
 *
 * @author David Kudera
 */
class DocxExtractor
{


	/**
	 * @param string $file
	 * @return string
	 */
	public function extractText($file)
	{
		if (!is_file($file) || !is_readable($file)) {
			throw new FileNotFoundException('Could not find file '. $file. '.');
		}

		if (strtolower(pathinfo($file, PATHINFO_EXTENSION)) !== 'docx') {
			throw new ExtractorException('Could not extract text from '. $file. ' file.');
		}

		$zip = new ZipArchive;

		if (!$zip->open($file)) {
			throw new ExtractorException('Could not open file '. $file. '.');
		}

		if (!($document = $zip->locateName('word/document.xml'))) {
			$zip->close();
			throw new ExtractorException('Invalid docx file '. $file. '.');
		}

		$data = $zip->getFromIndex($document);
		$xml = new DOMDocument;
		$xml->loadXML($data, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);

		$zip->close();

		$text = $xml->saveXML();
		$text = strtr($text, [
			'</w:r></w:p></w:tc><w:tc>' => " ",
			'</w:r></w:p>' => "\r\n",
			'</w:p>' => "\r\n",
		]);

		return strip_tags($text);
	}

}
