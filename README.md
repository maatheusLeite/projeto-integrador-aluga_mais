# Projeto Integrador - Aluga+ 

## Descrição do Projeto
<p>
Este projeto apresenta um sistema de login e cadastro de usuários únicos, separados por email e senha, onde cada usuário pode visualizar localidades publicadas por outros usuários, publicar suas proprias localidades e exclui-las.
</p>

<p> 
<h3> AVISO </h3>
O projeto não possui todos os commits feitos desde seu inicio pois, após um erro no XAMPP Server, foi necessário realizar sua reinstalação
em minha maquina e, após realizar alterações no codigo fonte e pastas do projeto, não estava conseguindo enviar novas adições para este repositório remoto.
Para resolver o problema precisei utilizar o comando "git push -f origin master", e assim acabei sobrescrevendo a branch que continha os 13 commits
do projeto. Gostaria de que fosse possivel a visualização de todos os comits, pois eles mostravam muito sobre o processo de criação e evolução deste 
projeto, assim como a linha de raciocinio utilizada para realizar os problemas encontrados. 
</p>

<h2> Instruções e recomendações </h2>
<p> 
<h4> Recursos Utilizados </h4>
O projeto foi desenvolvido com o uso do servidor web <b> XAMPP Server </b>, que pode ser instalado tanto em maquinas windows ou linux. O XAMPP Server possui o Web Server Apache, utilizando a versão da linguagem PHP 8.1 e o SGBD MySQL para o armazenamento de dados.
Em caso de problemas de autorização ao salvar imagens, é necessario conceder permissão de escrita para a pasta posts.

<h4> Instruções de uso </h4>
Para que o tudo funcione da maneira correta, é necessário utilizar os scripts SQL para criação da base de dados que podem ser encontrados na pasta DOCS no seguinte caminho do repositório  <i><b> projeto-integrador/src/docs/ </b></i>. Nesta mesma pasta, também está disponivel o diagrama entidade relacionamento, utilizado para a modelagem do banco.
Após criar a base de dados, é necessário mover a pasta <b> SRC </b> (que é a pasta base do projeto) para a pasta base do apache web server utilizado, no caso do XAMPP Server, é necessário mover a pasta SRC para dentro da pasta <b> htdocs </b>, e por meio de seu navegador, ir até o caminho <i><b> localhost/src/pages/controller/index.php </b></i>.
</p>

<h2> Funcionalidades </h2>
<p> 
<ul>
<li> Login único para cada usuário: Cada usuário é unico, sendo necessário informar um email diferente dos já cadastrados no banco para cadastrar um novo usuário. </li>
<li> Senhas criptografadas na base de dados: As senhas ficam armazenadas na base de dados em forma de HASH, o que oculta seu conteúdo em caso de consultas no banco. </li>
<li> Localidades: Cada usuário pode postar inúmeras localidades, cada uma com inúmeras imagens vinculadas, também podendo excluir cada localidade caso deseje. </li>
<li> Diversas imagens: Cada localidade salva pode conter diversas imagens. Cada imagem fica salva no servidor na pasta <b> posts </b>, sendo vinculada às localidade por meio de sua URL, que fica salva em uma tabela da base de dados. </li>








