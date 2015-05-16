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
$params = explode(',',$_REQUEST['params']);

echo $word;

$pos = urldecode($params[0]);
$grammems = array_slice($params, 1);

$i = 0;
foreach($grammems as $g) {
    $grammems[$i] = urldecode($grammems[$i]);
    $i++;
}

try {

    $casted = $morphy->castFormByGramInfo($word, $pos, $grammems, true);

    if(false !== $casted) {
        echo "{", implode(',', $casted), "}";
    }

} catch(phpMorphy_Exception $e) {
    die('Error occured while text processing: ' . $e->getMessage());
}
