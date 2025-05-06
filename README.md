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

### Adicione suas chaves de acesso no arquivo .env:

1. Caso esteja usando CheckOutPro

   ```bash
    MERCADO_PAGO_PUBLIC_KEY_PRO=your_public_key
    MERCADO_PAGO_TOKEN_PRO=your_access_token
   ```

2. Caso esteja usando CheckOutTransparente

   ```bash
    MERCADO_PAGO_PUBLIC_KEY_TRANSPARENTE=your_public_key
    MERCADO_PAGO_TOKEN_TRANSPARENTE=your_access_token
   ```

## 📌 Endpoints (em desenvolvimento)

Aqui estão os endpoints criados na API para integração com o Mercado Pago. Todos serão ajustados conforme a implementação.

*POST /api/check-pro/link-pagamento
*POST /api/check-transparente/pix
\*POST /api/check-transparente/cartao (Em desenvolvimento)

📝 Exemplo de Payload para Criação de Pagamento

Aqui está um exemplo de payload para criação de pagamento com checkOutPro (Link de Pagamento):

```bash
    {
        "amount": 2.50,
        "description_product": "teste de pagamento" //descrição do produto,
        "id_product": "123456" //Id do produto,
        "name_product": "Camisa pirata do flamengo" // nome do produto,
        "url_success": "https://test.com/success" //Colocar sua url de sucesso,
        "url_failure": "https://test.com/failure" //Colocar sua url de falha,
        "url_pending": "https://test.com/pending" //Colocar sua url de pendente
    }
```

Aqui está um exemplo de payload para criação de pagamento com checkOutTransparente (Metodo Pix):

```bash
    {
        "amount": 2.50,
        "description_product": "teste de pagamento" //descrição do produto,
        "fisrt_name": "teste 1" //primeiro nome do pagador,
        "last_name": "teste 02" //sobrenome do pagador,
        "email": "teste@gmail.com" //e-mail do pagador,
        "cpf": "12345678909" //cpf do pagador,
        "id_product": "123456" //Id do produto,
        "name_product": "Camisa pirata do flamengo" // nome do produto
    }
```

📝 Exemplo de Saida
Aqui está um exemplo de saida após criação de pagamento com checkOutPro (Link de Pagamento):

```bash
{
    'status' => 201 // status http confirmando criação do pagamento,
    'message' => 'Pagamento Gerado com sucesso' // mensagem padrão,
    'init_point' => link externo de pagamento do mercado pago,
    'externalReference' => referencia externa(importante para o banco de dados, onde saberemos sobre os status do pagamento se foi aprovado ou não),
    'metadata' => metadata gerado pelo sdk do mercado pago,
}

```

Aqui está um exemplo de saida após criação de pagamento com checkOutTransparente (Metodo Pix):

```bash
{
    'status' => 201 // status http confirmando criação do pagamento,
    'qrcode' => imagem do pix em base64,
    'payload' => payload do pix para o copia e cola,
    'externalReference' => referencia externa(importante para o banco de dados, onde saberemos sobre os status do pagamento se foi aprovado ou não),
    'metadata' => etadata gerado pelo sdk do mercado pago,
    'message' => 'Pagamento Pix Gerado com Sucesso' // mensagem padrão
}

```
