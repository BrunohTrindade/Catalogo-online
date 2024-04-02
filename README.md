# Catálogo Online 🛒📦

### Tecnologias Utilizadas
- **Linguagens:** 
  ![PHP](https://img.shields.io/badge/-PHP-777BB4?style=flat-square&logo=php&logoColor=white) 
  ![JavaScript](https://img.shields.io/badge/-JavaScript-F7DF1E?style=flat-square&logo=javascript&logoColor=black) 
  ![HTML](https://img.shields.io/badge/-HTML-E34F26?style=flat-square&logo=html5&logoColor=white) 
  ![CSS](https://img.shields.io/badge/-CSS-1572B6?style=flat-square&logo=css3&logoColor=white)
- **Frameworks:** Bootstrap para o design responsivo
- **Banco de Dados:** MySQL
- **Padrões de Projeto:** MVC (Model-View-Controller)
- **Gerenciador de Pacotes:** Composer
- Com o padrão MVC, foi abordado um **sistema de rotas**.

### Templates Utilizados
- **Catálogo:** [![Template Colorlib](https://img.shields.io/badge/Template-Colorlib-blue?style=flat-square&logo=visual-studio-code)](https://colorlib.com/)
- **Dashboard do Administrador:** [![AdminLTE](https://img.shields.io/badge/AdminLTE-Admin%20Dashboard-blue?style=flat-square&logo=visual-studio-code)](https://adminlte.io/)


-----

### Funcionalidades 💡
- O Catálogo Online é um projeto desenvolvido para facilitar a visualização e gestão de produtos em uma loja virtual.
- Composto de um painel administrativo onde faz o cadastro, alterações e exclusão dos produtos e categorias. 
- Também traz a listagem dos produtos e suas categorias.
- Fornece uma plataforma onde os usuários podem se cadastrar e adicionar e remover produtos no carrinho e ao clicar em finalizar a compra é redirecionado para o WhatsApp com a lista dos produtos e valores dos produtos que estão no carrinho.

## Administrador 👩‍💼👨‍💼
- Controla todos os produtos, adicionando, editando e removendo e relaciona com a categoria adequada;
- Adiciona e altera os dados do produto, dimensões, peso e imagens;
- Controla todas as categorias adicionando, editando e removendo;
- Adiciona e altera nome e descrição das categorias.

### Usuário 👥
- Se registra;
- Faz Login;
- Adiciona e remove os produtos, bem como a quantidade, ao carrinho;
- Cadastra seus dados pessoais como endereço e CPF;
- O sistema permite ter mais de um endereço;
- O motivo do cadastro dos dados pessoais é a possível futura integração com finalização de pagamento na própria plataforma;
- Trocar senha;
- Esqueceu a senha;
- Faz comentários nos produtos.
-----

### Capturas de Tela 🖼️
![Página Inicial](screenshot_home.png)
![Painel Administrativo](screenshot_admin.png)

-----

### Guia _simples_ para backup do banco de dados MYSQL
1. Faça o download do arquivo de backup do banco de dados *MYSQL*: [database_backup.sql](database_backup/database_backup.sql) (contém a estrutura e dados para teste).
2. Faça o import para o SGBD da sua máquina.
-----

### Guia para instalação do projeto no XAMPP

#### Passo 1: Clone do Repositório
- Abra o terminal ou prompt de comando.
- Navegue até a pasta `htdocs` do seu XAMPP (normalmente localizada em `C:\xampp\htdocs`).
- Execute o seguinte comando para clonar o repositório:

```bash
git clone https://github.com/BrunohTrindade/Catalogo-online
```
#### Passo 2: Configuração do Banco de Dados
Abra o phpMyAdmin no seu navegador ou SGBD Mysql
Crie um novo banco de dados com o nome desejado para o seu projeto.
Importe o arquivo de backup para o banco de dados recém-criado.

#### Passo 3: Configuração do Ambiente
- Abra o arquivo de configuração do seu projeto, que está em: `C:\xampp\htdocs\Catalogo-online\core\Config.php`.
- Atualize as configurações do banco de dados com o nome do banco de dados, nome de usuário e senha (se necessário).

```php
//Credenciais Banco de Dados
define('HOST', 'localhost');
define('USER', 'seu_usuario');
define('PASS', 'sua_senha');
define('DBNAME', 'seu_banco_de_dados');
define('PORT', 3307);
```
#### Passo 4: Acesso ao Projeto

- Abra o seu navegador.
- Digite http://localhost/Catalogo-online na barra de endereços.
O seu projeto deve estar agora acessível e pronto para uso.

-----
### Considerações Finais 🌟

Obrigado por ler até aqui, e espero que este projeto seja útil para você! 😊
