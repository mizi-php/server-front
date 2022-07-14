<?php

namespace Mizi\Response;

class InstanceResponsePage extends InstanceResponse
{
    protected static ?string $template = '_page.simple';
    protected static array $prepare = [];

    /** Modifica a view de template */
    static function template(string $template): void
    {
        static::$template = $template;
    }

    /** Adiciona itens ao prepare do template */
    static function prepare(string $name, mixed $value): void
    {
        static::$prepare[$name] = $value;
    }

    /** Prepara o objeto para ser enviado */
    protected function prepareContent(): void
    {
        if (!is_array($this->content) && !is_class($this->content, static::class)) {
            if (!str_starts_with(self::$template, '_page.'))
                self::$template = "_page." . self::$template;

            $this->content =  view(self::$template, [
                ...self::$prepare,
                'content' => $this->content
            ]);
        }
        parent::prepareContent();
    }
}