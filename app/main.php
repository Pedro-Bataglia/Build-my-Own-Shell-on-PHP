<?php
error_reporting(E_ALL);

$builtins = array("echo", "exit", "type");

$paths = explode(":", getenv('PATH'));

while(true) {
    fwrite(STDOUT, "$ ");

    $input = trim($fgets(STDIN));
    if(strcmp($input, "exit 0") == 0) {
        break;
    }
    if(preg_match_all("/^echo /", $input))  {
        echo substr($input, 5) . PHP_EOL;
        continue;
    }
    if(preg_match_all("/^type /", $input)) {
        if(in_array(substr($input, 5), $builtins)) {
            echo substr($input, 5) . "is a shell builtin" . PHP_EOL;
            continue;
        }
        foreach($paths as $path) {
            if(is_dir($path)) {
                $folder = scandir($path);
                if(!is_array($folder)) {
                    continue;
                }
                if(is_array(substr($input, 5), $folder)) {
                    echo(substr($input, 5) . "is" . $path . "/" . substr($input, 5) . PHP_EOL);
                    continue 2;
                }
            }
        }
        echo(substr($input, 5) . ": not found" . PHP_EOL);
        continue;  
    }
echo($input . ": command not found" . PHP_EOL);
}
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