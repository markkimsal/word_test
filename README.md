About
===
This project is an attempt to satisfy the requirements laid out @ https://gist.github.com/seanthehead/11180933

Installation
===
Use compser to install dependencies.
```
curl -sS https://getcomposer.org/installer | php
php ./composer.phar install
```

Running
===
The command line program bin/parse\_dictionary.php will use data/dictionary.txt by default.
```
php ./bin/parse_dictionary.php
```

Caveats
===
 * Case sensitivity is undefined, all sequences are compared as lower case strings.
 * UTF-8 is not handled, each word is split on 4 bytes, not 4 characters.
 * In the interest of simplicity, all sequences are stored in memory.  This could lead to OOM sutiations for extremely large input files.

TODO: Things that should be tested or finished to make a proper program.
===
 * Can parser be run more than once - test repeated opening and closing of file handle
 * Can recorder be run more than once - test repeated resetting of internal arrays.
 * Test lowercasing of sequences to be certain documented way of comparison does not change.
 * Test words with strange lengths to ensure Sequencer is not missing any characters.
 * Ensure words are less than 4096 characters (fgets buffer size).
 * Test recorder's recordSequence function to make sure it handles duplicate sequences properly.
 * Add CLI flags to control location of dictionary file, output location, verbosity, etc.
