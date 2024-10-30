<?php

function mo($name)
{
    echo "Hello ," . $name;
}

mo("programmer");
echo "<br>" . "<hr>";
//===========
$x = 0;
function sum($num1, $num2)
{
    echo "$num1+$num2 = " . $num1 + $num2 . "<br>";
    echo "$num1*$num2 = " . $num1 * $num2 . "<br>";
    echo "$num1-$num2 = " . $num1 - $num2 . "<br>";
}
sum(5, 10);

//========

echo "<br>" . "<hr>";

function ope($a, $b, $c, $d)
{
    $x = ($a * $b) - ($c * $d);
    echo $x;
}
ope(1, 2, 3, 4);

//======

echo "<br>" . "<hr>";


function _3($n1, $n2)
{
    for ($i = 0; $i < strlen($n1); $i++) {
        $number1 = $n1 % 10;
    }
    for ($j = 0; $j < strlen($n2); $j++) {
        $number2 = $n2 % 10;
    }
    echo $number1 + $number2;
}

_3(13, 12);
//========

echo "<br>" . "<hr>";

function _4($num1)
{

    while ($num1 >= 10) {

        $num1 = $num1 / 10;
    }
    $count1 = $num1;



    if ($count1 % 2 == 0) {
        echo "EVEN";
    } else {
        echo "ODD";
    }
}
_4(4569);

//==========
echo "<br>" . "<hr>";

echo "مساء الفل يا بشمهندسة بجرب update بس";
