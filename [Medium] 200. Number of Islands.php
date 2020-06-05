<?php
/*
https://leetcode.com/problems/number-of-islands/

Given a 2d grid map of '1's (land) and '0's (water), count the number of islands.
An island is surrounded by water and is formed by connecting adjacent lands horizontally or vertically.
You may assume all four edges of the grid are all surrounded by water.
*/

class Solution {

    /**
     * @param String[][] $grid
     * @return Integer
     */
    function numIslands($grid) {
        $islandCounter = 0;

        for ($i = 0; $i < count($grid); $i++) {
            for ($j = 0; $j < count($grid[0]); $j++) {
                if ($grid[$i][$j] == 1) {
                    $islandCounter++;
                    $this->walkGrid($grid, $i, $j);
                }
            }
        }

        return $islandCounter;
    }

    function walkGrid (&$grid, $i, $j) {
        if (!isset($grid[$i][$j])) {
            return;
        }

        if ($grid[$i][$j] == 0) {
            return;
        }

        $grid[$i][$j] = 0;

        $this->walkGrid($grid, $i, $j+1);
        $this->walkGrid($grid, $i+1, $j);
        $this->walkGrid($grid, $i, $j-1);
        $this->walkGrid($grid, $i-1, $j);
    }
}
