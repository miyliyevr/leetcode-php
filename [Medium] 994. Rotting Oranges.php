<?php
/*
https://leetcode.com/problems/rotting-oranges

In a given grid, each cell can have one of three values:
the value 0 representing an empty cell;
the value 1 representing a fresh orange;
the value 2 representing a rotten orange.

Every minute, any fresh orange that is adjacent (4-directionally) to a rotten orange becomes rotten.
Return the minimum number of minutes that must elapse until no cell has a fresh orange.
If this is impossible, return -1 instead.
*/

class Solution {

    /**
     * 20:40 - 21:49
     * 10:58 - 12:46 => faster than 100%, memory less than 100%
     * @param Integer[][] $grid
     * @return Integer
     */
    function orangesRotting($grid) {
        $freshOranges = $this->orangeCount($grid);
        $q = new SplQueue();
        $min = 0;
        
        for($i=0; $i<count($grid);$i++){
            for($j=0; $j<count($grid[$i]);$j++){
                if($grid[$i][$j] == 2) {
                    $q->enqueue([$i,$j]);
                }
            }
        }

        while(!$q->isEmpty()) {
            if ($freshOranges == 0) {
                return $min; 
            }

            $qCount = $q->count();

            for ($k=0; $k < $qCount; $k++) {
                $pos = $q->dequeue();
                $i = $pos[0];
                $j = $pos[1];

                if ($i+1<count($grid) && $grid[$i+1][$j] == 1) {
                    $grid[$i+1][$j] = 2;
                    $q->enqueue([$i+1, $j]);
                    $freshOranges--;
                }
                if ($j+1<count($grid[$i]) && $grid[$i][$j+1] == 1) {
                    $grid[$i][$j+1] = 2;
                    $q->enqueue([$i, $j+1]);
                    $freshOranges--;
                }
                if ($i-1>=0 && $grid[$i-1][$j] == 1) {
                    $grid[$i-1][$j] = 2;
                    $q->enqueue([$i-1, $j]);
                    $freshOranges--;
                }
                if ($j-1>=0 && $grid[$i][$j-1] == 1) {
                    $grid[$i][$j-1] = 2;
                    $q->enqueue([$i, $j-1]);
                    $freshOranges--;
                }
            }

            $min++;
        }
        
        if ($freshOranges == 0) {
            return $min; 
        }
        return -1;
    }
    
    function orangeCount($grid) {
        $count = 0;
        
        for($i=0; $i<count($grid);$i++){
            for($j=0; $j<count($grid[$i]);$j++){
                if($grid[$i][$j] == 1) {
                    $count++;
                }
            }
        }
        return $count;
    }
}

/* Test cases
[[2],[2],[1],[0],[1],[1]]
[[0]]
[[1],[1],[1],[1]]
[[2,1]]
[[0,1]]
[[0,2]]
[[2,1,1],[0,1,1],[1,0,1]]