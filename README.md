# Sistema de Gestão de vidas

Neste projeto construí um sistema de gerenciamento cadastro de usuários, a aplicação foi construída em PHP utilizando Session como autenticação, MYSQL como banco de dados, e sua
comunicação com PDO.

É possível criar um cadastrar na área cadastro, logar com usuário e senha na área login, e 
então após a autenticação se entra na área protegida na qual é possível visualizar os registros
de todos os pacientes já cadastrados, podendo alterar o cadastro de cada um ou excluir, no fim da página tem um botão de redirecionamento que leva para área de importação, que é possível 
adicionar ao registro novos pacientes digitando cada campo, ou fazer um upload de exceção txt
no formatação exemplificada no arquivo "Exemplo.txt" com mais de um paciente.

Na área de usuário é possível alterar os dados de cadastro do usuário logado e por fim o ícone
"sair" no menu encerra a sessão e o redireciona para pagina de login.