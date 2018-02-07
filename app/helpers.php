<?php

function me()
{
    return auth()->user();
}

function is_email($login)
{
    return filter_var($login, FILTER_VALIDATE_EMAIL);
}
