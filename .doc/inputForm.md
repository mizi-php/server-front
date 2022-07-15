### InstanceInputForm

Modo de criar raídamente ações para formulários seguros no frontend

### Criando formulários na [view](https://github.com/mizi-php/server-back/blob/main/.doc/view.md)

Para que um formulário da view seja validado corretamente, é preciso ter um cmapo **formKey** com o valor da chave de formulário.
A chave pode ser recuperada com o Helper de view [#form.key]

    <input type='hidden' name='formKey' value='[#form.key]'>
    OU
    [#form.key.tag]

### Backend

    use Mizi\InstanceInputForm;

    $form = new InstanceInputForm('formName');

> Você pode não fornecer o nome do formulário, o sistema cria um nome automático baseado-se na URL atual

A classe **InstanceInputForm** retorna uma **InputException 403** sempre que o nome do formulário não estiver correto
A classe **InstanceInputForm** retorna uma **InputException 400** sempre que um campo não for validado corretamente

A classe **InstanceInputForm** é uma extensão da classe de servidor [InstanceInput](https://github.com/mizi-php/server-back/blob/main/.doc/input.md).
