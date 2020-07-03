<?php
/*
https://leetcode.com/problems/set-matrix-zeroes/
Given a m x n matrix, if an element is 0, set its entire row and column to 0. Do it in-place.
*/

class Solution {
    /** 16:43 - 16:56
     * @param Integer[][] $matrix
     * @return NULL
     */
    function setZeroes(&$matrix) {
        $copy = $matrix;
        
        for ($i = 0; $i < count($copy); $i++) {
            for ($j = 0; $j < count($copy[$i]); $j++) {
                if ($copy[$i][$j] == 0) {
                    $this->fillRow($matrix, $i);
                    $this->fillCol($matrix, $j);
                }
            }
        }
    }

    function fillRow(&$matrix, $i) {
        for ($j = 0; $j < count($matrix[$i]); $j++) {
            $matrix[$i][$j] = 0;
        }
    }

    function fillCol(&$matrix, $j) {
        for ($i = 0; $i < count($matrix); $i++) {
            $matrix[$i][$j] = 0;
        }
    }
}

//Runtime: 44 ms, faster than 95.00% of PHP online submissions for Set Matrix Zeroes.
//Memory Usage: 19.5 MB, less than 100.00% of PHP online submissions for Set Matrix Zeroes.