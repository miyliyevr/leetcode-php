<?php
/*
https://leetcode.com/problems/word-ladder/

Given two words (beginWord and endWord), and a dictionary's word list, find the length of shortest transformation sequence from beginWord to endWord, such that:
Only one letter can be changed at a time.
Each transformed word must exist in the word list.
*/

//Naive solution

class Solution {

    protected $dict = [];
    protected $e = [];
    protected $letters = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
    protected $counts = [];
    
    /** 10:43 - 11:19
     * @param String $beginWord
     * @param String $endWord
     * @param String[] $wordList
     * @return Integer
     */
    function ladderLength($beginWord, $endWord, $wordList) {
        $b = str_split($beginWord);
        $this->e = str_split($endWord);

        foreach($wordList as $word) {
            $this->dict[] = str_split($word);
        }

        $count = 0;
        $this->changeLetter($b, $count, $this->dict);

        if (empty($this->counts)) {
            return 0;
        } else {
            return min($this->counts);
        }
    }
    
    function changeLetter($b, $count, $dict) {
        if ($b == $this->e) {
            $this->counts[] = $count;
        }

        for ($i=0; $i < count($b); $i++) {
            $transfB = $b;
            
            foreach ($this->letters as $letter) {
                if ($letter != $b[$i]) {
                    $transfB[$i] = $letter;
                    $key = array_search($transfB, $dict);

                    if ($key !== false) {
                        unset($dict[$key]);
                        $this->changeLetter($transfB, ++$count, $dict);
                    }
                }
            }
        }
        
        $count = 0;
    }
}

/**
 * Another Solution
 */

class Solution {
    protected $dict = [];
    protected $e = [];
    protected $letters = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
    protected $counts = [];
    
    /** 10:43 - 11:19 13:57-
     * @param String $beginWord
     * @param String $endWord
     * @param String[] $wordList
     * @return Integer
     */
    function ladderLength($beginWord, $endWord, $wordList) {
        $b = str_split($beginWord);
        $this->e = str_split($endWord);
        
        foreach($wordList as $word) {
            $this->dict[] = str_split($word);
        }
        
        $count = 0;
        $this->changeLetter($b, $count, $this->dict);

        if (empty($this->counts)) {
            return 0;
        } else {
            $count = min($this->counts);
            $key = array_search($b, $this->dict);
            if ($key !== false) {
                $count++;
            }
            return $count;
        }
    }

    function changeLetter($b, $count, $dict) {
        if ($b == $this->e) {
            $this->counts[] = $count;
        }

        for ($i=0; $i < count($b); $i++) {
            $transfB = $b;
            
            foreach ($this->letters as $letter) {
                if ($letter == $b[$i]) continue;
                    $transfB[$i] = $letter;
                    $key = array_search($transfB, $dict);

                    if ($key !== false) {
                        unset($dict[$key]);
                        $this->changeLetter($transfB, ++$count, $dict);
                    }
            }
        }

        $count = 0;
    }
}

/*
Test cases:
"hot"
"dot"
["hot","dot","dog"]
"a"
"c"
["a","b","c"]
"hit"
"cog"
["hot","dot","dog","lot","log"]
"hit"
"cog"
["hot","dot","dog","lot","log","cog"]