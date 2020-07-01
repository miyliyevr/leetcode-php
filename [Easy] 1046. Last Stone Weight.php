<?php
/*
https://leetcode.com/problems/last-stone-weight/

We have a collection of stones, each stone has a positive integer weight.

Each turn, we choose the two heaviest stones and smash them together.  Suppose the stones have weights x and y with x <= y.  The result of this smash is:

If x == y, both stones are totally destroyed;
If x != y, the stone of weight x is totally destroyed, and the stone of weight y has new weight y-x.
At the end, there is at most 1 stone left.  Return the weight of this stone (or 0 if there are no stones left.)
*/

//Faster solution with heaps
class Solution {
    /** 10:17 - 10:26
     * @param Integer[] $stones
     * @return Integer
     */
    function lastStoneWeight($stones) {
        $heap = new SplMaxHeap();

        for ($i = 0; $i < count($stones); $i++) {
            $heap->insert($stones[$i]);
        }

        while ($heap->count() > 1) {
            $smashR = $heap->extract() - $heap->extract();
            
            if ($smashR > 0) $heap->insert($smashR);
        }

        if ($heap->count() == 1) return $heap->top();
        if ($heap->count() == 0) return 0;
    }
}

//Slower solution
class Solution {
    /** 09:34 - 10:16
     * @param Integer[] $stones
     * @return Integer
     */
    function lastStoneWeight($stones) {
        rsort($stones);

        while (count($stones) > 1) {
            $smashR = $stones[0] - $stones[1];

            unset($stones[0]);
            unset($stones[1]);
            $stones = array_values($stones);
            if (count($stones) == 0) return $smashR;

            if ($smashR > 0) {
                for ($i = 0; $i <= count($stones); $i++) {
                    if ($i == count($stones)) {
                        $stones[] = $smashR;
                        break;
                    }

                    if ($stones[$i] > $smashR) continue;

                    $stones = array_merge(
                        array_slice($stones, 0, $i),
                        [$smashR],
                        array_slice($stones, $i, count($stones))
                    );
                    break;
                }
            }
        }

        if (isset($stones[0])) return $stones[0];
        return 0;
    }
}

/* Test cases
[3,7,8]
[1,3]
[2,7,4,1,8,1]
[7]


