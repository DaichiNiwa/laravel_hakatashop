<?php 

$a = array(1, 2, 3, 4, 5);

// var_dump(array_reduce($a, function($carry, $item){
//   var_dump($carry);
//   $carry += $item;
//     return $carry;
// }, 100)); // int(15)

var_dump(array_map(function($item){
  // var_dump($carry);
    return $item * 2;
}, $a)); // int(15)
