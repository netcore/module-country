<?php

require __DIR__ . '/helpers.php';
require __DIR__ . '/Http/breadcrumbs.php';

if (!app()->routesAreCached()) {
    require __DIR__ . '/Http/routes.php';
}