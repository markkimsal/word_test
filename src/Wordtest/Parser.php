<?php

namespace Wordtest;
use Evenement\EventEmitterTrait;

class Parser {

	use EventEmitterTrait;

	public $fh       = NULL;
	public $filename = '';

	public function __construct($filename) {
		$this->filename = $filename;
	}

	/**
	 * set fh with fopen
	 */
	public function openFile() {
		$this->fh = fopen($this->filename, 'r');
	}

	/**
	 * try openFile, then emit 'line' for each line in $this->filename
	 */
	public function parse() {
		if (!$this->fh) {
			$this->openFile();
		}
		if (!$this->fh) {
			throw new Exception('Unable to open dictionary file. ('.$this->filename.')');
		}

		while (!feof($this->fh)) {
			$line = rtrim(fgets($this->fh, 4096));
			$this->emit('line', array($line));
		}
		fclose($this->fh);
		$this->emit('end');
	}
}

