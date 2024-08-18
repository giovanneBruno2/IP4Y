Parte 1: Questões Teóricas
1. Explique a diferença entre Eloquent ORM e Query Builder no Laravel. Quais são os prós
e contras de cada abordagem?
R:


2. Como você garantiria a segurança de uma aplicação Laravel ao lidar com entradas de
usuários e dados sensíveis? Liste pelo menos três práticas recomendadas e explique
cada uma delas.
R:

Validação e sanitização de dados, sempre validando os dados de entradas para garantir que apenas dados esperados sejam processados, não deixando nenhum dado "malicioso" passar
Utilizando hashing para senhas e dados sensiveis, armazenando senhas e dados sensiveis de forma segura atraves do hashing
Utilizando CSRF e CSS, para evitar inserção de código malicioso nas paginas, e token CSRF nos formulários, além de verificar a validade.

Essas são 3 boas praticas básicas para uma aplicação.


3. Qual é o papel dos Middlewares no Laravel e como eles se integram ao pipeline de
requisição? Dê um exemplo prático de como você criaria e aplicaria um Middleware
personalizado para verificar se o usuário está ativo antes de permitir o acesso a uma rota
específica.
R:
Atuando como uma camada intermediaria no pipeline, permite que voce execute diversas tarefas como autenticar e/ou autorizar as requisições, 


4. Descreva como o Laravel gerencia migrations e como isso é útil para o desenvolvimento
de aplicações. Quais são as melhores práticas ao criar e aplicar migrations?


o laravel gerencia as migrations atraves de um sistema para facilitar a criação, aplicação e reversão de alterações no banco, atraves de "classes" e metodos (up,down) e comandos Artisan,
sendo util para um "vesionamento" do banco de dados, migrations permitem versionar o esquema do banco de dados, parecendo um versionamento de código, garantindo que todos os membros da equipe de desenvolvimento possuam o mesmo esquema de banco.
Melhores praticas, assim como em todo código, são nomes claros e descritivos, para que o proposito da migration seja compreendido facilmente, evitar logica muito complexa na migration, e, caso tenha que utilizar logica complexa, divida em multiplas migrações,
com isso, torna o historico de alteração mais facil de ser encontrado e torna a reversão mais facil.


5. Qual é a diferença entre transações e savepoints no SQL Server? Como você usaria
transações em um ambiente Laravel?
R:

Uma transação é um conjunto de operações SQL e um savepoint é um ponto intermediario dentro de uma transão, permitindo que voce divida a transão em partes menores, facilitando o rollback

