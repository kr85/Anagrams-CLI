<?php

    /**
     * This application reads through an input file (word dictionary),
     * generates all possible anagrams and prints the results to an output file.
     */
    class Anagram {

        /**
         * @var array Multidimensional array of words
         */
        private $wordList;

        /**
         * @var array Array of all anagrams
         */
        private $anagramList;

        /**
         * @var null Name of the input file
         */
        private $input;

        /**
         * @var null Name of the output file
         */
        private $output;

        /**
         * Constructor
         *
         * @param null $input The input file
         * @param null $output The output file
         */
        public function __construct($input = null, $output = null) {
            // Initialize
            $this->wordList = [];
            $this->anagramList = [];
            $this->input = $input;
            $this->output = $output;
        }

        /**
         * Run the program
         */
        public function run() {
            // Process the word dictionary
            if ($this->processFile($this->input)) {
                // Add the anagrams to the anagrams array
                $this->addToAnagramList($this->wordList);
                // Print the output to a file
                $this->printToFile($this->anagramList, $this->output);
                $this->printMessage('Done. Results are in \''. $this->output . '\'.');
            } else {
                $this->printMessage('Not able to load the dictionary.');
            }

        }

        /**
         * Process a word dictionary
         *
         * @param $fileName The name of the input file
         * @return bool Return true if successful, otherwise false
         */
        public function processFile($fileName) {
            // Check if file name is passed
            if (!empty($fileName)) {
                // Open the input file
                $file = fopen($fileName, 'r');
                // Check if opening the file was successful
                if (!empty($file)) {
                    // A message indicating the file is being processed
                    $this->printMessage('Processing...');
                    // Loop through each word until the end of the file
                    while (!feof($file)) {
                        // Get a word (line) from the file
                        $word = fgets($file);
                        // Processes the word
                        $this->processWord($word);
                    }
                    // Close the input file
                    fclose($file);
                    return true;
                } else {
                    $this->printMessage('Not able to open the input file.');
                }
                return false;
            }
            return false;
        }

        /**
         * Process a word and add it to the words array
         *
         * @param $word
         */
        public function processWord($word) {
            // Check if a word is passed
            if (!empty($word)) {
                // Format the word
                $word = $this->formatString($word);
                // Create a key for the word
                $key = $this->getKey($word);
                // Add the word to the words array corresponding to its key
                $this->addToWordList($key, $word);
            }
        }

        /**
         * Format a string (remove whitespaces from beginning/end,
         * change to lowercase, and remove all non-alphabetical characters)
         *
         * @param $string
         * @return mixed|null|string A formatted string
         */
        public function formatString($string) {
            // Check if a string is passed
            if (!empty($string)) {
                // Remove whitespaces from beginning/end
                $string = trim($string);
                // Change to lowercase
                $string = strtolower($string);
                // Remove all non-alphabetical characters
                $string = preg_replace("/[^\p{L}]/u", '', $string);
                // Return the formatted string
                return $string;
            }
            return null;
        }

        /**
         * Get a key that is created by the sorted letters of a word
         *
         * @param $string
         * @return null|string A key (sorted string/word)
         */
        public function getKey($string) {
            // Check if a string is passed
            if (!empty($string)) {
                // Split the string into an array of characters
                $charArray = str_split($string);
                // Sort the array
                sort($charArray);
                // Join the array of characters into a string
                $key = implode('', $charArray);
                // Return the key
                return $key;
            }
            return null;
        }

        /**
         * Add a word to a multidimensional array with its corresponding key
         *
         * @param $key
         * @param $word
         */
        public function addToWordList($key, $word) {
            // Check if key and word are passed
            if (!empty($key) && !empty($word)) {
                // Check if the word is not in the sub-array to avoid duplicates
                if (!in_array($word, $this->wordList[$key])) {
                    // Add the word to the sub-array
                    $this->wordList[$key][] = $word;
                }
            }
        }

        /**
         * Add all anagrams to the anagrams array
         *
         * @param $array
         */
        public function addToAnagramList($array) {
            // Check if an array is passed
            if (!empty($array)) {
                // For each sub-array in array
                foreach ($array as $a) {
                    // The size of the sub-array
                    $count = sizeof($a);
                    // If the size of the sub-array is greater than 1
                    if ($count > 1) {
                        // Return a string of all sub-array elements
                        $anagrams = implode(' ', $a);
                        // Add the string to the anagrams array
                        $this->anagramList[] = $anagrams;
                    }
                }
            }
        }

        /**
         * A helper function to print an array to a file
         *
         * @param $array
         * @param $file
         */
        private function printToFile($array, $file) {
            foreach ($array as $key => $value) {
                file_put_contents($file, $value . PHP_EOL, FILE_APPEND);
            }
        }

        /**
         * A helper function to print a message
         *
         * @param $message
         */
        private function printMessage($message) {
            // Print messages only if it is not test environment
            if (!$_ENV['testing']) {
                if (!empty($message)) {
                    fwrite(STDOUT, "\n" . $message . "\n");
                }
            }
        }
    }