# Integração Mercado Pago API

Este projeto é uma API desenvolvida em **Symfony** com o objetivo de integrar funcionalidades do **Mercado Pago**. Ele serve como base para aplicações que precisam realizar pagamentos, assinaturas, ou outras interações com a plataforma do Mercado Pago.

## 📦 Tecnologias Utilizadas

- PHP ^8.x
- [Symfony](https://symfony.com/)
- Composer
- Mercado Pago SDK (a ser integrado)
- DotEnv para variáveis de ambiente

## 📁 Estrutura de Pastas

- `src/` – Código-fonte da aplicação (controllers, services, etc.)
- `config/` – Arquivos de configuração do Symfony
- `public/` – Diretório público para servir a aplicação
- `bin/` – Scripts executáveis
- `.env.dev` – Arquivo de configuração de ambiente de desenvolvimento

## 🚀 Instalação e Execução

1. Clone o repositório:
   ```bash
   git clone https://github.com/seu-usuario/integracao-mercado-pago-api.git
   cd integracao-mercado-pago-api
   ```
2. Instale as dependências:

   ```bash
   composer install
   ```

3. Configure as variáveis de ambiente:
   Copie o arquivo .env.dev e configure as chaves do Mercado Pago:

   ```bash
    cp .env.dev .env
   ```

4. Execute o servidor de desenvolvimento:
   ```bash
   symfony server:start
   ```
   ou, se estiver usando o PHP embutido:
   ```bash
     php -S localhost:8000 -t public
   ```
