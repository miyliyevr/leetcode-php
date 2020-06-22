<?php
/*
https://leetcode.com/problems/backspace-string-compare/

Given two strings S and T, return if they are equal when both are typed into empty text editors. # means a backspace character.
Input: S = "ab#c", T = "ad#c"
Output: true
Explanation: Both S and T become "ac".
*/

class Solution {
    /** 22:21 - 23:06
     * @param String $S
     * @param String $T
     * @return Boolean
     */
    function backspaceCompare($S, $T) {
        $a = str_split($S);
        $b = str_split($T);
        
        $aStack = new SplStack();
        $bStack = new SplStack();
        
        for($i = 0; $i < count($a); $i++) {
            $aStack->push($a[$i]);
        }
        for($i = 0; $i < count($b); $i++) {
            $bStack->push($b[$i]);
        }
        
        $aString = $this->runStack($aStack);
        $bString = $this->runStack($bStack);

        if ($aString == $bString) return true;
        else return false;
    }
    
    function runStack($aStack) {
        $aStack->rewind();
        $aString = '';
        $count = 0;
        
        while(!$aStack->isEmpty()){
            $c = $aStack->top();
            
            if ($c == '#') {
                $aStack->pop();
                $count++;
            } else {
                if ($count > 0) {
                    for ($count; $count > 0; $count--) {
                        if (!$aStack->isEmpty()) {
                            if ($aStack->top() == '#') {
                                $aStack->pop();
                                $count+=2;
                            } else $aStack->pop();
                        }
                    }
                } else {
                    $aString.=$aStack->pop();
                }
                $count = 0;
            }
        }
        
        return $aString;
    }
}

/* Test cases below
"ab#c"
"ad#c"
"ab##"
"c#d#"
"a##c"
"#a#c"
"a#c"
"b"
"bxj##tw"
"bxo#j##tw"
