<?php

/**
 * 
 * 
 * Considerando o trecho de um texto extraído de uma página de pesquisa de vôos:
 * "Melhor preço sem escalas R$ 1.367(1)
 * Melhor preço com escalas R$ 994 (1)
 * 
 * 1 - Incluindo todas as taxas."
 * 
 * Escreva uma expressão regular para localizar o melhor preço com ou sem escalas, depois utilize sua 
 * expressão para extrair a string correspondente ao valor escolhido e em seguida converta o resultado em 
 * valor decimal (float) de forma que tenhamos apenas "1367.00" ou "994.00" . 
 * Dica: Se necessário, utilize o site https://regex101.com/ para testar a sua expressão.
 * 
 */

$pattern = '/(R\$\ )([0-9]+.?([0-9]+)?)(\([0-9]{1,2}\))/';

// Try it

$text = 'Melhor preço sem escalas R$ 1.367(1) Melhor preço com escalas R$ 994 (1) 1 - Incluindo todas as taxas.';
$text = 'Melhor preço sem escalas R$ 1.367(1) Melhor preço com escalas R$ 2.994 (1) 1 - Incluindo todas as taxas.';
$text = 'Melhor preço sem escalas R$ 1.367(1) Melhor preço com escalas R$ 2.994 (1) Outra passagem com escalas R$ 599 (1) 1 - Incluindo todas as taxas.';

preg_match_all($pattern, $text, $matches);

if (isset($matches[2])) :

    $matches = $matches[2];
    $values = [];

    $total_matches = count($matches);
    for ($i=0;$i<$total_matches;++$i) {
        $values[] = preg_replace('/\D/', '', $matches[$i]);
    }

    $lower_price = min($values);
    $lower_price = number_format($lower_price, 2, '.', '');

    print_r($lower_price);

endif;

?>

<p>
    File: question3.php
</p>

<a href="javascript:history.back()">&laquo; back to index</a>