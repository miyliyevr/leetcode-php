<?php
/*
https://leetcode.com/explore/featured/card/30-day-leetcoding-challenge/528/week-1/3285/

Given an integer array nums,
find the contiguous subarray (containing at least one number)
which has the largest sum and return its sum.
*/

class Solution {
    /**
     * 12:27 - 12:34
     * @param Integer[] $nums
     * @return Integer
     */
    function maxSubArray($nums) {
        $result = $currentMax = $nums[0];

        for($i=1; $i<count($nums);$i++) {
            $currentMax = max($nums[$i], $currentMax+$nums[$i]);
            $result = max($result, $currentMax);
        }

        return $result;
    }
}
