<?php

//Sanitize filters
// https://www.php.net/manual/en/filter.filters.sanitize.php
function sanitize(string $input, string $type): string
{

    if ($type == "email" && filter_var($input, FILTER_SANITIZE_EMAIL)) {
        $output = filter_var($input, FILTER_SANITIZE_EMAIL);
    }
    return $output;
}

//Filter flags from PHP
//https://www.php.net/manual/en/filter.filters.flags.php
function validate(string $input, string $type): bool
{
    if ($type == "email" && filter_var($input, FILTER_SANITIZE_EMAIL)) {
        return true;
    }

    return false;
}
