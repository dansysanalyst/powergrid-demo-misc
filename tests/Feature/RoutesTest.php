<?php
declare(strict_types = 1);

use function Pest\Laravel\get;

test('routes', function (string $route) {
    get(route($route))->AssertOk();
})->with([
    'simple',
    'striped',
    'header-fixed',
    'collection',
    'join',
    'multiple',
    'filters',
    'filters-outside',
    'dish',
    'validation',
    'persist',
    'detail',
    'export',
    'batch',
    'custom-layout',
    'bulk-actions',
    'soft-delete',
    'wire-elements-modal',
    'powergrid-demo',
]);
