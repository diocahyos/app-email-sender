<?php
function ConnectEnv()
{
    $env_file_path = realpath(__DIR__ . "/.env");

    //Check .envenvironment file exists
    if (!is_file($env_file_path)) {
        throw new ErrorException("Environment File is Missing.");
    }

    $var_arrs = array();
    // Open the .en file using the reading mode
    $fopen = fopen($env_file_path, 'r');
    if ($fopen) {
        //Loop the lines of the file
        while (($line = fgets($fopen)) !== false) {
            // Check if line is a comment
            $line_is_comment = (substr(trim($line), 0, 1) == '#') ? true : false;
            // If line is a comment or empty, then skip
            if ($line_is_comment || empty(trim($line)))
                continue;

            // Split the line variable and succeeding comment on line if exists
            // $line_no_comment = explode("#", $line, 2)[0];
            // because some password have # so with this
            $line_no_comment = $line;
            // Split the variable name and value
            $env_ex = preg_split('/(\s?)\=(\s?)/', $line_no_comment);
            $env_name = trim($env_ex[0]);
            $env_value = isset($env_ex[1]) ? trim($env_ex[1]) : "";
            $var_arrs[$env_name] = $env_value;
        }
        // Close the file
        fclose($fopen);
    }

    foreach ($var_arrs as $name => $value) {
        $_ENV[$name] = $value;
    }
}
