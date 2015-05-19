<?php

namespace Wordtest;
use Evenement\EventEmitterTrait;

/**
 * Designed to open a file and emit a 'line' event for every line in the file.
 */
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
	 * emit 'end' after file is closed.
	 */
	public function parse() {
		if (!$this->fh) {
			$this->openFile();
		}
		if (!$this->fh) {
			throw new Exception('Unable to open dictionary file. ('.$this->filename.')');
		}

		$this->emit('start');
		while (!feof($this->fh)) {
			$line = rtrim(fgets($this->fh, 4096));
			//skip blank lines
			if (strlen($line)) {
				$this->emit('line', array($line));
			}
		}
		fclose($this->fh);
		$this->emit('end');
	}
}

