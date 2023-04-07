<?php

/**
 * Sanitize the input
 */
function sanitizeInput(string $input): string | bool
{
    // Remove specific unwanted characters
    $unwantedChars = array('"', '<?', "'", '\\', "//", '/', '<', '>', "===", "==");
    $input = str_replace($unwantedChars, '', $input);

    // Remove whitespace from the input
    $input = trim($input);

    return $input;
}
/**
 * Hash the Password for storage in the db
 */
function hashPassword(string $password): string
{
    /** 
     * Hash the password with Argon2
     * Argon2 is memory intensive algorithm but is more secure than the default Bcrypt
     */
    $options = [
        // Set the default memory usage for the algorithm
        'memory_cost' => PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
        // Sets the iterations set to perform Hashes default value is 4
        'time_cost' => PASSWORD_ARGON2_DEFAULT_TIME_COST,
        // set the number of threads to use for hashing default value is 1
        'threads' => PASSWORD_ARGON2_DEFAULT_THREADS,
    ];


    $hash = password_hash($password, PASSWORD_ARGON2ID, $options);

    // Return the hashed password
    return $hash;
}

/**
 * Compare Password to the Input
 */
function comparePasswords(string $password, string $input): bool
{

    // Set minimum and maximum password length
    $min = 8;
    $max = 64;

    // check if set to null
    if ($input == null || $password == null) {
        return false;
    }
    // check if set to empty strings
    if ($input == "" || $password == "") {
        return false;
    }

    if (strlen($input) < $min || strlen($input) > $max) {
        return false;
    }

    // Compare the password hash with the input password
    if (!password_verify($input, $password)) {
        return false;
    }

    return true;
}
