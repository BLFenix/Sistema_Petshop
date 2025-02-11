# Sistema de Petshop

![Status do Projeto](https://img.shields.io/badge/Status-Em%20Desenvolvimento-blue?style=for-the-badge&logo=github&logoColor=white&color=blue&labelColor=black)
![Linguagens](https://img.shields.io/badge/Linguagens-JS%20|%20PHP%20|%20HTML5%20|%20CSS3-informational?style=for-the-badge&color=purple&labelColor=black)
![Tamanho do Repositório](https://img.shields.io/badge/Tamanho%20do%20Repositório-2.3%20MB-success?style=for-the-badge&color=green&labelColor=black)

> Sistema de gestão para petshops, focado no cadastro de clientes, seus animais, serviços e compra desses serviços, destinado a administradores e secretárias.

## Funcionalidades

Possibilita todas as ações de um funcionário de um petshop, desde seu login com senha, até mesmo os atos restritos a apenas essa parcela de usuários.

1. **Cadastro de Clientes:**
   - O administrador pode cadastrar novos clientes.
   - O cliente pode incluir informações como nome, CPF, telefone e e-mail.

2. **Cadastro de Animais:**
   - Para cada cliente, é possível cadastrar seus animais, com detalhes como nome, espécie, raça, idade, entre outros.

3. **Cadastro de Serviços:**
   - O sistema permite o cadastro de serviços oferecidos pelo petshop (banho, tosa, consulta veterinária, etc.), com preço e descrição.

4. **Compra de Serviços:**
   - O cliente pode escolher os serviços para seu(s) animal(is) e realizar a compra, com geração de registro de atendimento.

## 💻 Pré-requisitos

Antes de começar, verifique se você atendeu aos seguintes requisitos:

- Você tem um servidor local (ex: XAMPP, WAMP) ou ambiente PHP configurado.
- Você tem um navegador atualizado.
- Você tem acesso ao banco de dados (MySQL recomendado).

## 🚀 Instalando o Sistema de Petshop

Para instalar o sistema, siga estas etapas:

### 1. Clonando o repositório:

git clone https://github.com/BLFenix/Sistema_Petshop.git


### 2. Configurando o Banco de Dados:

Crie um banco de dados no seu servidor MySQL com a estrutura do arquivo encontra:

Sistema_Petshop/BD/CriaçãoDoBD.sql

### 3. Configurando o ambiente:

1. Crie um arquivo .env ou configure as credenciais no arquivo PHP de conexão com o banco de dados.
2. Inicie o servidor local para rodar o sistema.

## ☕ Usando o Sistema
Para utilizar o Sistema de Petshop, siga estas etapas:

1. Acesse o sistema no seu navegador local.
2. Faça login como administrador ou secretária.
3. Cadastre clientes, animais e serviços.
4. Registre compras de serviços pelos clientes.
5. Consulte e edite as informações cadastradas.

## 📫 Contribuindo para o Sistema de Petshop

Para contribuir com o Sistema de Petshop, siga estas etapas:

1. Bifurque este repositório.
2. Crie um branch: `git checkout -b <nome_branch>`.
3. Faça suas alterações e confirme-as: `git commit -m '<mensagem_commit>'`
4. Envie para o branch original: `git push origin <nome_do_projeto>/<local>`
5. Crie a solicitação de pull.

Como alternativa, consulte a documentação do GitHub em [como criar uma solicitação pull](https://help.github.com/en/github/collaborating-with-issues-and-pull-requests/creating-a-pull-request).

## 🤝 Colaboradores

Agradecemos às seguintes pessoas que contribuíram para este projeto:

<table>
  <tr>
    <td align="center">
      <a href="https://github.com/BLFenix" title="Perfil no GitHub">
        <img src="https://github.com/BLFenix.png" width="100px;" alt="Foto do Contribuidor"/><br>
        <sub>
          <b>Gabriel Ramos</b>
        </sub>
      </a>
    </td>
  </tr>
</table>

## 😄 Seja um dos contribuidores

Quer fazer parte desse projeto? Clique [AQUI](CONTRIBUTING.md) e leia como contribuir.
