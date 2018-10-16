<?php

/**
 * @param $id
 * @param $types
 * @return mixed
 * @throws Exception
 */
function getSets($id, $types)
{
    $base = count($types);
    if ($base > 10) throw new Exception('Нужно реализовать словарь символов');

    $convertedNumber = base_convert($id, 10, $base);
    $baseString = str_pad($convertedNumber, 8, '0', STR_PAD_LEFT);

    return str_split(str_replace(array_keys($types), $types, $baseString));
}

/**
 * @param $num
 * @return string
 * @throws Exception
 */
function getResult($num)
{
    $values = ['+', '-', '/', '*'];
    $digits = [1, 2, 3, 4, 5, 6, 7, 8, 9];

    for ($i = 0; $i < 65536; $i++) {
        $rt = getSets($i, $values);
        $preEvals = $digits[0] . $rt[0] .
                    $digits[1] . $rt[1] .
                    $digits[2] . $rt[2] .
                    $digits[3] . $rt[3] .
                    $digits[4] . $rt[4] .
                    $digits[5] . $rt[5] .
                    $digits[6] . $rt[6] .
                    $digits[7] . $rt[7] .
                    $digits[8];

        $str = "return " . $preEvals . ";";

        if(eval($str) == $num){
            return " \n Сочетание арифметических знаков и упорядоченных чисел от 1 до 9 вернёт $num возможно в следующей комбинации: " .
                $preEvals . " \n";
        }

    }

    return "Проблема актуальна для знаков +,-,*,/ . \n";
}

echo getResult(10598); // Указать можно любое число

