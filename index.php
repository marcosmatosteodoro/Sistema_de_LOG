<?php
/*
Faça um dump do arquivo bdusuario.sql no seu MYSQL, que criará no seu banco de dados uma SCHEMA
 "bdusuario" e duas tabelas "cadastro" e "pacientes" respectivamente  com alguns INSERTs de 
 dados.
Caso seu usuário do MYSQL não seja 'root' e senha não seja '' (vazio), altere as variáveis 
"$user" e "$senha" nos arquivos bd_pacientes e bd_usuarios no caminho Vendor/config.
Se seguido os passos acima, na tela visualização terá dados de 4 pacientes e um usuário já 
cadastrato 'root' com senha 'root'.
É possível cadastrar pacientes em importações preenchendo os termos do cadastro, ou carregando 
um arquivo txt no formato do arquivo 'Exemplo.txt'
*/
if(isset($_GET['p'])){
    $paginas = $_GET['p'];
} else{
    $paginas = null;
}

switch($paginas){
    case "cadastro":
    $pagina = "log/cadastro.php";
    $titulo = "Cadastro";
    $nav = '_navLog';
    break;

    case 'login':
    $pagina = "log/login.php";
    $titulo = "Login";
    $nav = '_navLog';
    break;

    case 'visualizacao':
    $pagina = "dashboard/visualizacao.php";
    $titulo = "Visualização";
    $nav = '_navDashboard';
    break;

    case 'importacao':
    $pagina = "dashboard/importacao.php";
    $titulo = "Importação";
    $nav = '_navDashboard';
    break;

    case 'alterarcadastro':
      $pagina = "dashboard/alterarcadastro.php";
      $titulo = "Importação";
      $nav = '_navDashboard';
      break;

    case "sair":
      $pagina = "dashboard/sair.php";
      $titulo = "Sair";
      $nav = '_navLog';
      break;

    default:
    $pagina = "log/login.php";
    $titulo = "Login";
    $nav = '_navLog';
    break;
}
function mensagem($message, $cor){
  if($cor == 'sucesso'){
    $cor = 'rgb(56, 255, 162)';
    require_once "Vendor/parciais/message.html";
  }else{
    $cor = 'rgb(255, 100, 100)';
    require_once "Vendor/parciais/message.html";

  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $titulo; ?></title>
    <?php require_once "Vendor/parciais/_head.html"; ?>
  <head>

<body style="background-color: rgb(190,255,255); background-image: url('Vendor/img.jpg'); background-size: 100%;">

<header style="width: 100%;">
  <?php require_once "Vendor/parciais/$nav.html"; ?>
</header>
<?php 

require_once "Vendor/$pagina"; ?>

</body>
</html>