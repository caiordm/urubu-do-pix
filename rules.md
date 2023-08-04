## Regras do Negócio

Usuário -> deposita -> dinheiro na conta rende 33,3% ao dia -> após 30 dias, ele faz o saque -> recebe o dinheiro depositado com 1000% de lucro

### Lógica

- O router.php recebe a requisição e encaminha para algum método de alguma classe de acordo com o path da requisição.

- O Model tem todas as informações da Entidade, e todos os métodos para realizar ações direto no BD 

- O Controller recebe a requisição(via router), e direciona para algum método no Model, o Controller támbem traz alguma resposta para a requisição feita.

### Entities

#### User

```json
{
    "id": 1,
    "name": "Exemplo", 
    "created_at": "220223-08-01 22:56:07",
    "updated_at": "220223-08-01 22:56:07"
}

```
+ Métodos da classe User

- createUser() /createUser
- getAll() /users
- updateUser() /updateUser
- deleteUser() /deleteUser

#### Transaction

```json
{
    "id": 1,
    "type": "deposit", // enum['deposit', 'profit', 'withdraw'] 
    "value": 200, 
    "created_at": "220223-08-01 22:56:07",
    "updated_at": "220223-08-01 22:56:07"
}

```
+ Métodos da classe Transaction

- addDeposit() // Depositar dinheiro
- getBalance() // Ver saldo e balanço
- withdraw() // Saque ou retirada de dinheiro

- Endpoints: /{{nome do método}} ex: /addDeposit

###### OBS:

- Até então está sendo recebido 33,3% por deposito, ao invés de por dia.

- Por enquanto o saque consiste em remover uma transação do tipo 'depósito'.