<?php
/*
https://leetcode.com/problems/palindrome-partitioning

Given a string s, partition s such that every substring of the partition is a palindrome.
Return all possible palindrome partitioning of s.
*/

class Solution {
    protected $result = [];
    
    /** 18:31 - next day after seeing the solution
     * @param String $s
     * @return String[][]
     */
    function partition($s) {
        if ($this->isPalindrome($s)) {
            $this->result[] = [$s];
        }
  
        for ($i = 1; $i < strlen($s); $i++) {
             $currentResult = array_merge(
                $this->divide(substr($s, 0, $i)),
                $this->divide(substr($s, $i))
            );
            
            if (!in_array($currentResult, $this->result)) {
                $this->result[] = $currentResult;
            }
        }
        
        return $this->result;
    }
    
    function divide($s) {
        if ($this->isPalindrome($s)) {
            return [$s];
        }
        
        for ($i = 1; $i < strlen($s); $i++) {
            return array_merge(
                $this->divide(substr($s, 0, $i)),
                $this->divide(substr($s, $i))
            );
        }
    }
    
    
    function isPalindrome($ar) {
        $ar = str_split($ar);
        $start = 0;
        $end = count($ar)-1;
        
        while ($start < $end) {
            if ($ar[$start] == $ar[$end]) {
                $start++;
                $end--;
            } else {
                return false;
            }
        }
        
        return true;
    }
}

/* Test cases
"cbbbcc"
"xabaa"
"a"
"aab"