<?php

namespace Wordtest;
use Evenement\EventEmitterTrait;

/**
 * Emit a 'sequence' event for every 4 letters
 * in a given word when calling analyzeWord()
 */
class Recorder {

	public $listUnique = array();
	public $listDupes  = array();

	public function recordSequence($s, $w) {
		@$this->listDupes[$s]++;
		if ($this->listDupes[$s] > 1) {
			unset($this->listUnique[$s]);
			return;
		}
		$this->listUnique[$s] = $w;
	}
	
	/**
	 * Write listUnique to 2 files in output/ dir.
	 */
	public function writeResults() {
		$fhs = fopen('output/sequences.txt', 'w');
		$fhw = fopen('output/words.txt', 'w');
		foreach ($this->listUnique as $s => $w) {
			fputs($fhs, $s.PHP_EOL);
			fputs($fhw, $w.PHP_EOL);
			//@DEBUG
			//echo "$s - $w \n";
		}
		fclose($fhs);
		fclose($fhw);
	}
}
