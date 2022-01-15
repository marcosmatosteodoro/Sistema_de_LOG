<?php
session_start();

session_unset();
session_abort();
echo "Sua sessão foi fechada";

?>