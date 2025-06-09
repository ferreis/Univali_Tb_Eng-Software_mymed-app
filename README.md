# MyMed App

MyMed é uma aplicação web em Laravel destinada ao gerenciamento de receitas médicas, lembretes e cadastro de pacientes. O sistema possui diferentes perfis de usuário (médicos, farmacêuticos e pacientes) e oferece um fluxo simples para criar e consultar informações clínicas.

## Funcionalidades Principais

- **Gerenciamento de Usuários**: cadastro de médicos, pacientes e farmacêuticos.
- **Receitas**: emissão de receitas vinculadas a médicos e pacientes, com informações de data e resgate.
- **Lembretes**: criação de lembretes opcionais para pacientes e médicos, informando data e mensagem.
- **Agenda**: controle de datas de consulta para pacientes.
- **Exportação de Pacientes**: download de lista com usuário e senha gerados para cada paciente.

## Requisitos

- PHP 8.2 ou superior
- [Composer](https://getcomposer.org/)
- Node.js e npm
- Banco de dados (SQLite, MySQL ou outro compatível)

## Instalação

1. Clone o repositório:
   ```bash
   git clone https://github.com/ferreis/Univali_Tb_Eng-Software_mymed-app.git
   cd Univali_Tb_Eng-Software_mymed-app
   ```
2. Instale as dependências PHP:
   ```bash
   composer install
   ```
3. Instale as dependências JavaScript:
   ```bash
   npm install
   ```
4. Copie o arquivo de exemplo e gere a chave da aplicação:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
5. Configure o banco de dados no arquivo `.env` conforme sua preferência.
6. Execute as migrações:
   ```bash
   php artisan migrate
   ```
7. Inicie os servidores de desenvolvimento em terminais separados:
   ```bash
   npm run dev
   php artisan serve
   ```
8. Acesse `http://localhost:8000` no navegador.

## Configurações Adicionais

- Há um arquivo `MysqlDump.zip` com dados de exemplo para popular o banco se necessário.
- Os testes automatizados estão em `tests/` e podem ser executados com:
   ```bash
   php artisan test
   ```

## Licença

Este projeto está licenciado sob a licença MIT.
