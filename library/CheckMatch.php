<?php

class CheckMatch{
    static public function str_contains_all($haystack, array $needles) {
        foreach ($needles as $needle) {
            if (strpos($haystack, $needle) === false) {
                return false;
            }
        }
        return true;
    }
}