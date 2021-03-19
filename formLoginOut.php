<?php

/**
 * Script formLoginOut.php
 * @author Michel Miléski
 * @version 0.1
 * 
 * Script para deslogar o sistema
 */

require_once("./inc/common.php");

clearSession("token");
redirect("formLogin.php");

?>