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


