# Integração Mercado Pago API

Este projeto é uma API desenvolvida em **Symfony** com o objetivo de integrar funcionalidades do **Mercado Pago**. Ele serve como base para aplicações que precisam realizar pagamentos com a plataforma do Mercado Pago.

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

## 🔐 Configuração do Mercado Pago

### Gere as chaves do seu projeto mercado pago:

Acesse o site mercado pago developers, gere as chaves para produção e homologação

```bash
 https://www.mercadopago.com.br/developers
```

1. Caso esteja usando CheckOutPro

## 📌 Endpoints (em desenvolvimento)

Aqui estão os endpoints criados na API para integração com o Mercado Pago. Todos serão ajustados conforme a implementação.

*POST /api/check-pro/link-pagamento
*POST /api/check-transparente/pix
\*POST /api/check-transparente/cartao (Em desenvolvimento)

📝 Exemplo de CURL para Criação de Pagamento

Aqui está um exemplo para criação de pagamento com checkOutPro (Link de Pagamento):

```bash
    curl --request POST \
    --url http://localhost:8000/api/check-pro/link-pagamento \
    --header 'Content-Type: application/json' \
    --header 'User-Agent: insomnia/11.0.2' \
    --data '{
        "MERCADO_PAGO_TOKEN"
        "amount": 2.50,
        "description_product": "teste de pagamento",
        "id_product": "123456",
        "name_product": "Camisa pirata do flamengo",
        "url_success": "https://test.com/success",
        "url_failure": "https://test.com/failure",
        "url_pending": "https://test.com/pending"
    }'
```

Aqui está um exemplo para criação de pagamento com checkOutTransparente (Metodo Pix):

```bash
    curl --request POST \
    --url http://localhost:8000/api/check-transparente/pix \
    --header 'Content-Type: application/json' \
    --header 'User-Agent: insomnia/11.0.2' \
    --data '{
        "MERCADO_PAGO_TOKEN": "SEU_TOKEN_MERCADO_PAGO"
        "amount": 2.50,
        "description_product": "teste de pagamento",
        "fisrt_name": "teste 1",
        "last_name": "teste 02",
        "email": "jamesgustavo133@gmail.com",
        "cpf": "08162898590",
        "id_product": "123456",
        "name_product": "Camisa pirata do flamengo"
    }'
```

📝 Exemplo de Saida

1. Aqui está um exemplo de saida após criação de pagamento com checkOutPro (Link de Pagamento):

```bash
{
    "status": 201, // Status HTTP confirmando criação do pagamento
    "message": "Pagamento gerado com sucesso", // Mensagem padrão de sucesso
    "init_point": "link_externo_de_pagamento", // Link externo de pagamento do Mercado Pago
    "externalReference": "referencia_externa", // Referência externa (importante para o banco de dados, usada para rastrear o status do pagamento)
    "metadata": "metadata_gerado_pelo_sdk_do_mercado_pago" // Metadados gerados pelo SDK do Mercado Pago
}

```

2. Aqui está um exemplo de saida após criação de pagamento com checkOutTransparente (Metodo Pix):

```bash
{
    "status": 201, // Status HTTP confirmando criação do pagamento
    "qrcode": "imagem_do_pix_em_base64", // Imagem do Pix em formato Base64
    "payload": "payload_do_pix_para_copia_e_cola", // Payload do Pix para cópia e cola
    "externalReference": "referencia_externa", // Referência externa (importante para o banco de dados, usada para rastrear o status do pagamento)
    "metadata": "metadata_gerado_pelo_sdk_do_mercado_pago", // Metadados gerados pelo SDK do Mercado Pago
    "message": "Pagamento Pix gerado com sucesso" // Mensagem padrão de sucesso
}

```
