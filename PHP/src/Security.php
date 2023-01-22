<?php

function sanitize(string $input): string
{

    $output = filter_var($input);

    return $output;
}
