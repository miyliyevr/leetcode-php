<?php
/*
https://leetcode.com/problems/sum-of-two-integers/
This task was in medium, but now in easy
Calculate the sum of two integers a and b, but you are not allowed to use the operator + and -.
*/

class Solution {

    /** 00:30 - 01:10 until got Runtime Error Message:
     * Line 51: PHP Fatal error:  Out of memory (allocated 2097152) (tried to allocate 34359738368 bytes) in solution.php
     * @param Integer $a
     * @param Integer $b
     * @return Integer
     */
    function getSum($a, $b) {    
        if ($a >= 0 && $b >= 0) {
            $aArray = new SplFixedArray($a);
            $bArray = new SplFixedArray($b);
            $cArray = array_merge($aArray->toArray(), $bArray->toArray());
            $result = count($cArray);
        } elseif ($a < 0 && $b < 0) {
            $a = abs($a);
            $aArray = new SplFixedArray($a);
            $b = abs($b);
            $bArray = new SplFixedArray($b);
            $cArray = array_merge($aArray->toArray(), $bArray->toArray());
            $result = count($cArray) * (-1);
        } else {
            $min = min($a, $b);
            $max = max($a, $b);
            $min = abs($min);
            
            $multiplier = 1;
            if ($min > $max) {
                $multiplier = -1;
            }
            
            $a = max($min, $max);
            $b = min($min, $max);
            $aArray = new SplFixedArray($a);
            $bArray = new SplFixedArray($b);
            $cArray = array_diff_assoc($aArray->toArray(), $bArray->toArray());
            $result = count($cArray) * $multiplier;
        }

        return $result;
    }
}