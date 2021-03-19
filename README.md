
# provaServicetrix

  

**Descrição e Requisitos da Prova:**  

1. Você deverá criar pelo menos uma tabela para controle de usuário e senha;

2. Você deverá gerar (você mesmo) o código PHP;

3. Você deverá criar uma tela de login usando bootstrap (usuário e senha apenas) - quer deixar mais bonito? Acharemos fantástico;

4. Os campos precisam estar validados da seguinte forma: login deve ser um e-mail válido e senha deve ter pelo menos 6 caracteres (para a senha é necessário que existam letras e números no conjunto);

5. Validação do login ou mensagem de erro - se o login ocorrer deverá redirecionar para uma página com a mensagem "Ok estou logado" e ao lado um link para deslogar (deslogar deve ser funcional);

6. O código deve ser comentado para que entendamos mais facilmente como você chegou até esse código;

7. Programe da forma que achar melhor! É claro que valorizamos boas práticas, mas queremos saber como você faz e o motivo que fez assim;

<br>
<br>

# Script SQL para criação do BD

Você necessitará criar um banco de dados mySQL e rodar o comando abaixo para criar a tabela de usuários, este script incluí um usuário de teste com as informações de login:

  

**email**: usuario@usuario.com.br

**senha**: senha123

> **Importante** Caso seja de interesse criar um novo usuário, a senha esta encriptada com MD5  

```sql
CREATE  TABLE  `cad_usuarios` (
`id`  int  NOT  NULL,
`nome`  varchar(100) NOT  NULL,
`email`  varchar(100) NOT  NULL,
`senha`  varchar(255) NOT  NULL,
`status`  tinyint(1) NOT  NULL,
`token`  varchar(255) CHARACTER  SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT  NULL
) ENGINE=InnoDB DEFAULT  CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT  INTO  `cad_usuarios` (`id`, `nome`, `email`, `senha`, `status`, `token`) VALUES
(1, 'Usuário 01', 'usuario@usuario.com.br', 'e7d80ffeefa212b7c5c55700e4f7193e', 1, '12021f687bcdd8edf5e452ad55cf6f08');

ALTER  TABLE  `cad_usuarios` ADD  PRIMARY  KEY (`id`);

ALTER  TABLE  `cad_usuarios` MODIFY  `id`  int  NOT  NULL  AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
```