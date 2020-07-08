<?php
/*
https://leetcode.com/problems/first-unique-character-in-a-string/

Given a string, find the first non-repeating character in it and return its index. If it doesn't exist, return -1.
*/

class Solution {
    /** 14:56 - 15:04
     * @param String $s
     * @return Integer
     */
    function firstUniqChar($s) {
        if ($s === '') return -1;

        $hash = [];
        $s = str_split($s, 1);

        for ($i = 0; $i < count($s); $i++) {
            if (isset($hash[$s[$i]])) {
                $hash[$s[$i]]++;
            } else {
                $hash[$s[$i]] = 1;
            }
        }

        for ($i = 0; $i < count($s); $i++) {
            if ($hash[$s[$i]] == 1) return $i;
        }

        return -1;
    }
}