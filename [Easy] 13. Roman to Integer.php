<?php
/*
https://leetcode.com/problems/roman-to-integer/

Roman numerals are represented by seven different symbols: I, V, X, L, C, D and M.

Easy, sth like this is asked on medium level for Amazon onsite in London
*/

class Solution {
    /**
     * 14:53 - 15:07
     * @param String $s
     * @return Integer
     */
    function romanToInt($s) {
        $nums = str_split($s);
        $decs = [
            'I'=> 1,
            'V'=> 5,
            'X'=> 10,
            'L'=> 50,
            'C'=> 100,
            'D'=> 500,
            'M'=> 1000,
        ];
        $sum = 0;

        for($i=0; $i<count($nums)-1; $i++) {
            $digit = $decs[$nums[$i]];
            $nextDigit = $decs[$nums[$i+1]];
            
            if ($digit < $nextDigit) {
                $sum -= $digit;
            } else {
                $sum += $digit;
            }
        }

        $sum += $decs[$nums[count($nums)-1]];
        return $sum;
    }
}