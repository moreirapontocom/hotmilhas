<?php

/**
 * 
 * Escreva uma função que receba como parâmetros os coeficientes de uma equação de segundo grau e retorne suas raízes.
 * 
 */

/**
 * Second degree equation is formed by ax² + bx + c = 0, 
 * where a, b and c are coeficients.
 * Bhaskara method
 * Reference: https://brasilescola.uol.com.br/matematica/equacao-2-grau.htm
 */

function getResultsOfBhaskaraMethod($a, $b, $c)
{
    // ax² + bx + c = 0
    // ∆ = b² - 4.a.c

    $delta = $b ** 2 - 4 * $a * $c;

    // Bhaskara method
    // x = – b ± √∆
    // ------------
    //     2∙a

    $x1 = (-$b + sqrt($delta)) / (2 * $a);
    $x2 = (-$b - sqrt($delta)) / (2 * $a);

    $coeficients = 'Given coeficients: <pre>a = ' . $a . ', b = ' . $b . ', c = ' . $c . '</pre>';
    $msg = 'The equation <pre>ax² + bx + c = 0</pre> is satisfied when <pre>x1 = ' . $x1 . '</pre> and <pre>x2 = ' . $x2 . '</pre>';

    return $coeficients . '<br>' . $msg;
}

echo getResultsOfBhaskaraMethod(1, -2, -3);
?>

<p>
    File: question1.php
</p>

<a href="javascript:history.back()">&laquo; back to index</a>