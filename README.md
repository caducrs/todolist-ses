
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# ✅ ToDoList SES

Aplicação web de **gestão de tarefas** desenvolvida em **Laravel 12** como parte do desafio técnico para vaga de estágio no **SES-MT**.

A aplicação permite que usuários se cadastrem, façam login e realizem operações CRUD (criar, visualizar, editar e excluir) em tarefas por meio de uma interface web simples e responsiva.

---

## 🚀 Tecnologias Utilizadas

- **PHP 8.3+**
- **Laravel 12**
- **Composer**
- **Blade (Laravel)**
- **Bootstrap 5**
- **MySQL**
- **Laravel Breeze**

---

## 📦 Dependências

Principais dependências listadas no `composer.json`:

### Produção

- `laravel/framework` – Framework PHP principal
- `laravel/breeze` – Starter kit para autenticação com Blade
- `guzzlehttp/guzzle` – Cliente HTTP
- `fruitcake/laravel-cors` – Middleware para CORS
- `fideloper/proxy` – Suporte a proxies reversos
- `laravel/sanctum` – Autenticação por tokens (opcional)

### Desenvolvimento

- `fakerphp/faker` – Geração de dados falsos
- `nunomaduro/collision` – Tratamento de erros
- `laravel/pint` – Formatador de código
- `phpunit/phpunit` – Framework de testes

---

## 🧪 Funcionalidades

- ✅ Registro e login de usuários
- ✅ Cadastro, edição e exclusão de tarefas
- ✅ Interface com Bootstrap 5
- ✅ CRUD completo com autenticação
- ⏳ Organização estilo Kanban *(em desenvolvimento)*

---

## 📁 Estrutura do Projeto

- `app/` – Lógica da aplicação (Models, Controllers)
- `resources/views/` – Arquivos Blade (HTML)
- `routes/web.php` – Rotas da aplicação
- `database/migrations/` – Estrutura do banco
- `public/` – Arquivos públicos (CSS/JS)
- `.env` – Variáveis de ambiente

---

## ⚙️ Como Executar Localmente

### Pré-requisitos

- PHP >= 8.3
- Composer
- MySQL
- Node.js e NPM (opcional para frontend)

### Instalação

```bash
# Clonar o repositório
git clone https://github.com/caducrs/todolist-ses.git
cd todolist-ses

# Instalar as dependências
composer install

# Criar o arquivo .env
cp .env.example .env

# Gerar a chave da aplicação
php artisan key:generate

# Configurar as credenciais do banco de dados no .env

# Rodar as migrations
php artisan migrate

# Iniciar o servidor local
php artisan serve

