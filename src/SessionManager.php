<?php

class SessionManager
{
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function login($id, $name): void
    {
        self::start();
        $_SESSION['user_id'] = $id;
        $_SESSION['user_name'] = $name;
    }

    public static function isLoggedIn(): bool
    {
        self::start();
        return isset($_SESSION['user_id']);
    }

    public static function logout(): void
    {
        self::start();

        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }

        session_destroy();
    }
}
