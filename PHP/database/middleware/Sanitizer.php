<?php

function sanitizePassword($password)
{
    // Set minimum and maximum password length
    $minLength = 8;
    $maxLength = 64;

    // Remove specific unwanted characters
    $unwantedChars = array('"', "'", '\\', '<', '>');
    $password = str_replace($unwantedChars, '', $password);

    // Check if the password meets the length requirements
    $passwordLength = strlen($password);
    if ($passwordLength < $minLength || $passwordLength > $maxLength) {
        throw new Exception("Password must be between $minLength and $maxLength characters long.");
    }

    return $password;
}

function hashPassword($password)
{
    $salt = "SomeSaltHere";

    $password += $salt;

    $password = password_hash($password, PASSWORD_DEFAULT);

    return $password;
}
