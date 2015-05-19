<?php

namespace Wordtest;
use Evenement\EventEmitterTrait;

/**
 * Emit a 'sequence' event for every 4 letters
 * in a given word when calling analyzeWord()
 */
class Sequencer {

	use EventEmitterTrait;

	/**
	 * Shoot off word in 4 letter groups
	 * If word length is less than 4 letters, skip
	 */
	public function analyzeWord($w) {
		$len = strlen($w);
		if ($len < 4) {
			return;
		}
		//chop up word into 4 letter sequences
		//start at the end and go backwards to reduce
		//number of counter variables.

		while ($len >=4) {
			$seq = strtolower(substr( $w, ($len-4), 4));
			$this->emit('sequence',  array($seq, $w));
			$len--;
		}
	}
}
