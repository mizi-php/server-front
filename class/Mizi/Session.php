<?php

namespace Mizi;

abstract class Session
{
    abstract protected function __construct();

    /** Retorna o valor de uma variavel de sessão */
    static function get(string $name): mixed
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            $return = $_SESSION[$name] ?? null;
            if (substr($name, 0, 1) == '#') {
                self::remove($name);
            }
        }
        return $return ?? null;
    }

    /** Define um valor para uma variavel de sessão */
    static function set(string $name, mixed $value): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            $_SESSION[$name] = $value;
        }
    }

    /** Verifica se uma variavel de sessão existe ou se tem um valor igual ao fornecido */
    static function check(string $name): bool
    {
        if (func_num_args() > 1) {
            return boolval(self::get($name) == func_get_arg(1));
        } else {
            return !is_null(self::get($name));
        }
    }

    /** Remove uma variavel de sessão */
    static function remove(string $name): void
    {
        self::set($name, null);
    }

    /** Destroi a sessão atual e inicializa uma nova sessão */
    static function refresh(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id();

            $SESSION_ID = Code::on(session_id() . '__' . uniqid());

            session_destroy();

            session_id(Cif::on($SESSION_ID));

            session_start();

            self::set('___SESSION___', $SESSION_ID);
        }
    }
}

(function () {
    if (!IS_TERMINAL) {

        $SESSION_TIME = env('SESSION_TIME') * 60;
        session_cache_expire($SESSION_TIME);

        $COOKIE_TIME = env('COOKIE_TIME') * 60 * 60;
        session_set_cookie_params($COOKIE_TIME, '/', '', true, true);

        session_name(Code::on('MIZI_SESSION_ID'));

        session_start();

        if (
            !Cif::check(session_id())
            || !Session::check('___SESSION___')
            || !Cif::compare(Session::get('___SESSION___'), session_id())
        ) {
            Session::refresh();
        }
    }
})();