##------------------------------------------------------------------------------------------------------------------------------------------------------------------
Parte 1: Questões Teóricas
 
1. Explique a diferença entre Eloquent ORM e Query Builder no Laravel. Quais são os prós e contras de cada abordagem?
R:

O Query Builder pode ser mais indicado para consultas complexas e otimizadas, oferecendo mais controle, pois permite criar consultas personalizadas de maneira controlada e direta. No entanto, por ser mais complexo, requer mais trabalho para lidar com relacionamentos, já que não possui abstrações prontas. Dependendo das necessidades, você pode acabar escrevendo mais código em comparação com o Eloquent.

O Eloquent ORM utiliza uma abordagem orientada a objetos, com classes que fornecem abstração sobre as operações CRUD. Por ser bastante abstrato, permite que você trabalhe de uma maneira mais intuitiva e legível, oferecendo métodos para consultas e operações comuns (find(), where()). No entanto, não é recomendado para consultas complexas ou otimizadas, pois pode gerar consultas mais pesadas do que o Query Builder, adicionando uma sobrecarga adicional desnecessária.


2. Como você garantiria a segurança de uma aplicação Laravel ao lidar com entradas de
usuários e dados sensíveis? Liste pelo menos três práticas recomendadas e explique
cada uma delas.
R:

Validação e sanitização de dados: sempre valide os dados de entrada para garantir que apenas dados esperados sejam processados, evitando que dados "maliciosos" passem.

Utilização de hashing para senhas e dados sensíveis: armazene senhas e dados sensíveis de forma segura através do hashing.

Utilização de CSRF e XSS: para evitar a inserção de código malicioso nas páginas, utilize tokens CSRF nos formulários e verifique a validade.

Essas são três boas práticas básicas para uma aplicação.


3. Qual é o papel dos Middlewares no Laravel e como eles se integram ao pipeline de
requisição? Dê um exemplo prático de como você criaria e aplicaria um Middleware
personalizado para verificar se o usuário está ativo antes de permitir o acesso a uma rota
específica.
R:

Atua como uma camada intermediária no pipeline, permitindo que você execute diversas tarefas, como autenticar e/ou autorizar as requisições.

Eu criaria um middleware personalizado, com um nome simples e semântico (CheckActiveUser), que verifica se o usuário está ativo antes de permitir que a rota seja acessada. No middleware, eu também adicionaria uma lógica para redirecionar o usuário inativo para outra rota de erro e registraria o middleware no Kernel.



4. Descreva como o Laravel gerencia migrations e como isso é útil para o desenvolvimento
de aplicações. Quais são as melhores práticas ao criar e aplicar migrations?


O Laravel gerencia as migrations por meio de um sistema que facilita a criação, aplicação e reversão de alterações no banco de dados, utilizando "classes", métodos (up e down) e comandos Artisan. Esse sistema é útil para o "versionamento" do banco de dados, permitindo versionar o esquema do banco de dados de forma semelhante ao versionamento de código, garantindo que todos os membros da equipe de desenvolvimento tenham o mesmo esquema de banco.

Boas práticas, assim como em qualquer código, incluem nomes claros e descritivos, para que o propósito da migration seja facilmente compreendido. Também é importante evitar lógica muito complexa na migration; se necessário, divida-a em múltiplas migrações. Isso torna o histórico de alterações mais fácil de ser encontrado e a reversão mais simples.



5. Qual é a diferença entre transações e savepoints no SQL Server? Como você usaria
transações em um ambiente Laravel?
R:

Uma transação é um conjunto de operações SQL, e um savepoint é um ponto intermediário dentro de uma transação, permitindo que você a divida em partes menores, facilitando o rollback. Utilizaria transações para garantir a integridade dos dados ao executar operações no banco como uma única unidade, assegurando que o conjunto de operações seja concluído com sucesso ou, em caso de falha, revertido com facilidade.

##------------------------------------------------------------------------------------------------------------------------------------------------------------------

Minhas considerações: 

Por ser um projeto simples de CRUD, não optei por implementar nenhuma tarefa extremamente complexa nas consultas ao banco de dados nem nos controllers. Acredito que as classes ficaram bastante semânticas e de fácil leitura, permitindo identificar facilmente o que cada uma realiza,  seguindo os padrões de camelCase e as boas práticas.


