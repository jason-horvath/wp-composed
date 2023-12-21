<?php
class Dotenv
{
    public static function load()
    {
        $dotenvPath = __DIR__ . '/.env';

        if (!file_exists($dotenvPath)) {
            die('.env file not found. Please create one.');
        }

        $dotenv = parse_ini_file($dotenvPath, false, INI_SCANNER_RAW);

        foreach ($dotenv as $key => $value) {
            if ($value === 'true') {
                $_ENV[$key] = true;
                continue;
            }

            if ($value === 'false') {
                $_ENV[$key] = false;
                continue;
            }

            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}
