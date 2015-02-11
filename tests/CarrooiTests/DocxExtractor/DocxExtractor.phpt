<?php

/**
 * Test: Carrooi\DocxExtractor\DocxExtractor
 *
 * @testCase CarrooiTests\DocxExtractor\DocxExtractorTest
 * @author David Kudera
 */

namespace CarrooiTests\DocxExtractor;

use Carrooi\DocxExtractor\DocxExtractor;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../bootstrap.php';

/**
 *
 * @author David Kudera
 */
class DocxExtractorTest extends TestCase
{


	/** @var \Carrooi\DocxExtractor\DocxExtractor */
	private $extractor;


	public function setUp()
	{
		$this->extractor = new DocxExtractor;
	}


	public function tearDown()
	{
		$this->extractor = null;
	}


	public function testExtractText_fileNotExists()
	{
		Assert::exception(function() {
			$this->extractor->extractText(__DIR__. '/files/random.name.docx');
		}, 'Carrooi\DocxExtractor\FileNotFoundException', 'Could not find file '. __DIR__. '/files/random.name.docx.');
	}


	public function testExtractText_unknownFileType()
	{
		Assert::exception(function() {
			$this->extractor->extractText(__DIR__. '/files/simple.txt');
		}, 'Carrooi\DocxExtractor\ExtractorException', 'Could not extract text from '. __DIR__. '/files/simple.txt file.');
	}


	public function testExtractText()
	{
		$text = $this->extractor->extractText(__DIR__. '/files/simple.docx');

		Assert::contains('Lorem ipsum dolor sit amet', $text);
	}

}


run(new DocxExtractorTest);