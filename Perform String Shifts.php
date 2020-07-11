<?php
/*
30 days challenge 
Possibly : https://leetcode.com/problems/perform-string-shifts/ (Subscription needed)

Perform String Shifts

You are given a string s containing lowercase English letters, and a matrix shift, where shift[i] = [direction, amount]:

direction can be 0 (for left shift) or 1 (for right shift). 
amount is the amount by which string s is to be shifted.
A left shift by 1 means remove the first character of s and append it to the end.
Similarly, a right shift by 1 means remove the last character of s and add it to the beginning.
Return the final string after all operations.


Example 1:

Input: s = "abc", shift = [[0,1],[1,2]]
Output: "cab"
Explanation: 
[0,1] means shift to left by 1. "abc" -> "bca"
[1,2] means shift to right by 2. "bca" -> "cab"
Example 2:

Input: s = "abcdefg", shift = [[1,1],[1,1],[0,2],[1,3]]
Output: "efgabcd"
Explanation:  
[1,1] means shift to right by 1. "abcdefg" -> "gabcdef"
[1,1] means shift to right by 1. "gabcdef" -> "fgabcde"
[0,2] means shift to left by 2. "fgabcde" -> "abcdefg"
[1,3] means shift to right by 3. "abcdefg" -> "efgabcd"
*/

class Solution {

    /** 22:06 - 22:29
     * @param String $s
     * @param Integer[][] $shift
     * @return String
     */
    function stringShift($s, $shift) {
        $counter = 0;
        
        for ($i = 0; $i < count($shift); $i++) {
            if ($shift[$i][0] == 0) {
                $counter -= $shift[$i][1];
            } else {
                $counter += $shift[$i][1];
            }
        }
        
        return $this->shiftString($s, $counter);
    }
    
    function shiftString($s, $counter) {
        $counter %= strlen($s);

        if ($counter == 0) {
            return $s;
        } elseif ($counter < 0) {
            $start = substr($s, -1 * (strlen($s) - abs($counter)));
            $end = substr($s, 0, abs($counter));
            return $start.$end;
        } else {
            $start = substr($s, -1 * $counter);
            $end = substr($s, 0, strlen($s) - $counter);
            return $start.$end;
        }
    }
}