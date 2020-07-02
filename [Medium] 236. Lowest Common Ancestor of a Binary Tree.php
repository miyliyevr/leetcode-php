<?php
/*
https://leetcode.com/problems/lowest-common-ancestor-of-a-binary-tree/

Given a binary tree, find the lowest common ancestor (LCA) of two given nodes in the tree.
According to the definition of LCA on Wikipedia: “The lowest common ancestor is defined between two nodes p and q as the lowest node in T that has both p and q as descendants (where we allow a node to be a descendant of itself).”
Given the following binary tree:  root = [3,5,1,6,2,0,8,null,null,7,4]
*/

/** 13:57 - 14:33 - 15:21 out of memory
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($value) { $this->val = $value; }
 * }
 */

class Solution {
    /**
     * @param TreeNode $root
     * @param TreeNode $p
     * @param TreeNode $q
     * @return TreeNode
     */
    function lowestCommonAncestor($root, $p, $q) {
        $arrayP = $this->findBT($root, $p);
        $arrayQ = $this->findBT($root, $q);
        
        return $this->compare($arrayP, $arrayQ);
    }

    function findBT($root, $n) {
        if ($root->val != $n->val) {
            $left = $this->walkBT($root->left, $n, [$root]);
            if (!empty($left)) return $left;
            
            return $this->walkBT($root->right, $n, [$root]);
        } else {
            return [$root];
        }
    }

    function walkBT($root, $n, $fathers) {
        $fathers[] = $root;
        
        if ($root->left == null && $root->right == null) {
            if ($root->val == $n->val) return $fathers;
            return [];
        }

        if ($root->val != $n->val) {
            $left = $this->walkBT($root->left, $n, $fathers);
            if (!empty($left)) return $left;
            
            return $this->walkBT($root->right, $n, $fathers);
        } else {
            return $fathers;
        }
    }

    function compare($array, $hashTable) {
        foreach ($hashTable as $key) {
            $asArray[$key->val] = 0;
        }

        for ($i = count($array)-1; $i >= 0; $i--) {
            if (isset($asArray[$array[$i]->val])) {
                return $array[$i];
            }
        }
    }
}

/* Test cases
[3,5,1,6,2,0,8,null,null,7,4]
5
4
[3,5,1,6,2,0,8,null,null,7,4]
5
1
[1,2]
1
2