# Carrooi/DocxExtractor

[![Build Status](https://img.shields.io/travis/Carrooi/PHP-DocxExtractor.svg?style=flat-square)](https://travis-ci.org/Carrooi/PHP-DocxExtractor)
[![Donate](https://img.shields.io/badge/donate-PayPal-brightgreen.svg?style=flat-square)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=XWS864EW7FTNA)

DOCX text extractor.

## Installation

```
$ composer require carrooi/docx-extractor
$ composer update
```

## Usage

```php
use Carrooi\DocxExtractor\DocxExtractor;

$extractor = new DocxExtractor;

$text = $extractor->extractText('/path/to/file.docx');
```

## Changelog

* 1.0.0
	+ Initial version
