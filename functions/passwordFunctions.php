<?php
//Function to validate passwords. the password given must have a number, a capital letter and a symbol.
function password_validation($password): bool
{
    //Check for at least one number
    $hasNumber = preg_match('/\d/', $password);

    //Check for at least one capital letter
    $hasCapital = preg_match('/[A-Z]/', $password);

    //Check for at least one symbol
    $hasSymbol = preg_match('/[^a-zA-Z0-9]/', $password);

    return ($hasNumber && $hasCapital && $hasSymbol);
}

//Function using php built-in password hash function.
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}
