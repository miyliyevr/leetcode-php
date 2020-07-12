<?php
/*
https://leetcode.com/explore/featured/card/30-day-leetcoding-challenge/530/week-3/3300/

Product of Array Except Self

Given an array nums of n integers where n > 1,  return an array output such that output[i] is equal to the product of all the elements of nums except nums[i].

Example:

Input:  [1,2,3,4]
Output: [24,12,8,6]
Constraint: It's guaranteed that the product of the elements of any prefix or suffix of the array (including the whole array) fits in a 32 bit integer.

Note: Please solve it without division and in O(n).

Follow up:
Could you solve it with constant space complexity? (The output array does not count as extra space for the purpose of space complexity analysis.)
*/

class Solution {

    /** 21:54 - 
     * @param Integer[] $nums
     * @return Integer[]
     */
    function productExceptSelf($nums) {
        $prod = 1;
        $isProdChanged = false;
        $zeroIndex = [];
        
        for ($i = 0; $i < count($nums); $i++) {
            if ($nums[$i] == 0) {
                $zeroIndex[] = $i;
                continue;
            }
            
            $prod *= $nums[$i];
            $isProdChanged = true;
        }
        
        $answer = [];
        
        for ($i = 0; $i < count($nums); $i++) {
            if (count($zeroIndex) > 1 || $isProdChanged == false) {
                $answer[] = 0;
                continue;
            } elseif (count($zeroIndex) == 1) {
                if ($i == $zeroIndex[0]) {
                    $answer[] = $prod;
                } else {
                    $answer[] = 0;
                }
                continue;
            }
            
            $answer[] = $prod / $nums[$i];
        }
        
        return $answer;
    }
}


// Solution according to rule not using division
class Solution {

    /** 21:54 - 22:48
     * @param Integer[] $nums
     * @return Integer[]
     */
    function productExceptSelf($nums) {
        $prefix = [$nums[0]];
        $suffix = [$nums[count($nums)-1]];
        
        for ($i = 1; $i < count($nums)-1; $i++) {
            $prefix[] = $prefix[$i-1] * $nums[$i];
        }
        
        for ($i = count($nums)-2; $i > 0; $i--) {
            $suffix[] = $suffix[count($suffix)-1] * $nums[$i];
        }
        
        $answer = [];
        
        for ($i = 0; $i < count($nums); $i++) {
            $pref = 1;
            $suf = 1;
            
            if (isset($prefix[$i-1])) {
                $pref = $prefix[$i-1];
            }
            
            if (isset($suffix[count($suffix)-1-$i])) {
                $suf = $suffix[count($suffix)-1-$i];
            }
            
            $answer[$i] = $pref * $suf;
        }
        
        return $answer;
    }
}

/* Test cases
[1,0]
[0,0,2,1,3,0,2]
[0,1,0]
[0,0]
[1,2,3,4]