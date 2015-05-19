<?php

if (!@include(dirname(__DIR__).'/vendor/autoload.php')) {
	echo "Cannot load vendor/autoload.php, please install dependencies with composer install.\n";
	exit();
}

if (!include(dirname(__DIR__).'/src/Wordtest/Parser.php')) {
	echo "Cannot load Wordtest\Parser.  Unknown error.\n";
	exit();
}

if (!include(dirname(__DIR__).'/src/Wordtest/Sequencer.php')) {
	echo "Cannot load Wordtest\Sequencer.  Unknown error.\n";
	exit();
}

if (!include(dirname(__DIR__).'/src/Wordtest/Recorder.php')) {
	echo "Cannot load Wordtest\Recorder.  Unknown error.\n";
	exit();
}

$startts = microtime(1);

//setup
$s = new Wordtest\Sequencer();
$r = new Wordtest\Recorder();
$p = new Wordtest\Parser(dirname(__DIR__).'/data/dictionary.txt');

$p->on('line',     array($s, 'analyzeWord'));
$p->on('end',      array($r, 'writeResults'));
$p->on('start',    array($r, 'reset'));
//@TODO: support CLI flags (-v)
//$p->on('end',      array($r, 'echoResults'));
$s->on('sequence', array($r, 'recordSequence'));

//bookkeeping
$countLine = 0;
$countUniq = 0;
$p->on('line', function($s) use(&$countLine) {
	$countLine++;
});
$p->on('end', function() use(&$r, &$countUniq) {
	$countUniq = $r->getUniqueSeqCount();
});


//run
$p->parse();


$endts = microtime(1);

echo 'Done!'.PHP_EOL;
printf('parsed %d words, found %d unique sequences.'.PHP_EOL, $countLine, $countUniq);
printf('took %0.2f ms'.PHP_EOL, (($endts - $startts) *1000));
