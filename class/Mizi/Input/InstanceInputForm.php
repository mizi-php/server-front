<?php

namespace Mizi\Input;

use Mizi\Cif;
use Mizi\Code;
use Mizi\Session;

class InstanceInputForm extends InstanceInput
{
    function __construct(?string $name = null, ?array $data = null)
    {
        $name = $name ?? Code::on(url(0));
        parent::__construct($data);
        if ($name) {
            $formKey = self::getFormKey($name);
            $recivedKey = Cif::off($this->data['formKey'] ?? '');
            if (!Code::compare($recivedKey, $formKey)) {
                throw new InputException('Formulário recusado', STS_FORBIDDEN);
            }
        }
    }

    /** Retorna a chave esperada para um nome de formulário */
    static function getFormKey(string $name = null): string
    {
        $name = $name ?? Code::on(url(0));

        if (!Session::check('__form__'))
            Session::set('__form__',  Code::on(uniqid()));

        return Code::on(Session::get('__form__') . $name);
    }
}