<?php 
/*
https://leetcode.com/problems/k-closest-points-to-origin/

We have a list of points on the plane.  Find the K closest points to the origin (0, 0).
(Here, the distance between two points on a plane is the Euclidean distance.)
You may return the answer in any order.  The answer is guaranteed to be unique (except for the order that it is in.)

Time spend:
12:47 - 13:10 = O(N * logN + K) solution
+
16:30 - 17:22 for better solution of O(N * logK) solution

Runtime: 368 ms, faster than 14.29% of PHP online submissions for K Closest Points to Origin.
Memory Usage: 30.6 MB, less than 100.00% of PHP online submissions for K Closest Points to Origin.

Test Cases:
[[1,3],[-2,2]]
1
[[3,3],[5,-1],[-2,4]]
2
[[-95,76],[17,7],[-55,-58],[53,20],[-69,-8],[-57,87],[-2,-42],[-10,-87],[-36,-57],[97,-39],[97,49]]
5
*/

/**
 * O(N*logN+K) Solution
 */
class Solution {
    /**
     * @param Integer[][] $points
     * @param Integer $K
     * @return Integer[][]
     */
    function kClosest($points, $K) {
        $distances = [];

        for ($i = 0; $i < count($points); $i++) {
            $distances[] = [ $this->getEuclideanDist($points[$i][0],  $points[$i][1]) , [$points[$i][0],$points[$i][1]] ];
        }

        sort($distances);

        $answerSet = [];
        $c = $K;
        foreach($distances as $distance) {
            $answerSet[] = $distance[1];
            $c--;
            if ($c == 0 ) break;
        }

        return $answerSet;
    }

    function getEuclideanDist($a, $b) {
        return sqrt(($a*$a)+($b*$b));
    }
}


/**
 * O(N*logK) Solution
 */

class Solution {
    /**
     * @param Integer[][] $points
     * @param Integer $K
     * @return Integer[][]
     */
    function kClosest($points, $K) {
        $distances = [];

        $pq = new SplMaxHeap();

        for ($i = 0; $i < count($points); $i++) {
            $eucCalc = $this->getEuclideanDist($points[$i][0],  $points[$i][1]);

            if ($pq->count() < $K || $eucCalc < $pq->top()[0]) {
                if ($pq->count() >= $K) {
                    $pq->extract();
                }
                $pq->insert([ $eucCalc, [$points[$i][0],$points[$i][1]] ]);
            }
        }

        $answerSet = [];
        
        while ($pq->count() > 0) {
            $answerSet[] = $pq->extract()[1];
        }

        return $answerSet;
    }

    function getEuclideanDist($a, $b) {
        return sqrt(($a*$a)+($b*$b));
    }
}
