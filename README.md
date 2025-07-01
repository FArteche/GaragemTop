# Sistema de Gerenciamento de Veículos (Garagem Top)

Este é um sistema web completo para a exibição e gerenciamento de um catálogo de veículos. Construído com PHP puro e um banco de dados relacional (MySQL), o sistema é dividido em uma vitrine pública para visitantes e um painel administrativo seguro para gerenciamento de conteúdo.

## ✨ Funcionalidades

###  Área Pública (Frontend)
-   **Navegação por Categorias:** O menu de navegação é gerado dinamicamente a partir das categorias cadastradas no banco de dados.
-   **Listagem de Veículos:** Visualize os veículos agrupados por categoria.
-   **Busca Inteligente:** Pesquise veículos por modelo ou por ano de fabricação.
-   **Página de Detalhes:** Veja todas as informações, descrição e imagem de um veículo específico.
-   **Design Responsivo:** A interface se adapta perfeitamente a desktops, tablets e celulares, graças ao Bootstrap 5.

### Área Administrativa (Backend)
-   **Autenticação Segura:** Acesso ao painel protegido por e-mail e senha, com as senhas armazenadas de forma segura (hash).
-   **Dashboard:** Uma tela inicial com um resumo do conteúdo cadastrado.
-   **Gerenciamento de Veículos (CRUD):** Adicione, edite e exclua veículos do catálogo.
-   **Gerenciamento de Categorias (CRUD):** Adicione, edite e exclua as categorias dos veículos.
-   **Upload de Imagens:** Sistema de upload de imagem para cada veículo.
-   **UX Melhorada:** Notificações "toast" para feedback de ações (sucesso, erro) e um modal de confirmação para exclusões, evitando ações acidentais.

## 🚀 Tecnologias Utilizadas
-   **Backend:** PHP 8+
-   **Banco de Dados:** MySQL 
-   **Frontend:** HTML5, CSS3, JavaScript (ES6)
-   **Framework CSS:** Bootstrap 5
-   **Ambiente de Desenvolvimento:** XAMPP / WAMP / MAMP

## ⚙️ Como Executar o Projeto

Siga os passos abaixo para rodar o projeto em seu ambiente local.

1.  **Pré-requisitos:**
    -   Ter um ambiente de servidor local como XAMPP ou WAMP instalado.
    -   Ter acesso a um gerenciador de banco de dados como o phpMyAdmin.

2.  **Clone ou Baixe o Projeto:**
    -   Coloque a pasta do projeto dentro do diretório raiz do seu servidor web (ex: `C:/xampp/htdocs/`).

3.  **Banco de Dados:**
    -   Abra o phpMyAdmin e crie um novo banco de dados (ex: `garagem_db`).
    -   Importe ou execute o script SQL `db_veiculosys.sql` encontrado na raiz do projeto.
    -   O script já possui inserts.

4.  **Configuração:**
    -   Abra o arquivo `/includes/conexao.php`.
    -   Altere as variáveis `$db`, `$user` e `$pass` com as informações do seu banco de dados.

5.  **Criação do Usuário Admin:**
    -   Acesse o script `cria_usuario.php` em seu navegador (ex: `http://localhost/veiculosys/cria_usuario.php`).
    -   Isso criará um usuário padrão (`admin@admin.com` | senha: `123456`).
    -   Apague o arquivo `cria_usuario.php` após a execução por motivos de segurança.

6.  **Acesso ao Sistema:**
    -   **Site Público:** Acesse `http://localhost/veiculosys/index.php`.
    -   **Painel Admin:** Acesse `http://localhost/veiculosys/admin/login.php`.
