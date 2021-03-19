<?php
/**
 * Script common.php
 * @author Michel Miléski
 * @version 0.1
 * 
 * Agrupador de funções a serem executadas e reutilizadas
 */

session_start();

require_once("./inc/config.php");

/**
 * getParam function
 *
 * @param string $param
 * @param string $method (GET, POST, FILES)
 * @return mixed
 * 
 * Função para resgatar informações das variáveis $_GET, $_POST e $_FILES
 */
function getParam(string $param, string $method="") {
    if($method != "") {
        if($method == "FILES") {
            if($_FILES[$name] != "") {
                $out = $_FILES[$name];
            }
		} elseif($method == "POST") {
            if($_POST[$param] != "") {
                $out = trim(addslashes($_POST[$param]));
            }
        } elseif($method == "GET") {
            if($_GET[$param] != "") {
                $out = trim(addslashes($_GET[$param]));
            }
        }
    } else {
        if($_POST[$param] != "") {
            $out = trim(addslashes($_POST[$param]));
        } elseif($_GET[$param] != "") {
            $out = trim(addslashes($_GET[$param]));
        }
    }
    return $out;
}

/**
 * setSession function
 *
 * @param string $name
 * @param string $value
 * @return void
 * 
 * Função responsável por definir uma sesseion
 */
function setSession(string $name, string $value) {
    $_SESSION[$name] = $value;
}

/**
 * Undocumented function
 *
 * @param string $name
 * @return mixed
 * 
 * Função responsável por resgatar uma session
 */
function getSession(string $name) {
    return $_SESSION[$name];
}

/**
 * clearSession function
 *
 * @param string $name
 * @return void
 * 
 * Função responsável por destruir uma session
 */
function clearSession(string $name) {
    setSession($name, "");
    session_destroy();
    unset($_SESSION[$name]);
}

/**
 * token function
 *
 * @return void
 * 
 * Função geradora de TOKENs com base no uniqueid
 */
function token() {
    return md5(uniqid(rand(), true));
}

/**
 * redirect function
 *
 * @param string $url
 * @param string $parametros
 * @return void
 * 
 * Função responsável pelo redirecionamentro de uma página via JS
 */
function redirect($url="volta", $parametros="") {
    if($url == "volta") {
        $url = $_SERVER[HTTP_REFERER];
    }
    if($parametros != "") {
        $parametros = "?".$parametros;
    }
    echo "
        <script>
            window.location = '".$url.$parametros."';
        </script>
    ";
    die();
}

/**
 * getError function
 *
 * @param integer $error_code
 * @return void
 * 
 * Função que retorna as mensagems de erro com base na configuração prévia do sistema
 */
function getError(int $error_code) {
    if($error_code) {
        if(array_key_exists($error_code, ERROR_CODE)) {
            return ERROR_CODE[$error_code];
        }
    }
}

/**
 * checkLoginPresence function
 *
 * @return void
 * 
 * Função para checagem de presença no sistema
 */
function checkLoginPresence() {
    // checar se o usuário esta conectado na session
    $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_BASE, DB_USER,DB_PASS) or print (mysql_error());
    $token = getSession("token");
    $error = true;

    $sql = "
        SELECT
            id
        FROM
            cad_usuarios
        WHERE
            token = '".$token."'
        AND status = 1";
    foreach ($conn->query($sql) as $row) {
        $error = false;
        setSession("token",$token);
    }

    if($error == true) {
        clearSession("token");
        redirect("formLogin.php?msgErro=405");
    }
}

?>