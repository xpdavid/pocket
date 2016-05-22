<?php
/**
 * Case-insensitive in_array() wrapper.
 *
 * @param  mixed $needle   Value to seek.
 * @param  array $haystack Array to seek in.
 *
 * @return bool
 */
function in_arrayi($needle, $haystack)
{
    return in_array(strtolower($needle), array_map('strtolower', $haystack));
}

/**
 * Find max string in array
 *
 * @param $array
 * @return mixed
 */

function maxInStringArray($array) {
    $max = $array[0];
    foreach ($array as $element) {
        if ($element > $max) {
            $max = $element;
        }
    }
    return $max;
}

/**
 * Find min string in array
 *
 * @param $array
 * @return mixed
 */
function minInStringArray($array) {
    $min = $array[0];
    foreach ($array as $element) {
        if ($element < $min) {
            $min = $element;
        }
    }
    return $min;
}

/**
 * Generate random hex color
 *
 * @return string
 */
function rand_hex_color() {
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}