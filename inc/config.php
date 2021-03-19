<?php

/**
 * Script config.php
 * @author Michel Miléski
 * @version 0.1
 * 
 * Script de configuração de parametros
 */

define("DB_HOST","db");
define("DB_USER","cliente");
define("DB_PASS","cliente");
define("DB_BASE","cliente");

// definição de erros
$arrayCodes[404]= "Desculpe, seus dados de acesso estão incorretos, tente novamente.";

define("ERROR_CODE", $arrayCodes);

?>