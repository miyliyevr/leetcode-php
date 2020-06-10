<?php
/*
https://leetcode.com/problems/merge-intervals/

Given a collection of intervals, merge all overlapping intervals.
*/

class Solution {

    /** 19:28 - 19:58 Solving ; 19:59 - 20:29 Fixing and [Accepted]
     * @param Integer[][] $intervals
     * @return Integer[][]
     */
    function merge($intervals) {
        if (empty($intervals)) return [];
        $result = [];
        $lastIndex = 0;

        for ($i = 0; $i < count($intervals) ; $i++) {
            if (!isset($result[$intervals[$i][0]])) {
                $result[$intervals[$i][0]] = $intervals[$i];
            } else {
                $result[$intervals[$i][0]] = $this->mergeBoth($result[$intervals[$i][0]] , $intervals[$i]);
            }

            $lastIndex = max($lastIndex, $intervals[$i][0]);
        }

        sort($result);

        $finalResult = [];
            
        $keys = array_keys($result);
        $i = 0;
        
        while(isset($keys[$i])) {
            $current = $keys[$i];
            $next = $keys[$i+1];

            if (isset($result[$next]) && $result[$current][1] >= $result[$next][0]) {
                $result[$next] = $this->mergeBoth($result[$current], $result[$next]);
                unset($result[$current]);
            }
            $i++;
        }

        return $result;
    }

    function mergeBoth($a, $b) {
        $min = min($a[0], $b[0]);
        $max = max($a[1], $b[1]);
        return [$min, $max];
    }
}