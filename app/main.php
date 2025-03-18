<?php
error_reporting(E_ALL);

while(true) {
    fwrite(STDOUT, "$ ");

    $input = fgets(STDIN);

    if ($input == false) {
        exit(1);
    }

    $input = trim($input);

    switch($input) {
        case "exit 0":
            exit(0);
        
        default:
        fwrite(STDOUT, "$input: command not found\n");
        break;
    }
};