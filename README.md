# HackThePlanet

O HackThePlanet é uma aplicação Laravel multifuncional projetada para documentação, agendamento de viagens e armazenamento de arquivos. Esta aplicação tem como objetivo fornecer uma solução completa para gerenciar todas as suas necessidades relacionadas a viagens, documentos e arquivos importantes.

## Funcionalidades

### 1. Documentação
A funcionalidade de documentação permite que você crie e gerencie documentos importantes de forma eficiente. Você pode criar, visualizar, editar e excluir documentos diretamente na plataforma. Além disso, você pode organizar seus documentos em categorias ou marcá-los com tags para facilitar a pesquisa e o acesso rápido.

### 2. Agendamento de viagens
Com o HackThePlanet, você pode marcar suas viagens e manter todos os detalhes importantes em um só lugar. A funcionalidade de agendamento de viagens permite que você adicione informações sobre datas, horários, destinos, voos, hotéis e muito mais. Você também pode adicionar notas e lembretes para cada viagem, garantindo que você esteja sempre bem preparado.

### 3. Armazenamento de arquivos
A aplicação oferece uma opção segura para armazenar seus arquivos importantes. Você pode fazer upload de documentos, imagens, vídeos e qualquer outro tipo de arquivo para o HackThePlanet. Os arquivos são armazenados de forma segura e você pode acessá-los a qualquer momento. Além disso, você pode organizar seus arquivos em pastas para uma melhor organização e facilidade de acesso.

## Requisitos do Sistema

Para executar o HackThePlanet em seu ambiente, você precisará atender aos seguintes requisitos:

- PHP 7.4 ou superior
- Banco de dados MySQL, PostgreSQL ou SQLite
- Composer (para gerenciar as dependências do Laravel)
- Extensões PHP necessárias (consulte a documentação oficial do Laravel para obter detalhes)

## Tutorial de instalação

Siga as etapas abaixo para instalar e configurar o HackThePlanet:

1. Clone o repositório do HackThePlanet para o seu ambiente local:

https://github.com/victorlsilva694/HackThePlanet-Backend

2. Acesse o diretório do projeto:
cd hacktheplanet

3. Instale as dependências do projeto usando o Composer:
composer install


4. Faça uma cópia do arquivo `.env.example` e renomeie-o para `.env`. Configure as informações do banco de dados no arquivo `.env` com suas credenciais adequadas.

5. Gere uma nova chave de aplicação executando o comando:
php artisan key:generate

6. Execute as migrações do banco de dados para criar as tabelas necessárias:
php artisan migrate


7. Inicie o servidor de desenvolvimento:
php artisan serve


Após seguir essas etapas, você poderá acessar a aplicação HackThePlanet usando o endereço `http://localhost:8000` como endpoint padrão.