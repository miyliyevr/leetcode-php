<?php
/*
https://leetcode.com/problems/min-stack/
Design a stack that supports push, pop, top, and retrieving the minimum element in constant time.

push(x) -- Push element x onto stack.
pop() -- Removes the element on top of the stack.
top() -- Get the top element.
getMin() -- Retrieve the minimum element in the stack.
*/

/** 13:50 - 14:17
 * Your MinStack object will be instantiated and called as such:
 * $obj = MinStack();
 * $obj->push($x);
 * $obj->pop();
 * $ret_3 = $obj->top();
 * $ret_4 = $obj->getMin();
 */
 class MinStack {
    protected $stack = [];
    /**
     * initialize your data structure here.
     */
    function __construct() {
    }
  
    /**
     * @param Integer $x
     * @return NULL
     */
    function push($x) {
        $this->stack[] = $x;
    }
  
    /**
     * @return NULL
     */
    function pop() {
        if ($this->isEmpty()) {
            return null;
        }
        
        array_pop($this->stack);
    }
  
    /**
     * @return Integer
     */
    function top() {
        if ($this->isEmpty()) {
            return;
        }
        
        return end($this->stack);
    }
  
    /**
     * @return Integer
     */
    function getMin() {
        if (!$this->isEmpty()) {
            $min = $this->stack[0];
        } else {
            $min = null;
        }
        
        for($i = 0; $i < count($this->stack); $i++) {
            $min = min($min, $this->stack[$i]);
        }
        
        return $min;
    }
    
    function isEmpty() {
        $count = count($this->stack);
        if ($count == 0) {
            return true;
        } else {
            return false;
        }
    }
}



/*Test cases
["MinStack","push","push","push","getMin","pop","top","getMin"]
[[],[-2],[0],[-3],[],[],[],[]]
["MinStack","push","top","getMin"]
[[],[-1],[],[]]