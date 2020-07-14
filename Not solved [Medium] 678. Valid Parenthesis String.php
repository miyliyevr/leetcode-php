<?php
/*
https://leetcode.com/problems/valid-parenthesis-string/

Given a string containing only three types of characters: '(', ')' and '*', write a function to check whether this string is valid. We define the validity of a string by these rules:

Any left parenthesis '(' must have a corresponding right parenthesis ')'.
Any right parenthesis ')' must have a corresponding left parenthesis '('.
Left parenthesis '(' must go before the corresponding right parenthesis ')'.
'*' could be treated as a single right parenthesis ')' or a single left parenthesis '(' or an empty string.
An empty string is also valid.
*/

//only 55 out of 58 test examples
class Solution {

    /** 20:22 - 21:32
     * @param String $s
     * @return Boolean
     */
    function checkValidString($s) {
        $stack = new SplStack();
        $s = str_split($s, 1);
        $wFirstIndex;
        $count = 0;
        
        for ($i = 0; $i < count($s); $i++) {
            
            if (!isset($wFirstIndex)) {
                if ($s[$i] == ')') {
                    $count++;
                } elseif ($s[$i] == '(') {
                    $count--;
                }
                
                if ($s[$i] == '*') {
                    $wFirstIndex = $i;
                    if ($count > 0) {
                        return false;
                    }
                }
            }
            
            $stack->push($s[$i]);
        }
        
        $stack->rewind();
        
        $r = 0;
        $w = 0;
        $result = true;
        
        while(!$stack->isEmpty()) {
            $c = $stack->pop();
            
            if ($c == ')') {
                $r++;
            } elseif ($c == '(') {
                $r--;
            } elseif ($c == '*') {
                $w++;
            }
            
            if ($r < 0 && $w < abs($r)) {
                $result = false;
            } elseif ($r < 0 && $w) {
                $w--;
                $r++;
            }
        }
        
        if (($r < 0 || $r > 0) && $w < abs($r)) {
            $result = false;
        }
        
        return $result;
    }
}

/* Test cases
"(()(()))(()()()))))((((()*()*(())())(()))((*()(*((*(*()))()(())*()()))*)*()))()()(())()(()))())))"
"(((******))"
"(*()"
"()"
"(*)"
"(*))"
"((())))"
"*"
")("
")(*"