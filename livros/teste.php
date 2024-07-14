<?php
// Conexão com o banco de dados (substitua pelos seus próprios dados)
$servername = 'localhost';
$username = 'silvano';
$password = "ze5600";
$dbname = "banco_pos";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o ID foi passado via URL
if(isset($_GET['id'])) {
    // Obtém o ID da URL e previne contra SQL injection
    $livro_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Query para buscar o livro no banco de dados
    $sql = "SELECT * FROM livros WHERE id = $livro_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Exibe os dados do livro em inputs HTML
        $livro = $result->fetch_assoc();
?>
        <html>
            <body>
                <h2>Detalhes do Livro</h2>
                <form>
                    ID: <input type="text" value="<?php echo $livro['id']; ?>"><br>
                    Título: <input type="text" value="<?php echo $livro['titulo']; ?>"><br>
                    Gênero: 
                    <select name="genero">
                        <option value="A" <?php echo ($livro['genero'] == 'A') ? 'selected' : ''; ?>>Ação</option>
                        <option value="C" <?php echo ($livro['genero'] == 'C') ? 'selected' : ''; ?>>Comédia</option>
                        <option value="D" <?php echo ($livro['genero'] == 'D') ? 'selected' : ''; ?>>Drama</option>
                        <option value="F" <?php echo ($livro['genero'] == 'F') ? 'selected' : ''; ?>>Ficção</option>
                        <option value="R" <?php echo ($livro['genero'] == 'R') ? 'selected' : ''; ?>>Romance</option>
                        <option value="O" <?php echo ($livro['genero'] == 'O') ? 'selected' : ''; ?>>Outro</option>
                    </select><br>
                    Núm Pá: <input type="number" value="<?php echo $livro['qtd_paginas']; ?>"><br>
                </form>
            </body>
        </html>
<?php
    } else {
        echo "Nenhum livro encontrado com esse ID.";
    }
} else {
    echo "ID do livro não especificado na URL.";
}

$conn->close();
?>
