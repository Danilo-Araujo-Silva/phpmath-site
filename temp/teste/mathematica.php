<?php
function execute($comando) {
    echo "
        Comando completo: $comando
        <br>
        Saída:
        <br>
        <pre>
    ";
    $saida = exec($comando, $volta, $retorno);
    print_r($saida);
    print_r($volta);
    print_r($retorno);
    echo "
        </pre>
    ";
}

execute("ls");
//execute("Mathematica");
//execute("/usr/local/bin/Mathematica");
execute("/usr/bin/kate");
execute("MathKernel");
execute("run");