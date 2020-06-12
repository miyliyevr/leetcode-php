<?php
/*
https://leetcode.com/problems/linked-list-cycle/

Given a linked list, determine if it has a cycle in it.
To represent a cycle in the given linked list,
we use an integer pos which represents the position (0-indexed) in the linked list where tail connects to.
If pos is -1, then there is no cycle in the linked list.
*/

/**
 * 11:54 - 12:18
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
     * @return Boolean
     */
    function hasCycle($head) {
        if($head->next == null) {
            return false;
        }

        $p1 = $p2 = $head;

        while($p2->next != null && $p2->next->next != null) {
            $p1 = $p1->next;
            $p2 = $p2->next->next;

            if ($p1 == $p2) {
                $p1 = $head;

                while($p1 != $p2) {
                    $p1 = $p1->next;
                    $p2 = $p2->next;
                }
                return true;
            }
        }

        return false;
    }
}
