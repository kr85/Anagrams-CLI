<?php
    // Require Anagram.php
    require_once('Anagram.php');

    // Input file name
    $input = $argv[1];
    // Output file name
    $output = $argv[2];

    // Instantiate and run the application
    $obj = new Anagram($input, $output);
    $obj->run();