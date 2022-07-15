<?php

use Mizi\Cif;
use Mizi\Input\InstanceInputForm;
use Mizi\View;

View::prepare(
    'form.key',
    fn (?string $name = null) => Cif::on(InstanceInputForm::getFormKey($name))
);

View::prepare(
    'form.key.tag',
    function (?string $name = null) {
        $key = Cif::on(InstanceInputForm::getFormKey($name));
        return prepare('<input type="hidden" name="formKey" value="[#]">', $key);
    }
);