
<?php
error_reporting(E_ALL | E_STRICT);

// first we include phpmorphy library
require_once(dirname(__FILE__) . '/phpmorphy/src/common.php');

// set some options
$opts = array(
    // storage type, follow types supported
    // PHPMORPHY_STORAGE_FILE - use file operations(fread, fseek) for dictionary access, this is very slow...
    // PHPMORPHY_STORAGE_SHM - load dictionary in shared memory(using shmop php extension), this is preferred mode
    // PHPMORPHY_STORAGE_MEM - load dict to memory each time when phpMorphy intialized, this useful when shmop ext. not activated. Speed same as for PHPMORPHY_STORAGE_SHM type
    'storage' => PHPMORPHY_STORAGE_FILE,
    // Enable prediction by suffix
    'predict_by_suffix' => true,
    // Enable prediction by prefix
    'predict_by_db' => true,
    // TODO: comment this
    'graminfo_as_text' => true,
);

// Path to directory where dictionaries located
$dir = dirname(__FILE__) . '/phpmorphy/dicts';
$lang = 'ru_RU';

// Create phpMorphy instance
try {
    $morphy = new phpMorphy($dir, $lang, $opts);
} catch(phpMorphy_Exception $e) {
    die('Error occured while creating phpMorphy instance: ' . PHP_EOL . $e);
}

// All words in dictionary in UPPER CASE, so don`t forget set proper locale via setlocale(...) call
// $morphy->getEncoding() returns dictionary encoding

$word = urldecode($_REQUEST['word']);
echo $word;

try {

    // this used for deep analysis
    $collection = $morphy->findWord($word);

    if(false === $collection) {
        exit(0);
    }

    // $collection collection of paradigm for given word
    echo "{";

    foreach($collection as $paradigm) {
        foreach($paradigm->getFoundWordForm() as $found_word_form) {
            echo $paradigm[0]->getWord(), "=", $found_word_form->getPartOfSpeech(), "=",
            "(", implode(',', $found_word_form->getGrammems()), ")|";
        }
    }

    echo "}";

} catch(phpMorphy_Exception $e) {
    die('Error occured while text processing: ' . $e->getMessage());
}
