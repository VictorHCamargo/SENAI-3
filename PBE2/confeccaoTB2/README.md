# Confecção TB2

Sistema de gestão para confecções desenvolvido com Laravel, Filament e Spatie Permission, permitindo o gerenciamento de clientes, fornecedores, produtos, insumos, estoque, pedidos e controle de acesso por perfis de usuário.

---

# Tecnologias Utilizadas

## Backend

* PHP 8.3+
* Laravel 13
* Filament 5
* Eloquent ORM
* Laravel Migrations
* Laravel Seeders

## Painel Administrativo

* Filament Admin Panel
* Filament Resources
* Filament Forms
* Filament Tables

## Controle de Permissões

* Spatie Laravel Permission

## Banco de Dados

* MySQL

---

# Objetivo do Projeto

O sistema foi desenvolvido para atender processos administrativos e operacionais de uma confecção, centralizando informações de:

* Clientes
* Fornecedores
* Produtos
* Insumos
* Estoque
* Pedidos
* Usuários
* Controle de Permissões

O painel administrativo permite que diferentes setores da empresa tenham acesso apenas às funcionalidades necessárias para sua operação.

---

# Arquitetura Geral

O projeto segue o padrão MVC (Model-View-Controller) do Laravel.

## Estrutura Principal

```text
app/
├── Filament/
│   ├── Resources/
│   └── Pages/
├── Models/
├── Providers/
│
database/
├── migrations/
├── seeders/
│
routes/
└── web.php
```

---

# Módulos do Sistema

## Clientes

Responsável pelo cadastro e gerenciamento de clientes.

### Informações armazenadas

* Nome
* E-mail
* Telefone
* Documento

### Tabela

```sql
clientes
```

---

## Fornecedores

Gerencia os fornecedores da empresa.

### Informações armazenadas

* Razão Social
* Nome Fantasia
* Documento
* Inscrição Estadual
* E-mail
* Telefone
* Endereço
* Tipo de Material
* Status Ativo/Inativo

### Tabela

```sql
fornecedors
```

---

## Insumos

Controle de matéria-prima e materiais utilizados na produção.

### Informações armazenadas

* Nome
* Unidade de Medida
* Preço de Custo
* Estoque

### Tabela

```sql
insumos
```

---

## Produtos

Gerenciamento dos produtos comercializados pela confecção.

### Informações armazenadas

* Nome
* Referência
* Preço de Venda

### Tabela

```sql
produtos
```

---

## Estoque

Controle da quantidade física dos produtos.

### Informações armazenadas

* Produto
* Quantidade
* Localização

### Tabela

```sql
estoques
```

### Relacionamento

```text
Produto 1 -> 1 Estoque
```

---

## Pedidos

Gerenciamento dos pedidos realizados pelos clientes.

### Informações armazenadas

* Cliente
* Status
* Valor Total

### Tabela

```sql
pedidos
```

### Relacionamento

```text
Cliente 1 -> N Pedidos
```

---

## Itens do Pedido

Representa os produtos pertencentes a cada pedido.

### Informações armazenadas

* Pedido
* Produto
* Quantidade
* Preço Unitário

### Tabela

```sql
item_pedidos
```

### Relacionamentos

```text
Pedido 1 -> N Itens

Produto 1 -> N Itens
```

---

# Modelo de Dados

## Relacionamentos Principais

```text
Cliente
   |
   | 1:N
   |
Pedido
   |
   | 1:N
   |
ItemPedido
   |
   | N:1
   |
Produto
   |
   | 1:1
   |
Estoque
```

---

# Controle de Acesso

O projeto utiliza o pacote Spatie Laravel Permission para gerenciamento de papéis e permissões.

## Guard Utilizado

```php
protected $guard_name = 'web';
```

Foi padronizado nos modelos:

* User
* Role
* Permission

Essa configuração elimina inconsistências de permissões e erros de:

```text
Guard Does Not Match
```

---

# Perfis de Usuário

## Admin

Possui acesso total ao sistema.

Permissões:

* Visualizar
* Criar
* Editar
* Excluir

Em todos os módulos.

---

## Gerente

Acesso administrativo quase total.

Restrições:

* Não pode excluir usuários.
* Não pode excluir cargos/perfis.

---

## Logística

Focado em operações comerciais.

Acesso aos módulos:

* Clientes
* Pedidos
* Fornecedores

---

## Estoque

Focado no controle operacional de materiais.

Acesso aos módulos:

* Produtos
* Insumos
* Estoque
* Visualização de pedidos

---

# Estrutura de Permissões

As permissões são geradas automaticamente através do Seeder.

Padrão:

```text
ver_clientes
criar_clientes
editar_clientes
deletar_clientes
```

Aplicado aos módulos:

* clientes
* pedidos
* insumos
* produtos
* fornecedores
* usuarios
* roles

Seguindo o padrão CRUD:

```text
ver
criar
editar
deletar
```

---

# Seeders

## RolesAndPermissionsSeeder

Responsável por:

1. Limpar cache do Spatie Permission.
2. Criar permissões automaticamente.
3. Criar cargos do sistema.
4. Associar permissões aos cargos.

---

## DatabaseSeeder

Responsável pela criação segura do usuário administrador principal.

Utiliza:

```php
updateOrCreate()
```

Evitando erros de duplicidade:

```text
UniqueConstraintViolationException
```

---

# Internacionalização

O sistema está configurado para o padrão brasileiro.

## Locale

```env
APP_LOCALE=pt_BR
```

## Timezone

```env
APP_TIMEZONE=America/Sao_Paulo
```

Impactos:

* Datas em português.
* Horários brasileiros.
* Formatações monetárias compatíveis.

---

# Interface Administrativa

Painel construído utilizando Filament.

## Configurações

### Nome do Sistema

```text
Confecção TB2
```

### Cor Principal

```php
Color::Amber
```

---

# Navegação

A sidebar foi organizada seguindo boas práticas de UX do Filament.

### Ajustes realizados

* Remoção de ícones duplicados em grupos.
* Manutenção dos ícones apenas nos Resources.
* Melhor legibilidade e organização visual.

---

# Rotas

## Rota Principal

```php
/
```

Redireciona automaticamente para:

```php
/admin
```

## Painel Administrativo

```text
/admin
```

Gerenciado pelo Filament.

As rotas internas são registradas automaticamente pelo framework.

---

# Instalação

## Clonar o Projeto

```bash
git clone <repositorio>
```

## Instalar Dependências

```bash
npm install
composer install
```

## Configurar Ambiente

```bash
cp .env.example .env
```

Configurar:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=confeccao_tb2
DB_USERNAME=root
DB_PASSWORD=
```

## Gerar Chave

```bash
php artisan key:generate
```

## Executar Migrações

```bash
php artisan migrate
```

## Popular Banco

```bash
php artisan db:seed
```

Ou

```bash
php artisan migrate:fresh --seed
```

## Iniciar Servidor

```bash
php artisan serve
npm run dev
```

---

# Usuário Administrador

Criado automaticamente pelo Seeder.

```text
Email: admin@confeccao.com
```

A senha deverá ser definida conforme a implementação do Seeder utilizada no ambiente.

---

# Melhorias Futuras

* Dashboard com indicadores de produção.
* Controle de movimentação de estoque.
* Histórico de alterações.
* Relatórios PDF.
* Controle financeiro.
* Integração com emissão de notas fiscais.
* Controle de produção e ordens de serviço.
* API REST para integração externa.

---

# Autor

Projeto desenvolvido para gerenciamento operacional da Confecção TB2 utilizando Laravel, Filament e Spatie Permission.
