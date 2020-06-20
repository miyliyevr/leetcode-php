<?php
/*
https://leetcode.com/problems/middle-of-the-linked-list/
Given a non-empty, singly linked list with head node head, return a middle node of linked list.
If there are two middle nodes, return the second middle node.
*/

/** 20:11 - 20:27
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */
class Solution {
    /**
     * @param ListNode $head
     * @return ListNode
     */
    function middleNode($head) {
        $start = $head;
        if ($start->next === null) {
            return $head;
        }
        $counter = 1;

        while($start->next !== null) {
            $counter++;
            $start = $start->next;
        }

        $middle = floor(($counter/2)) + 1;
        $counter = 1;
        
        while($head !== null) {
            if ($counter == $middle) {
                return $head;
            }
            $head = $head->next;
            $counter++;
        }
    }
}