<?php

/**
 * Script formLoginCheck.php
 * @author Michel Miléski
 * @version 0.1
 * 
 * Responsável pela validação do usuário ao entrar no sistema
 */

require_once("./inc/common.php");

// conectar ao banco de dados via PDO
$conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_BASE, DB_USER,DB_PASS) or print (mysql_error());

// resgatar as informações de preenchimento do formulário
$n_email = getParam("n_email", "POST");
$n_senha = md5(getParam("n_senha", "POST"));

$error = false;

// criamos a consulta ao banco de dados
$sql = "
    SELECT
        id,
        senha
    FROM
        cad_usuarios
    WHERE
        status = 1
    AND email = :email
";

// preparamos a consulta
$query = $conn->prepare($sql);
$query->bindValue(':email', $n_email);
$query->execute();

if($query->rowCount() > 0) {
    while ($row = $query->fetchAll()) {
        // agora faremos o teste de senha via PHP
        if($row[0]["senha"] == $n_senha) {
            // criamos um token e definimos no BD para futuras validações
            $token = token();

            $sql_token = "UPDATE cad_usuarios SET token = :token WHERE id = :id LIMIT 1";
            $query_token = $conn->prepare($sql_token);
            $query_token->bindValue(':token', $token);
            $query_token->bindValue(':id', $row[0]["id"]);
            $query_token->execute();

            setSession("token", $token);
            redirect("index.php");
        } else {
            $error = true;
        }
    }
} else {
    $error = true;
}

// Dados de login incorretos
if($error == true) {
    redirect("formLogin.php?msgErro=404");
}

?>