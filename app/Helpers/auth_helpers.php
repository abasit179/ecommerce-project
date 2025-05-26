<?php

use Illuminate\Support\Facades\Session;

if (!function_exists('isAdminAuthenticated')) {
    function isAdminAuthenticated()
    {
        // Check if admin is logged in (this can be a session check, for example)
        return Session::has('admin_logged_in') && Session::get('admin_logged_in') === true;
    }
}
