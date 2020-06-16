/*
https://leetcode.com/explore/featured/card/30-day-leetcoding-challenge/528/week-1/3289/

Counting Elements
Given an integer array arr, count element x such that x + 1 is also in arr.
If there're duplicates in arr, count them seperately.
*/

//Javascript solution. Notice the function for sorting numeric arrays.

/** 22:59 - 23:32
 * @param {number[]} arr
 * @return {number}
 */
var countElements = function(arr) {
    //[1,1,2,3] //res=3
    var res = 0;
    arr.sort(sortNumber);
    console.log(arr);
    var multi = 1;
    
    for (var i=0; i<arr.length-1; i++) {
        if (arr[i] === arr[i+1]) {
            multi++;
        } else if (arr[i] + 1 === arr[i+1]) {
            res += multi;
            multi = 1;
        } else {
            multi = 1;
        }
    }

    return res;
};

function sortNumber(a, b) {
  return a - b;
}


/* Test cases
[4,10,11,11,1,9,6,2,4,5,8]
[2,9,0,7,6,2,7,7,0]
[1,2,3]
[1,1,3,3,5,5,7,7]
[1,3,2,3,5,0]
[1,1,2,2]
*/