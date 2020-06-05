<?php
/*
https://leetcode.com/problems/longest-substring-without-repeating-characters/

Given a string, find the length of the longest substring without repeating characters.
*/

class Solution {

    /**
     * @param String $s
     * @return Integer
     */
    function lengthOfLongestSubstring($s) {
        if ($s === '') return 0;
        $s = str_split($s, 1);
        $subString = [];
        $largestSubstring = [];

        for ($i = 0; $i < count($s); $i++) {
            $repCharPos = array_search($s[$i], $subString);

            if ($repCharPos !== false) {
                $subString = array_slice($subString, $repCharPos-1);
            }

            $subString[] = $s[$i];

            if (count($subString) > count($largestSubstring)) {
                $largestSubstring = $subString;
            }
        }

        return count($largestSubstring);
    }
}