<?php

namespace Mizi;

use Exception;
use Mizi\Response\InstanceResponseFile;

abstract class Assets
{
    protected static $map = [];

    /** Envia um arquivo assets requisitado via URL */
    static function send(string $path, array $allowTypes = []): never
    {
        self::getResponseFile($path, $allowTypes)
            ->send();
    }

    /** Realiza o download de um arquivo assets requisitado via URL */
    static function download(string $path, array $allowTypes = []): never
    {
        self::getResponseFile($path, $allowTypes)
            ->download(true)
            ->send();
    }

    /** Retorna o ResponseFile do arquivo */
    protected static function getResponseFile(string $path, array $allowTypes): InstanceResponseFile
    {
        $path = [$path];
        foreach (Router::data() as $name => $value)
            if (is_numeric($name))
                $path[] = $value;

        $path = path(...$path);

        if (!File::check($path) || !self::checkAllowType($path, $allowTypes))
            throw new Exception("file not found", STS_NOT_FOUND);

        return (new InstanceResponseFile)
            ->content($path);
    }

    /** Verifica se o arquivo é de alguma extensão permitida */
    protected static function checkAllowType($path, $allowTypes)
    {
        if (!empty($allowTypes)) {
            $ex = explode('.', $path);
            $ex = array_pop($ex);
            $ex = strtolower($ex);

            return in_array($ex, $allowTypes);
        }
        return true;
    }
}