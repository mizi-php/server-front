### InstanceResponsePage

Controla a página de resposta da requisição

### Template
Defina um template para a página com o metodo estatico **template**

    InstanceResponsePage::template('viewName');

O template deve estar dentro da view **_page**

Você pode definir variaveis de prepare especificas para a página de retorno

    InstanceResponsePage::prepare('var','value');


### Enviando uma respsota
Crie objeto de respota normalmente

    use Mizi\Response\InstanceResponsePage;

    $response = new InstanceResponsePage('content')

Ao enviar o objeto, o conteúdo será encapsulado dentro da view de template.

### Middleware
Existe uma middleware disponivel para garantir que a resposa seja uma ReponsePage.
Para utiliza-la, chame-a em suas configurações de rota

    Router::middleware('route',['page']);