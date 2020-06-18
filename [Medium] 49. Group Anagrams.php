<?php
/*
https://leetcode.com/problems/group-anagrams/
*/

class Solution {
    /**
    * 15:35 - 15:54
    * @param String[] $strs
    * @return String[][]
    */
    function groupAnagrams($strs) {
        $sortedStrs = [];
        $result = [];

        for($i=0; $i<count($strs); $i++) {
            $str = str_split($strs[$i], 1);
            sort($str);
            $word = implode('', $str);
           
            if(array_key_exists($word, $sortedStrs)) {
                $sortedStrs[$word] = array_merge($sortedStrs[$word], [$i]);
            } else {
                $sortedStrs[$word] = [$i];
            }
        }

        foreach($sortedStrs as $str) {
            $concat = [];
           
            foreach($str as $s) {
                $concat[] = $strs[$s];
            }
           
            $result[] = $concat;
        }

        return $result;
    }
}