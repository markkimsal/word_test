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


$s = new Wordtest\Sequencer();
$r = new Wordtest\Recorder();
$p = new Wordtest\Parser(dirname(__DIR__).'/data/dictionary.txt');

$p->on('line',     array($s, 'analyzeWord'));
$p->on('end',      array($r, 'writeResults'));
$p->on('start',    array($r, 'reset'));
//@TODO: support CLI flags (-v)
//$p->on('end',      array($r, 'echoResults'));
$s->on('sequence', array($r, 'recordSequence'));

$p->parse();

