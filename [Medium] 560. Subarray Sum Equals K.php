<?php
/*
https://leetcode.com/problems/subarray-sum-equals-k/

Given an array of integers and an integer k, you need to find the total number of continuous subarrays whose sum equals to k.
Note:
The length of the array is in range [1, 20,000].
The range of numbers in the array is [-1000, 1000] and the range of the integer k is [-1e7, 1e7].
*/

// Time Limit exceeded
class Solution {
    /**
     * 21:03 - 21:33
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer
     */
    function subarraySum($nums, $k) {
        $currentSum = null;
        $subArraysNum = 0;
        $arr = [];

        for($i=0; $i<count($nums); $i++) {
           for($j=$i; $j<count($nums); $j++) {
               if ($currentSum === null) {
                   $currentSum = $nums[$j];
                   $arr[] = $nums[$j];
               } else {
                   $currentSum += $nums[$j];
                   $arr[] = $nums[$j];
               }

               if ($currentSum == $k) {
                   $subArraysNum++;
               }
            }
            $currentSum = null;
            $arr = [];
        }

        return $subArraysNum;
    }
}

// Java accepted solution converted to PHP
class Solution {
    function subarraySum($nums, $k) {
        $count = 0;
        for ($start = 0; $start < count($nums); $start++) {
            $sum=0;
            for ($end = $start; $end < count($nums); $end++) {
                $sum+=$nums[$end];
                if ($sum == $k)
                    $count++;
            }
        }
        return $count;
    }
}

/* Test cases
[1,1,1]
2
[0]
0
[-1, -2, 0, -3, 10, 5, -8, -10]
-3
