<?php
/*
https://www.youtube.com/watch?v=XFPHg5KjHoo

findLongestSubarrayBySum
*/

<?php
class Solution {
    function run($nums, $sumTotal) {
        $result = [];
        
        if (count($nums) == 0) {
            return $result;
        } elseif ((count($nums) == 1) && $sumTotal == $nums[0]) {
            return [0,0];
        }
        
        $p1 = 0;
        $p2 = 1;
        $sum = $nums[0] + $nums[1];
        
        while ($p1 != $p2) {
            if ($sum == $sumTotal) {
                if ($result === [] || $result[1] - $result[0] < $p2 - $p1) {
                    $result = [$p1, $p2];
                }
            }
            
            if($sumTotal > $sum) {
                if (isset($nums[$p2+1])) {
                    $p2++;
                    $sum += $nums[$p2];
                }
            } elseif($sumTotal < $sum) {
                $sum -= $nums[$p1];
                $p1++;
            } else {
                if (isset($nums[$p2+1])) {
                    $p2++;
                    $sum += $nums[$p2];
                }
            }
        }
        
        return $result;
    }
}

$testCases = [
    [[1,2,3,7,5],12],
    [[3], 3],
    [[1,2,3,4,5,0,0,0,6,7,8,9,10],15],
];

$solution = new Solution();

foreach ($testCases as $case) {
    print_r(
        $solution->run($case[0], $case[1])
    );
}