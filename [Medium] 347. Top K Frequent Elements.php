<?php
/*
https://leetcode.com/problems/top-k-frequent-elements/

Given a non-empty array of integers, return the k most frequent elements.
*/

class Solution {
    /**
     * 23:40 - Trying to think and how to implement Min Heap in Javascript, then switching to PHP. - 23:58 - 00:19
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer[]
     * Input: nums = [1,1,1,2,2,3], k = 2 . Output: [1,2]
	 * Input: nums = [1], k = 1 . Output: [1]
     */
    function topKFrequent($nums, $k) {
        $result = [];
        $hashTable = [];
        $heap = new SplMinHeap();
        
        for ($i = 0; $i < count($nums); $i++) {
            if ( isset($hashTable[$nums[$i]]) ) {
                $hashTable[$nums[$i]]++;
            } else {
                $hashTable[$nums[$i]] = 1;
            }
        }

        foreach($hashTable as $key => $value) {
            $heap->insert([$value, $key]);
            if($heap->count() > $k) {
                $heap->extract();
            }
        }

        for ($i = 0; $i < $k; $i++) {
            array_unshift($result, $heap->extract()[1]);
        }

        return $result;
    }
}