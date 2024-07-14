<?php
echo("Entrou na Processar_livro");
echo("---");
class Livro {
    public $id;
    public $titulo;
    public $genero;
    public $qtd_paginas;

    public function __construct($id, $titulo, $genero, $qtd_paginas) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->genero = $genero;
        $this->qtd_paginas = $qtd_paginas;
        echo("$id");
        echo("---");
        echo("$titulo");
        echo("---");
        echo("$genero");
        echo("---");
        echo("$qtd_paginas");
        echo("---");
    }
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $id = $_POST["id"];
    echo("Dentro do if POST");
    echo("---");
    echo("id");
    echo("---");
    $titulo = $_POST["titulo"];
    echo("$titulo");
    echo("---");
    $genero = $_POST["genero"];
    echo("$genero");
    echo("---");
    $qtd_paginas = $_POST["qtd_paginas"];
    echo("$qtd_paginas");
    echo("---");

    // Cria um objeto Livro
    $livro = new Livro($id, $titulo, $genero, $qtd_paginas);

    // Chama a função alterar_livro
    echo("Antes de chamar a função alterar_livro");
    alterar_livro($livro);
}

function alterar_livro($livro) {
    echo("Dentro da função alterar_livro");
    echo("$livro");
    // Aqui você pode implementar a lógica para alterar o livro
    // Por exemplo, você pode armazenar os dados em um banco de dados

    // Exemplo de saída
    echo "Livro alterado com sucesso!";
}
?>
