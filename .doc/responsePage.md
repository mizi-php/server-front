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
Para um objeto de página como resposta, use a middleware abaixo

    function (callable $next)
    {
        $return = $next();

        if (!is_class($return, InstanceResponse::class))
            $return = new InstanceResponsePage($return);

        return $return;
    }