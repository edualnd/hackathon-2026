# Central de Vagas — Matrículas Escolares (Hackathon 2026)

Sistema web para **busca pública de vagas escolares** e **gestão administrativa de matrículas e listas de espera**, desenvolvido em **Laravel 13 + Livewire 3** para a rede municipal de ensino de **Caraguatatuba/SP**.

O projeto possui duas áreas principais:

- **Área pública ("Central de Vagas")**: pais e responsáveis pesquisam escolas por região, bairro e série, visualizam as unidades em um mapa interativo e realizam a pré-inscrição do aluno.

- **Área administrativa**: utilizada pela Secretaria Municipal de Educação e pelas secretarias das escolas para gerenciamento de vagas, alunos e listas de espera, utilizando critérios automáticos de classificação.

> Projeto desenvolvido para o Hackathon 2026.

## Integrantes

O projeto foi desenvolvido pelos seguintes integrantes:

| Nome                  | GitHub                                             |
| --------------------- | -------------------------------------------------- |
| **Eduarda Gonçalves** | [@edualnd](https://github.com/edualnd)             |
| **Kleiton Silva**     | [@kleitonfr](https://github.com/kleitonfr)         |
| **Murillo Diogo**     | [@MrllMoreira](https://github.com/MrllMoreira)     |
| **Rafael Tomaz**      | [@RafaelTomazzz](https://github.com/RafaelTomazzz) |

---

## Sumário

- [Stack utilizada](#stack-utilizada)
- [Pré-requisitos](#pré-requisitos)
- [Instalação passo a passo](#instalação-passo-a-passo)
- [Dados de demonstração (seeders)](#dados-de-demonstração-seeders)
- [Como testar a aplicação](#como-testar-a-aplicação)
- [Rotas da aplicação](#rotas-da-aplicação)

---

## Stack utilizada

| Camada               | Tecnologia                  |
| -------------------- | --------------------------- |
| Backend              | PHP 8.3+, Laravel 13        |
| Componentes reativos | Livewire 3 + Alpine.js      |
| Autenticação         | Laravel Jetstream + Sanctum |
| Front-end            | Tailwind CSS 4              |
| Build                | Vite                        |
| Banco de dados       | MySQL                       |

## Pré-requisitos

Antes de começar, tenha instalado:

- PHP 8.3 ou superior
- Composer
- Node.js + npm
- MySQL
- Git

---

## Instalação passo a passo

### 1. Clonar o repositório

```bash
git clone https://github.com/edualnd/hackathon-2026.git
cd hackathon-2026
```

### 2. Instalar as dependências

```bash
composer install
npm install
```

### 3. Criar o arquivo `.env`

Copie o arquivo de exemplo:

```bash
cp .env.example .env
```

Configure o banco de dados:

```env
DB_DATABASE=seu_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### 4. Gerar a chave da aplicação

```bash
php artisan key:generate
```

### 5. Criar o banco de dados

Para criar o banco já com dados de demonstração:

```bash
php artisan migrate --seed
```

Caso deseje apenas criar as tabelas:

```bash
php artisan migrate
```

### 6. Gerar os arquivos do front-end

```bash
npm run build
```

### 7. Iniciar o servidor

```bash
php artisan serve
```

---

## Dados de demonstração (seeders)

| Seeder              | O que cria                                                                                                                                                            |
| ------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `EscolaSeeder`      | Cadastra as escolas da rede municipal com nome, tipo, região, bairro, endereço, telefone, e-mail e localização geográfica.                                            |
| `UserSeeder`        | Cria os usuários iniciais do sistema.                                                                                                                                 |
| `VagaSeeder`        | Gera automaticamente as vagas de cada escola conforme seu tipo (CIEFI, EMEF, EMEI/EMEF e CEI/EMEI), criando as séries compatíveis e a quantidade de vagas disponível. |
| `AlunoSeeder`       | Gera alunos fictícios residentes em Caraguatatuba distribuídos entre as escolas e vagas existentes, criando também os critérios de classificação de cada aluno.       |
| `ListaEsperaSeeder` | Insere todos os alunos na lista de espera, mantendo a consistência entre aluno, escola e vaga, gerando pontuação, status e classificando automaticamente cada lista.  |

Para recriar completamente o banco de dados:

```bash
php artisan migrate:fresh --seed
```

---

## Como testar a aplicação

### Área pública (sem login)

Após iniciar o servidor, acesse:

| URL                      | Descrição                                                                                                                         |
| ------------------------ | --------------------------------------------------------------------------------------------------------------------------------- |
| `http://127.0.0.1:8000/` | Página inicial do sistema. Permite consultar vagas disponíveis por escola, região e série, além de visualizar as escolas no mapa. |

Não é necessário realizar login.

---

### Área administrativa (com login)

Utilize um dos usuários criados pelos seeders.

| Perfil        | CPF           | Senha    | Descrição                                                                                                                                                                                                                                                                    |
| ------------- | ------------- | -------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Demanda       | `11111111111` | `123456` | Usuário do **Departamento de Demanda da Secretaria Municipal de Educação (SEDUC)**. Responsável pelo gerenciamento da oferta de vagas da rede, podendo cadastrar, editar e acompanhar as vagas de todas as escolas, além de monitorar a demanda por série e unidade escolar. |
| Administração | `22222222222` | `123456` | Usuário da **Secretaria de uma escola**. Responsável pelo atendimento aos responsáveis, realizando o cadastro dos alunos, a inclusão na lista de espera e o acompanhamento das solicitações referentes exclusivamente à sua unidade escolar.                                 |

Login:

```text
http://127.0.0.1:8000/login
```

Após autenticar-se:

| URL                                         | Descrição                               |
| ------------------------------------------- | --------------------------------------- |
| `http://127.0.0.1:8000/dashboard`           | Painel com indicadores do sistema.      |
| `http://127.0.0.1:8000/vagas`               | Gerenciamento de vagas.                 |
| `http://127.0.0.1:8000/vaga/{vagaId}/lista` | Lista de espera de uma vaga específica. |
| `http://127.0.0.1:8000/alunos`              | Listagem de alunos.                     |
| `http://127.0.0.1:8000/alunos/novo`         | Cadastro de aluno.                      |
| `http://127.0.0.1:8000/alunos/{id}/editar`  | Edição de aluno.                        |

---

## Rotas da aplicação

### Públicas

| Método | URI | Nome          | Componente                   |
| ------ | --- | ------------- | ---------------------------- |
| GET    | `/` | `site.search` | `Livewire\Site\SchoolSearch` |

---

### Administrativas (autenticadas)

Protegidas pelos middlewares `auth:sanctum` e `verified`.

| Método | URI                      | Nome            | Componente                  |
| ------ | ------------------------ | --------------- | --------------------------- |
| GET    | `/dashboard`             | `dashboard`     | `Livewire\Admin\Dashboard`  |
| GET    | `/vagas`                 | `vagas.index`   | `Livewire\Vagas\Index`      |
| GET    | `/vaga/{vagaId}/lista`   | `vagas.lista`   | `Livewire\ListaEspera\Show` |
| GET    | `/alunos`                | `alunos.index`  | `Livewire\Aluno\Show`       |
| GET    | `/alunos/novo`           | `alunos.create` | `Livewire\Aluno\Create`     |
| GET    | `/alunos/{aluno}/editar` | `alunos.edit`   | `Livewire\Aluno\Edit`       |
