<?php
error_reporting(E_ALL);


$running = true;
while ($running) {
    $paths = explode(":", getenv('PATH'));
    fwrite(STDOUT, "$ ");
    $input = rtrim(fgets(STDIN)) ?: '';
//    [$command, $value] = explode(' ', $input) + [1 => null];
    [$command, $value] = preg_split('/\s+/', $input, 2) + [1 => null];
    match ($command) {
        'type' => cType((string)$value),
        'exit' => cExit((int)$value),
        'echo' => cEcho((string)$value),
        'path' => cPath((string) $value, $paths),
        default => cCommandNotFound($command),
    };
}
function cExit(int $code = 0): never
{
    exit($code);
}
function cEcho(string $value = ''): void
{
    fwrite(STDOUT, $value . PHP_EOL);
}
function cCommandNotFound(string $command): void
{
    fwrite(STDOUT, "$command: command not found" . PHP_EOL);
}

function cPath(string $value, array $paths): void  
{
    foreach($paths as $path) {
        if(is_dir($path)) {
            $folder = scandir($path);
            if(!is_array($folder)) {
                continue;
            }
            if(in_array(substr($value, 5), $folder)) {
                echo(substr($value, 5) . "is" . $path . "/" . substr($value, 5). PHP_EOL);
                continue;
            }
        }
    }
}

function cType(string $value): void
{   
    switch($value) {
        case "exit":
            fwrite(STDOUT, "$value is a shell builtin" . PHP_EOL);
            break;
        case "echo":
            fwrite(STDOUT, "$value is a shell builtin". PHP_EOL);
            break;
        case "type":
            fwrite(STDOUT, "$value is a shell builtin" . PHP_EOL);
            break;
        default:
            fwrite(STDOUT, "$value: not found" . PHP_EOL);
            break;
    }
}

