<?php

if (! function_exists('is_email')) {
    function is_email($login)
    {
        return filter_var($login, FILTER_VALIDATE_EMAIL);
    }
}

if (! function_exists('me')) {
    function me()
    {
        return auth()->user();
    }
}