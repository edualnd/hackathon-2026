# Central de Vagas — Matrículas Escolares (Hackathon 2026)

Sistema web para **busca pública de vagas escolares** e **gestão administrativa de matrículas e listas de espera**, desenvolvido em **Laravel 13 + Livewire 3** para a rede municipal de ensino de **Caraguatatuba/SP**.

O projeto tem duas frentes:

- **Área pública** ("Central de Vagas"): pais e responsáveis pesquisam escolas por região/bairro/nível de ensino, veem um mapa interativo com as unidades e fazem a pré-inscrição do aluno.
- **Área administrativa**: a SEDUC gerencia escolas, vagas, cadastros de alunos e a fila de espera, com pontuação automática por critérios de prioridade (vulnerabilidade, proximidade, irmão na escola, etc.).

> Projeto em desenvolvimento ativo (hackathon) — alguns módulos ainda usam dados de demonstração e a área administrativa não tem controle de papéis/permissões implementado ainda.

---

## Sumário

- [Stack utilizada](#stack-utilizada)
- [Pré-requisitos](#pré-requisitos)
- [Instalação passo a passo](#instalação-passo-a-passo)
- [Subindo o ambiente de desenvolvimento](#subindo-o-ambiente-de-desenvolvimento)
- [Dados de demonstração (seeders)](#dados-de-demonstração-seeders)
- [Como testar a aplicação](#como-testar-a-aplicação)
  - [1. Área pública](#1-área-pública-sem-login)
  - [2. Área administrativa](#2-área-administrativa-com-login)
- [Estrutura do projeto](#estrutura-do-projeto)
- [Rotas da aplicação](#rotas-da-aplicação)
- [Rodando os testes automatizados](#rodando-os-testes-automatizados)
- [Problemas comuns (troubleshooting)](#problemas-comuns-troubleshooting)

---

## Stack utilizada

| Camada | Tecnologia |
|---|---|
| Backend | PHP 8.3+, Laravel 13 |
| Componentes reativos | Livewire 3 + Alpine.js |
| Autenticação | Laravel Jetstream (stack Livewire) + Sanctum |
| Frontend / build | Vite, Tailwind CSS 4 |
| Banco de dados | SQLite (padrão do projeto) |
| Testes | PHPUnit |

---

## Pré-requisitos

Antes de começar, tenha instalado na sua máquina:

- **PHP 8.3 ou superior**, com as extensões `sqlite3`, `pdo_sqlite`, `mbstring`, `openssl`, `fileinfo` habilitadas (o XAMPP já vem com a maioria delas — só confirme se `pdo_sqlite` está ativa no `php.ini`).
- **Composer** ([getcomposer.org](https://getcomposer.org))
- **Node.js 18+** e **npm** (para compilar o CSS/JS com Vite)
- Um servidor local (o projeto já está em `C:\xampp\htdocs\hackathon-2026`, então o **XAMPP/Apache** funciona, mas o jeito mais simples de rodar em desenvolvimento é usar o servidor embutido do próprio Laravel — veja abaixo)

Não é necessário instalar MySQL/MariaDB: o projeto usa **SQLite**, um banco em arquivo único, sem precisar configurar servidor de banco de dados.

---

## Instalação passo a passo

Abra um terminal (PowerShell, CMD ou Git Bash) na pasta do projeto:

```bash
cd C:\xampp\htdocs\hackathon-2026
```

### 1. Instalar as dependências PHP

```bash
composer install
```

### 2. Criar o arquivo de ambiente `.env`

```bash
copy .env.example .env
```
*(no Git Bash/Linux/Mac use `cp .env.example .env`)*

### 3. Gerar a chave da aplicação

```bash
php artisan key:generate
```

### 4. Criar o arquivo do banco SQLite

O `.env` já vem configurado com `DB_CONNECTION=sqlite`, mas o arquivo físico do banco (`database/database.sqlite`) precisa existir. Se ele ainda não existir na sua cópia do projeto, crie-o:

```bash
type nul > database\database.sqlite
```
*(no Git Bash/Linux/Mac: `touch database/database.sqlite`)*

### 5. Rodar as migrations (criar as tabelas)

```bash
php artisan migrate
```

### 6. Popular o banco com dados de demonstração (seeders)

```bash
php artisan db:seed --class=EscolaSeeder
php artisan db:seed --class=AlunoSeeder
```

> ⚠️ **Importante:** rode o `EscolaSeeder` **antes** do `AlunoSeeder`. O seeder de alunos vincula cada aluno a uma vaga/escola já existente — se as escolas não existirem ainda, os alunos são criados sem vínculo e não aparecem na lista de espera do dashboard.
>
> Se preferir, você também pode simplesmente rodar `php artisan migrate:fresh --seed`, mas edite antes o arquivo `database/seeders/DatabaseSeeder.php` e descomente a linha `EscolaSeeder::class` (ela vem comentada por padrão no repositório).

### 7. Instalar as dependências de frontend

```bash
npm install
```

### 8. Gerar o build do CSS/JS

Para rodar em modo "produção local" (arquivos já compilados):

```bash
npm run build
```

Ou, para desenvolvimento com hot-reload, veja a seção seguinte.

---

## Subindo o ambiente de desenvolvimento

Você tem duas opções:

### Opção A — Um único comando (recomendado)

O projeto já vem com um script que sobe **servidor PHP + fila + logs + Vite** ao mesmo tempo:

```bash
composer run dev
```

Isso abre:
- `php artisan serve` → aplicação em `http://127.0.0.1:8000`
- `php artisan queue:listen` → processa filas (jobs)
- `php artisan pail` → logs em tempo real no terminal
- `npm run dev` → Vite com hot-reload do CSS/JS

Acesse **http://127.0.0.1:8000** no navegador.

### Opção B — Manual (dois terminais)

**Terminal 1** — servidor PHP:
```bash
php artisan serve
```

**Terminal 2** — build do frontend com hot-reload:
```bash
npm run dev
```

### Opção C — Usando o Apache do XAMPP

Como o projeto já está dentro de `htdocs`, também é possível acessá-lo via Apache/XAMPP configurando um Virtual Host apontando para a pasta `public/` do projeto. Para testes rápidos, porém, a **Opção A** é mais simples e evita problemas de configuração do Apache com o roteamento do Laravel.

---

## Dados de demonstração (seeders)

| Seeder | O que cria |
|---|---|
| `EscolaSeeder` | 6 escolas da rede (com nome, tipo, região, bairro, geolocalização) e suas vagas por série |
| `AlunoSeeder` | 8 alunos de exemplo, alguns já com vaga confirmada e outros na fila de espera, com critérios de priorização variados |

Você pode rodá-los novamente a qualquer momento para resetar os dados de teste:

```bash
php artisan migrate:fresh
php artisan db:seed --class=EscolaSeeder
php artisan db:seed --class=AlunoSeeder
```

---

## Como testar a aplicação

### 1. Área pública (sem login)

Depois de subir o servidor, acesse:

| URL | O que é |
|---|---|
| `http://127.0.0.1:8000/` | **Página inicial pública** — "Central de Vagas": busca de vagas por nível/bairro/região, mapa interativo das escolas e lista de espera |
| `http://127.0.0.1:8000/mapa1` | Mapa interativo isolado (mesmo componente usado na home) |
| `http://127.0.0.1:8000/aluno` | Formulário público de pré-inscrição do aluno |
| `http://127.0.0.1:8000/lista` | Consulta da posição na lista de espera |

Não é necessário login para navegar nessas páginas. Redimensione a janela do navegador (ou use o modo responsivo do DevTools, `F12` → ícone de celular) para ver o layout mobile, com o mapa em destaque e o filtro flutuando por cima.

### 2. Área administrativa (com login)

As rotas administrativas (`/dashboard`, `/vagas`, `/alunos`, etc.) exigem um usuário autenticado. Como não há nenhum usuário pré-cadastrado nos seeders, você precisa **criar sua própria conta**:

1. Acesse `http://127.0.0.1:8000/register`
2. Preencha nome, e-mail e senha e envie o formulário
3. Você será autenticado automaticamente e redirecionado

Depois de logado, acesse:

| URL | O que é |
|---|---|
| `http://127.0.0.1:8000/dashboard` | Painel com totais de vagas, matrículas e lista de espera |
| `http://127.0.0.1:8000/vagas` | Gestão de vagas por escola/série (criar, editar, excluir) |
| `http://127.0.0.1:8000/alunos` | Listagem de alunos cadastrados |
| `http://127.0.0.1:8000/alunos/novo` | Cadastro manual de um novo aluno |
| `http://127.0.0.1:8000/alunos/{id}/editar` | Edição de um aluno já cadastrado |

> A área administrativa foi desenhada para uso em **desktop**. Se acessar por um celular, o sistema recomenda o acesso via computador.
>
> ⚠️ Não confunda: a validação de acesso é feita apenas por **login** (`auth:sanctum` + Jetstream), não existe ainda controle de perfil/permissão (ex.: diretor só vê a própria escola) — qualquer usuário registrado acessa o painel completo.

Para sair, use o menu de usuário no canto superior direito e clique em "Log Out", ou acesse diretamente `http://127.0.0.1:8000/logout` (via POST, através do próprio menu).

---

## Estrutura do projeto

```
app/
├── Livewire/
│   ├── Site/SchoolSearch.php     → página pública "Central de Vagas" (rota "/")
│   ├── Mapa.php                  → mapa interativo (Leaflet) com as escolas
│   ├── Lista.php                 → listagem de escolas/vagas na home pública
│   ├── Aluno/                    → Create, Edit, Show (cadastro/edição/listagem de alunos)
│   ├── ListaEspera/Show.php      → consulta pública da fila de espera
│   ├── Vagas/                    → Index, Create, Edit (CRUD administrativo de vagas)
│   └── Admin/Dashboard.php       → painel administrativo
├── Models/
│   ├── Escola.php                → unidades escolares
│   ├── Vaga.php                  → vagas por escola/série
│   ├── Aluno.php                 → cadastro do aluno e responsável
│   ├── Criterio.php              → critérios de priorização do aluno
│   ├── ListaEspera.php           → posição/pontuação na fila de espera
│   └── Documento.php             → documentos anexados ao aluno
resources/views/
├── layouts/site.blade.php        → layout da área pública
├── layouts/admin.blade.php       → layout da área administrativa
├── livewire/site/                → views da área pública
├── livewire/admin/                → views da área administrativa
└── components/site/               → componentes reutilizáveis (botão, input, select, badge...)
database/
├── migrations/                   → estrutura das tabelas
└── seeders/                      → dados de demonstração
routes/web.php                    → todas as rotas da aplicação
```

O design segue um pequeno **design system** próprio (cores `teal-dark`, `teal-light`, `seduc-neutral`, `action-primary` etc.), definido em `resources/css/app.css` via variáveis do Tailwind 4 (`@theme`).

---

## Rotas da aplicação

### Públicas

| Método | URI | Nome | Componente |
|---|---|---|---|
| GET | `/` | `site.search` | `Livewire\Site\SchoolSearch` |
| GET | `/mapa` | `site.map` | *(placeholder — "em construção")* |
| GET | `/mapa1` | `mapa` | `Livewire\Mapa` |
| GET | `/aluno` | `aluno` | `Livewire\Aluno\Create` |
| GET | `/lista` | `lista` | `Livewire\ListaEspera\Show` |

### Administrativas (exigem login — `auth:sanctum`, `verified`)

| Método | URI | Nome | Componente |
|---|---|---|---|
| GET | `/dashboard` | `dashboard` | `Livewire\Admin\Dashboard` |
| GET | `/vagas` | `vagas.index` | `Livewire\Vagas\Index` |
| GET | `/listas` | `listas` | `Livewire\Vagas\Index` |
| GET | `/alunos` | `alunos.index` | `Livewire\Aluno\Show` |
| GET | `/alunos/novo` | `alunos.create` | `Livewire\Aluno\Create` |
| GET | `/alunos/{aluno}/editar` | `alunos.edit` | `Livewire\Aluno\Edit` |

As rotas de **login/registro/perfil** (`/login`, `/register`, `/forgot-password`, `/user/profile`, etc.) são registradas automaticamente pelo Laravel Jetstream e não aparecem em `routes/web.php`.

---

## Rodando os testes automatizados

O projeto usa PHPUnit. Para rodar a suíte de testes:

```bash
composer test
```

ou diretamente:

```bash
php artisan test
```

---

## Problemas comuns (troubleshooting)

**"could not find driver" ou erro de SQLite ao migrar**
Verifique se a extensão `pdo_sqlite` está habilitada no seu `php.ini` (no XAMPP, procure por `extension=pdo_sqlite` e `extension=sqlite3` e remova o `;` na frente, se houver).

**Página em branco / erro 500**
Confira se o `.env` existe e se `php artisan key:generate` foi executado. Veja o log detalhado em `storage/logs/laravel.log`.

**CSS/estilo não carrega (página "sem estilo")**
Rode `npm install` e depois `npm run build` (ou mantenha `npm run dev` rodando junto com `php artisan serve`).

**Erro de permissão em `storage/` ou `bootstrap/cache/`**
No Windows/XAMPP isso raramente ocorre, mas em ambientes Linux/Mac garanta que essas pastas tenham permissão de escrita para o servidor web.

**Lista de espera aparece vazia no dashboard mesmo após rodar o `AlunoSeeder`**
Isso acontece se o `EscolaSeeder` não foi rodado antes. Rode `php artisan migrate:fresh`, depois `EscolaSeeder` e só então `AlunoSeeder`, na ordem descrita em [Dados de demonstração](#dados-de-demonstração-seeders).

**Quero resetar tudo e recomeçar do zero**
```bash
php artisan migrate:fresh
php artisan db:seed --class=EscolaSeeder
php artisan db:seed --class=AlunoSeeder
```
