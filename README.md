# ANAGRAMS-CLI

This application reads through an input file (word dictionary), generates all possible anagrams and prints the results to an output file.

INSTRUCTIONS
------------

To run the application:

1. cd /path/to/Anagrams folder
2. Type in the terminal:


    php index.php /path/to/input.txt /path/to/output.txt

Example:

    ~/Code/Anagrams$ php index.php /usr/share/dict/words /home/user/Desktop/output.txt

To run the tests:

1. cd /path/to/Anagrams/tests folder
2. Type in the terminal:


    phpunit AnagramTest --configuration=phpunit.xml

Example:

    ~/Code/Anagrams/tests$ phpunit AnagramTest --configuration=phpunit.xml

Note: To run the tests you need to have PHPUnit install on your machine.