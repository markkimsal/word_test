<?php

namespace Wordtest;
use Evenement\EventEmitterTrait;

/**
 * Record sequences and the words they come from.
 * If a sequences has already been recorded, remove it
 * from the list of uniques.
 *
 * This is rather memory intensive, parsing streams would probably be
 * a better approach, but then this recorder would have to continually
 * scan and modify the output files to look for duplicates and remove
 * previously identified uniques when a duplicate sequence is found.
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
	 * Clear internal arrays, reset results
	 */
	public function reset() {
		$this->listUnique = array();
		$this->listDupes  = array();
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

	/**
	 * Echo listUnique
	 */
	public function echoResults() {
		foreach ($this->listUnique as $s => $w) {
			echo "$s - $w\n";
		}
	}
}
