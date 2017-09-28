<?php

if (! function_exists('me')) {
    function me()
    {
        return auth()->user();
    }
}