# Sistema Imobiliária
Sistema de cadastro de imóveis e importação de arquivo xml.

O menu Imóveis, dá acesso a tela onde será possível:
   * Ver a listagem dos imóveis cadastrados
   * Cadastrar um novo imóvel e associar uma imagem a ele.
   * Editar um imóvel. Para acessar a tela de edição, 
   basta que você clique na linha referente ao imóvel na lista de imóveis.
   * No cadastro e na edição do imóvel, ao digitar o CEP, o sistema vai
   fazer a busca na web para preenchimento dos campos de endereço. Isso ocorrerá ao tirar o foco do campo CEP.
#Requisito do servidor para funcionamento do sistema
* PHP >= 7.1.3

#Instalação
Dentro do diretório do sistema executar os seguintes comandos:

* Para baixar as dependências: <b>composer update</b>

* Depois de configurar o arquivo .env execute para criar a estrutura de dados:<b> php artisan migrate</b>
 
* Para criar o usuário padrão: <b>php artisan db:seed</b>

* Criar link simbólico da pasta storage, para que as imagens guardadas nesta pasta fiquem publicamente acessíveis. Sendo assim possível 
a exibição na lista de imóveis e edição: <b>php artisan storage:link</b>

#Dados Usuário Padrão

Login: admin@gmail.com <br>
Senha: secret
