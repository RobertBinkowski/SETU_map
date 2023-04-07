<?php

function sanitizePassword(string $password): string | bool
{

    // Check length
    if (!checkSize($password)) {
        return false;
    }

    // Remove specific unwanted characters
    $unwantedChars = array('"', "'", '\\', '<', '>');
    $password = str_replace($unwantedChars, '', $password);

    // Remove whitespace from the password
    $password = trim($password);

    // Convert the password to lowercase for case-insensitive comparison
    $password = strtolower($password);

    return $password;
}

function hashPassword(string $password): string
{
    // Hash the password with Bcrypt
    $password = password_hash($password, PASSWORD_BCRYPT);

    // Return the hashed password
    return $password;
}

function comparePasswords(string $password, string $input): bool
{
    // check if set to null
    if ($input == null || $password == null) {
        return false;
    }
    // check if set to empty strings
    if ($input = "" || $password == "") {
        return false;
    }

    // Check size
    if (!checkSize($password)) {
        return false;
    }

    // Confirm hashes match 
    if (password_verify($input, $password)) {
        return true;
    }

    // Default Value is false
    return false;
}

/**
 * Check The length of the password to match the length
 */
function checkSize(string $input): bool
{

    // Set minimum and maximum password length
    $min = 8;
    $max = 64;

    // Check if the password meets the length requirements
    if (strlen($input) < $min || strlen($input) > $max) {
        return false;
    }

    return true;
}
