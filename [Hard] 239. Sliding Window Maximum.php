<?php
/*
https://leetcode.com/problems/sliding-window-maximum/submissions/
Hard
239. Sliding Window Maximum
Given an array nums, there is a sliding window of size k which is moving from the very left of the array to the very right. You can only see the k numbers in the window. Each time the sliding window moves right by one position. Return the max sliding window.

Follow up:
Could you solve it in linear time?

Runtime: 1272 ms, faster than 100.00% of PHP online submissions for Sliding Window Maximum.
Memory Usage: 23.1 MB, less than 100.00% of PHP online submissions for Sliding Window Maximum.
*/

class Solution {

    /** 16:08 - 16:52
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer[]
     */
    function maxSlidingWindow($nums, $k) {
        $result = [];

        for ($i = 0; $i <= count($nums)-$k; $i++) {
            $result[] = $this->max($i, $k, $nums);
        }

        return $result;
    }

    function max($i, $k, $nums) {
        $arr = [];
        
        for ($j = 0; $j < $k; $j++) {
            if ($i+$j == count($nums)) break;
            $arr[] = $nums[$i+$j];
        }
        
        return max($arr);
    }
}