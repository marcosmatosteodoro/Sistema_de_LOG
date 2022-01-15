<?php
require_once "Vendor/config/session.php";
session_start();

echo "Estou em Dashboard";

?>

<a href="Vendor/dashboard/Importacao.php"><button type="submit">Importação</button></a>
<a href="Vendor/dashboard/vizualizacao.php"><button type="submit">Vizualização</button></a>
<a href="Vendor/dashboard/sair.php"><button type="submit">sair</button></a>