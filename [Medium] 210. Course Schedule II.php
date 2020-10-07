<?php
/*
https://leetcode.com/problems/course-schedule-ii/

There are a total of n courses you have to take labelled from 0 to n - 1.

Some courses may have prerequisites, for example, if prerequisites[i] = [ai, bi] this means you must take the course bi before the course ai.

Given the total number of courses numCourses and a list of the prerequisite pairs, return the ordering of courses you should take to finish all courses.

If there are many valid answers, return any of them. If it is impossible to finish all courses, return an empty array.
*/

class Solution {

    /**19:17 - 20:13 implemetation
     * 20:13 - 21:07 Fixing
     * 21:08-22:04 Fighting with leetCode PHP interpreter over static and etc. 'Run Code' accepts everything ))
     * @param Integer $numCourses
     * @param Integer[][] $prerequisites
     * @return Integer[]
     */
    function findOrder($numCourses, $prerequisites) {
        $answer = [];
        for ($i = 0; $i < $numCourses; $i++) {
            $answer[] = $i;
        }
        
        if ($prerequisites == []) {
            return $answer;
        }
        
        $tree = new Tree();
        $tree::$result = [];
        foreach ($prerequisites as $reqPair) {
            $tree->insert($reqPair[0], $reqPair[1]);
        }
        
        if ($tree::$impossible === true) {
            $tree::$impossible = false;
            return [];
        }
        
        $tree->printBfs();
        
        $islands = [];
        foreach ($answer as $k) {
            if (!in_array($k, $tree::$result)) {
                //$tree::$result[] = $k;
                 echo $k;
                $islands[] = $k;
            }
        }
        $answer = [];
        
    // array_push($islands, $tree::$result);
    // $tree::$result = $islands;
        foreach ($tree::$result as $number) {
            $islands[] = $number;
        }
        return $islands;
        
        // $tree::$result = $islands;
        // return $tree::$result;
    }
}


class Tree {
    /**
    * Node $root
    */
    protected $root = null;
    
    public static $nodeValues = [];

    public static $result = [];
    
    public static $impossible = false;
    
    public function insert($childIndex, $parentIndex) {
        if ($this->root === null) {
            $this->root = new Node($parentIndex, new Node($childIndex));
            self::$nodeValues[] = $parentIndex;
            self::$nodeValues[] = $childIndex;
        } else {
            if (!$this->nodeExists($parentIndex)) {
                new Node($parentIndex, new Node($childIndex));
                self::$nodeValues[] = $parentIndex;
                self::$nodeValues[] = $childIndex;
            } else {
                $new = $this->getNode($parentIndex);
                if ($new !== null) {
                    $new->addChild($childIndex);
                }
            }
        }
    }
    
    protected function getNode($nodeValue) {
        return $this->bfs($nodeValue);
    }
     
    protected function nodeExists($value) {
        foreach (self::$nodeValues as $nodeValue) {
            if ($nodeValue === $value){
                return true;
            }
        }
        return false;
    }
    
    public function bfs($nodeValue) {
        if ($this->root->value === $nodeValue) {
            return $this->root;
        }
        
        return $this->root->bfs($nodeValue);
    }
    
    public function printBfs() {
        self::$result[] = $this->root->value;
        $this->root->printBfs();
    }
}

class Node {
    /**
    * array[Node] $children
    */
    protected $children = [];
    
    protected $childrenValues = [];
    
    public $value = null;
    
    public function __construct($value, $child = null) {
        $this->value = $value;
        if ($child !== null) {
            $this->children[] = $child;
        }
    }

    public function addChild($childIndex) {
        if ( in_array($childIndex, (new Tree())::$nodeValues) ) {
            (new Tree())::$impossible = true;
        }
        
        if (!$this->childExists($childIndex)) {
            $this->children[] = new Node($childIndex);
        }
    }
    
    protected function childExists($childIndex) {
        if (in_array($childIndex, $this->childrenValues)) {
            return true;
        }
        return false;
    }
    
    public function bfs($nodeValue) {
        foreach ($this->children as $child) {
            if ($child->value === $nodeValue) {
                return $child;
            }
        }
        
        foreach ($this->children as $child) {
            return $child->bfs($nodeValue);
        }
    }
    
    public function printBfs() {            
        foreach ($this->children as $child) {
            (new Tree)::$result[] = $child->value;
        }
        
        foreach ($this->children as $child) {
            $child->printBfs();
        }
    }
}