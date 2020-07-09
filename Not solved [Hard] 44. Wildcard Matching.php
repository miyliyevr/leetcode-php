<?php
/*
https://leetcode.com/problems/wildcard-matching

Given an input string (s) and a pattern (p), implement wildcard pattern matching with support for '?' and '*'.

'?' Matches any single character.
'*' Matches any sequence of characters (including the empty sequence).
The matching should cover the entire input string (not partial).

Note:

s could be empty and contains only lowercase letters a-z.
p could be empty and contains only lowercase letters a-z, and characters like ? or *.
*/

class Solution {

    /** 15:07 - 16:15
     * @param String $s
     * @param String $p
     * @return Boolean
     */
    function isMatch($s, $p) {
        $s = str_split($s);
        $p = str_split($p);
        $j = 0;
        $result = true;
        $w = null;
        
        $result = $this->checkWord($s, $p, 0, 0, null);
        
        return $result;
    }
    
    function checkWord($s, $p, $i, $j, $w) {
        $jump = [];
        
        for (; $i < count($s); $i++) {
            if (isset($w) && $s[$i] !== $w) {
                continue;       
            }
            
            if ($p[$j] === '?') {
                $j++;
                continue;
            } elseif ($p[$j] === '*') {
                if (isset($p[$j+1])) {
                    $w = $p[$j+1];
                    $j++;
                    $i--;
                    $jump = $this->find($w, $s, $j);
                } else {
                    return true;
                }
            } else {
                if (!isset($p[$j])) {
                    return false;
                }
                if ($s[$i] !== $p[$j]) {
                    $res = false;
                    if (!empty($jump)) {
                        foreach($jump as $hop) {
                            $res = $res || $this->checkWord($s, $p, $hop[0], $hop[1], null);
                        }
                        return $res;
                    }
                    
                    return false;
                }
                $j++;
                $w = null;
            }
        }
        
        if (isset($p[$j])) return false;
        
        return true;
    }
    
    function find($w, $s, $j) {

        
        for ($i = 0; $i < count($s); $i++) {
            if ($s[$i] === $w) {
                $pos[] = [$i, $j];
            }
        }
        
        unset($pos[0]);
        return $pos;
    }
}


/* Test cases
"aaaa"
"***a"
"acdcb"
"a*c?b"
"acdcb"
"a*cb"
"*"
"a"
"**"
"adceb"
"*a*b"
"aa"
"a"
"aa"
"*"
"cb"
"?a"