<?php
/*
https://leetcode.com/problems/rotate-array/

Given an array, rotate the array to the right by k steps, where k is non-negative.

Follow up:

Try to come up as many solutions as you can, there are at least 3 different ways to solve this problem.
Could you do it in-place with O(1) extra space?
*/

class Solution {

    /** 12:29 - 12:44
     * @param Integer[] $nums
     * @param Integer $k
     * @return NULL
     */
    function rotate(&$nums, $k) {
        $k = $k % count($nums);
        $start = [];
        
        for ($i = count($nums) - $k; $i < count($nums); $i++) {
            $start[] = $nums[$i];
        }
        
        $end = [];
        
        for ($i = 0; $i < count($nums) - $k; $i++) {
            $end[] = $nums[$i];
        }
        
        $nums = array_merge($start, $end);
    }
}