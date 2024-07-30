<?php
    $name = 'fedor'; // string
    $age = 81; // integer
    $isMarried = true; // boolean
    $capital = 6; // float
    echo "his name is $name and he is $age years old".PHP_EOL;

    // Посмотреть булеву алгебру AND, OR, NOT, XOR
    if($isMarried) {
        echo "and he is also married".PHP_EOL;
    } else {
        echo "and he is not married".PHP_EOL;
    }

    if($capital > 0 && $capital <= 1) {
        echo "and he is broke".PHP_EOL;
    } else if ($capital > 1 && $capital <= 5){
        echo "and he is poor guy".PHP_EOL;
    } else {
        echo "and he is rich".PHP_EOL;
    }

//    $colors = ['red', 'green', 'blue'];
//    $colors = [0 => 'red', 1 => 'green', 2 => 'blue'];
//    for($i = 0; $i < count($colors); $i++){
//        echo "$i) $colors[$i]".PHP_EOL;
//    }

    $colors = ['red' => '#123', 'green' => '#456', 'blue' => '#789'];
    foreach ($colors as $color => $colorCode){
        echo $color.'|'.$colorCode.PHP_EOL;
    }

    $a = 5; $b = 6; $c = $a + $b; // + - * /
    $a += 7; // $a = $a + 7
    $s = 'hello';
    $s .= ' world';  // $s = hello world

    function doSomething(int $a, int $b): int
    {
        $sum = $a + $b;
        $mult = $a * $b;
        echo "SUM: $sum | MULT: $mult".PHP_EOL;
       return $sum;
    }
    $sum1 = doSomething(10, 11);
    $sum2 = doSomething(5, 6);
    $sum3 = doSomething(7, 8);
