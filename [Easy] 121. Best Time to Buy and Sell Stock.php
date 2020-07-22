<?php
/*
https://leetcode.com/problems/best-time-to-buy-and-sell-stock/

Say you have an array for which the ith element is the price of a given stock on day i.

If you were only permitted to complete at most one transaction (i.e., buy one and sell one share of the stock), design an algorithm to find the maximum profit.

Note that you cannot sell a stock before you buy one.
*/

class Solution {
    /** 09:36 - 10:15
     * @param Integer[] $prices
     * @return Integer
     */
    function maxProfit($prices) {
        $result = 0;
        $min = $prices[0];
        
        for ($i = 0; $i < count($prices); $i++) {
            if ($prices[$i] <= $min) {
                $min = $prices[$i];
            } else {
                $result = max($result, $prices[$i] - $min);
            }
        }

        return $result;
    }
}