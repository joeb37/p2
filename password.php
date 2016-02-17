<?php

$wordList = ['alpha', 'bravo', 'charlie', 'delta', 'echo', 'foxtrot', 'golf', 'hotel', 'india',
             'juliet', 'kilo', 'lima', 'mike', 'november', 'oscar', 'papa', 'quebec', 'romeo',
             'sierra', 'tango', 'uniform', 'victor', 'whiskey', 'xray', 'yankee', 'zulu'];

$charList = ['~', '!', '@', '#', '$', '%', '^', '&', '*'];

##################################################
# Validate the input and initialze program values.
##################################################
$errorObject = [];

# Word Count
$wordCount = 3;
if (array_key_exists('words', $_GET)) {
    $parmValue = $_GET['words'];
    if (is_numeric($parmValue) and ($parmValue >= 1 and $parmValue <= 9)) {
        $wordCount = $parmValue;
    } else {
        array_push($errorObject, "Number of Words must be a numeric value from 1 to 9.");
    }
}

# Include a special character
$incSpecial = "off";
if (array_key_exists('special', $_GET)) {
    $parmValue = $_GET['special'];
    if ($parmValue == "on") {
        $incSpecial = "on";
    } else {
        array_push($errorObject, "Invalid value for parameter 'special'.");
    }
}

# Include a digit
$incNumber = "off";
if (array_key_exists('digit', $_GET)) {
    $parmValue = $_GET['digit'];
    if ($parmValue == "on") {
        $incNumber = "on";
    } else {
        array_push($errorObject, "Invalid value for parameter 'digit'.");
    }
}

# Separator style
$separator = "none";
if (array_key_exists('separator', $_GET)) {
    $parmValue = $_GET['separator'];
    if ($parmValue == "none" or $parmValue == "camel" or $parmValue == "hyphens" or $parmValue == "spaces") {
        $separator = $parmValue;
    } else {
        array_push($errorObject, "Separator style must be camel, hyphens, spaces or none.");
    }
}

# Capitalization style
$capitalization = "lower";
if (array_key_exists('capitalization', $_GET)) {
    $parmValue = $_GET['capitalization'];
    if ($parmValue == "lower" or $parmValue == "upper" or $parmValue == "title") {
        $capitalization = $parmValue;
    } else {
        array_push($errorObject, "Capitalization style must be lower, upper or title.");
    }
}

##################################################
# Create a password to the user's specification.
##################################################

# Generate a random position for the numeral and special character.
$numPosition = rand(0,$wordCount-1);
$specPosition = rand(0,$wordCount-1);

$result = "";
$nextWord = "";

for ($i = 0; $i < $wordCount; $i++)
{
    # Get a random word that has not been used yet.
    # stripos returns false if $nextWord is not in $result.
    while ($nextWord == "" or stripos($result, $nextWord) !== false) {
        $nextWord = getRandomItem($wordList);
    }

    switch($capitalization) {
        case "lower":
            $nextWord = strtolower($nextWord);
            break;
        case "upper":
            $nextWord = strtoupper($nextWord);
            break;
        case "title":
            $nextWord = firstLetterToUpper($nextWord);
            break;
    }

    switch($separator) {
        case "camel":
            if ($i != 0) {
                $nextWord = firstLetterToUpper($nextWord);
            }
            break;
        case "hyphens":
            if ($i < $wordCount - 1) {
                $nextWord = $nextWord."-";
            }
            break;
        case "spaces":
            if ($i < $wordCount - 1) {
                $nextWord = $nextWord." ";
            }
            break;
    }

    $result = $result.$nextWord;

    # Add a special symbol (in a random position), if requested.
    if ($incSpecial == "on" and $i == $specPosition) {
        $result = $result.getRandomItem($charList);
    }

    # Add a digit (in a random position), if requested.
    if ($incNumber == "on" and $i == $numPosition) {
        $result = $result.rand(0,9);
    }
}

function getRandomItem($items) {
    return $items[rand(0,count($items)-1)];
}

function firstLetterToUpper($str) {
    return substr_replace($str, strtoupper(substr($str, 0, 1)) , 0, 1);
}

?>
