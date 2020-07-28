<?php
/*
https://leetcode.com/problems/minimum-path-sum

Given a m x n grid filled with non-negative numbers, find a path from top left to bottom right which minimizes the sum of all numbers along its path.
Note: You can only move either down or right at any point in time.
*/

// 60 / 61 test cases passed.
class Solution {
    /** 12:49 - 13:07 Time Limit - 13:17 Another Time Limit
     * @param Integer[][] $grid
     * @return Integer
     */
    public $minSum = PHP_INT_MAX;
    public $memo = [];
    
    function minPathSum($grid) {
        $this->walk($grid, 0, 0, 0);
        $minSum = $this->minSum;
        $this->minSum = 0;
        return $minSum;
    }
    
    function walk($grid, $i, $j, $sum) {
        if (!isset($grid[$i][$j])) {
            return;
        }

        if (isset($this->memo[$i][$j]) && $sum > $this->memo[$i][$j]) {
            return;
        }
        
        $sum = $sum + $grid[$i][$j];
        $this->memo[$i][$j] = $sum;
        
        if ($i == count($grid)-1 && $j == count($grid[$i])-1) {
            $this->minSum = min($sum, $this->minSum);
        }
        
        $this->walk($grid, $i+1, $j, $sum);
        $this->walk($grid, $i, $j+1, $sum);
    }
}

// Accepted Solution
class Solution {
    /** 12:49 - 13:07 Time Limit - Reading solution - 13:47
     * @param Integer[][] $grid
     * @return Integer
     */
    
    function minPathSum($grid) {
        for ($i = 0; $i < count($grid); $i++) {
            for ($j = 0; $j < count($grid[$i]); $j++) {
                if ($i == 0 && $j == 0) continue;
                
                if ($j - 1 >= 0 && $i == 0) {
                    $grid[$i][$j] += $grid[$i][$j-1];
                } elseif ($j == 0 && $i-1 >= 0)  {
                    $grid[$i][$j] += $grid[$i-1][$j];
                } else {
                    $grid[$i][$j] += min($grid[$i][$j-1], $grid[$i-1][$j]);
                }
            }
        }
        
        $last = count($grid)-1;
        return $grid[$last][count($grid[$last])-1];
    }
}

/* Test cases :
[[1,3,1],[1,5,1],[4,2,1]]
[[7,1,3,5,8,9,9,2,1,9,0,8,3,1,6,6,9,5],[9,5,9,4,0,4,8,8,9,5,7,3,6,6,6,9,1,6],[8,2,9,1,3,1,9,7,2,5,3,1,2,4,8,2,8,8],[6,7,9,8,4,8,3,0,4,0,9,6,6,0,0,5,1,4],[7,1,3,1,8,8,3,1,2,1,5,0,2,1,9,1,1,4],[9,5,4,3,5,6,1,3,6,4,9,7,0,8,0,3,9,9],[1,4,2,5,8,7,7,0,0,7,1,2,1,2,7,7,7,4],[3,9,7,9,5,8,9,5,6,9,8,8,0,1,4,2,8,2],[1,5,2,2,2,5,6,3,9,3,1,7,9,6,8,6,8,3],[5,7,8,3,8,8,3,9,9,8,1,9,2,5,4,7,7,7],[2,3,2,4,8,5,1,7,2,9,5,2,4,2,9,2,8,7],[0,1,6,1,1,0,0,6,5,4,3,4,3,7,9,6,1,9]]