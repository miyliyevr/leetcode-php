<?php
/*
https://leetcode.com/problems/diameter-of-binary-tree/
https://leetcode.com/explore/featured/card/30-day-leetcoding-challenge/529/week-2/3293/

Given a binary tree, you need to compute the length of the diameter of the tree. The diameter of a binary tree is the length of the longest path between any two nodes in a tree. This path may or may not pass through the root.

[2,3,null,1]
[1,2,3,4,5]
[1,2]
*/

/** 12:38 -(gaving up, lunch) 14:39
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($value) { $this->val = $value; }
 * }
 */
class Solution {
    public $result = 0;
    /**
     * @param TreeNode $root
     * @return Integer
     */
    function diameterOfBinaryTree($root) {
        $l = 0;
        $r = 0;

        if($root->left) {
            $l = $this->dfs($root->left, 1);
        }

        if($root->right) {
            $r = $this->dfs($root->right, 1);
        }

        $currentMax = $l + $r;
        $this->result = max($this->result, $currentMax);
        
        return $this->result;
    }
    
    function dfs($root, $level) {
        if(!$root->left && !$root->right) return 1;

        $currentMax = 0;
        $l = 0;
        $r = 0;

        if($root->left) {
            $l = $this->dfs($root->left, $level+1);
        }
        if($root->right) {
            $r = $this->dfs($root->right, $level+1);
        }

        $currentMax = $l + $r;
        $this->result = max($this->result, $currentMax);

        $deepest = max($l, $r) + 1;
        return $deepest;
    }
}