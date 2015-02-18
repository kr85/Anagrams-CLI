<?php
    // Require Anagram.php
    require_once('../Anagram.php');

    /**
     * Class AnagramTest
     */
    class AnagramTest extends PHPUnit_Framework_TestCase {

        private $object;

        /**
         * Setup before tests
         */
        public function setUp() {
            // Initialize
            $this->object = new Anagram('input.txt', 'output.txt');
        }

        /**
         * Clear after tests
         */
        public function tearDown() {
            unset($this->object);
        }

        /**
         * Test format string function
         */
        public function testFormatString() {

            $string = 's1234567890-=i!@#$%^&*()_+l[]\{}|e;\'n,.t<>?';
            $formattedString = 'silent';

            $string = $this->object->formatString($string);
            $this->assertEquals($string, $formattedString);
        }

        /**
         * Test get key function
         */
        public function testGetKey() {

            $word = 'silent';
            $key = 'eilnst';

            $returnedKey = $this->object->getKey($word);
            $this->assertEquals($key, $returnedKey);
        }

        /**
         * Test process file function
         */
        public function testProcessFile() {

            $fileName = 'input.txt';

            $result = $this->object->processFile($fileName);
            $this->assertTrue($result);
        }

        /**
         * Test run function
         */
        public function testRun() {

            $this->object->run();
        }
    }