<?php

session_start();

$inputString = $_POST['inputString'];

/**
 * Determines if input string is a palindrome. Case insensitive. Non alphabetic characters are ignored.
 *
 * @param string $inputString
 * @return string
 */
function isPalindrome(string $inputString) : string
{
    $lowerCaseString =  strtolower($inputString);
    $onlyAlphabeticString = preg_replace("/[^a-z]/", '', $lowerCaseString);
    $reversedString = strrev($onlyAlphabeticString);

    $isPalindrome = $reversedString === $onlyAlphabeticString ? "yes" : "no";

    return $isPalindrome;
}

/**
 * Counts the number of vowels in the input string. Case insensitive.
 *
 * @param string $inputString
 * @return int
 */
function vowelCount(string $inputString) : int
{
    $lowerCaseString =  strtolower($inputString);
    $vowelCount = preg_match_all('/[aeiou]/i', $lowerCaseString);

    return $vowelCount;
}

/**
 * Shifts each letter in the input string 1 position in the alphabet.
 *
 * @param string $inputString
 * @return string
 */
function shiftLetters(string $inputString) : string
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyz';
    $characters = str_split($inputString);
    $shiftedString = '';

    foreach($characters as $character) {

        if(ctype_space($character)) {
            $shiftedString .= ' ';
            continue;
        } elseif(!ctype_alpha($character)) {
            $shiftedString .= $character;
            continue;
        }

        $isUpperCase = ctype_upper($character);
        $lowerCaseLetter = strtolower($character);
        $position = strpos($alphabet, $lowerCaseLetter) + 1;

        if ($position >= strlen($alphabet)) {
            $position = $position - strlen($alphabet);
        }

        $letter = $alphabet[$position];
        $isUpperCase ? $shiftedString .= strtoupper($letter) : $shiftedString .= $letter;
    }

    return $shiftedString;

}

$_SESSION['results'] = [
    'isPalindrome' => isPalindrome($inputString),
    'vowelCount' => vowelCount($inputString),
    'shiftedLetters' => shiftLetters($inputString)
];

header('Location: index.php');
