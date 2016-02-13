<?php
function makePassword($wordCount, $incSpecial, $specialCount, $incNumber, $separator, $capitalization)
{
    $wordList = ['alpha', 'bravo', 'charlie', 'delta', 'echo', 'foxtrot', 'golf', 'hotel', 'india',
                 'juliet', 'kilo', 'lima', 'mike', 'november', 'oscar', 'papa', 'quebec', 'romeo',
                 'sierra', 'tango', 'uniform', 'victor', 'whiskey', 'xray', 'yankee', 'zulu'];

    $charList = ['~', '!', '@', '#', '$', '%', '^', '&', '*'];

    # Create a random position for the numeral and special character.
    $numPosition = rand(0,$wordCount-1);
    $specPosition = rand(0,$wordCount-1);

    for ($i = 0; $i < $wordCount; $i++)
    {
        # Get a random word that has not been used yet.
        while ($nextWord == NULL or stristr($result, $nextWord)) {
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

        # Convert word to camel case, if requested.
        if ($useCamel and $i != 0) {
            $nextWord = substr_replace($nextWord, strtoupper(substr($nextWord, 0, 1)) , 0, 1);
        }

        $result = $result.$nextWord;

        # Add a special symbol (in a random position), if requested.
        if ($incSpecial and $i == $specPosition) {
            for ($j = 0; $j < $specialCount; $j++) {
                $result = $result.getRandomItem($charList);
            }
        }

        # Add a digit (in a random position), if requested.
        if ($incNumber and $i == $numPosition) {
            $result = $result.rand(0,9);
        }

    }

    return $result;
}

function getRandomItem($items) { return $items[rand(0,count($items)-1)]; }
function firstLetterToUpper($str) { return substr_replace($str, strtoupper(substr($str, 0, 1)) , 0, 1);}
?>
