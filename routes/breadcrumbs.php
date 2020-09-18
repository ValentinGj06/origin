<?php

require __DIR__.'/breadcrumbs/backend/backend.php';

Breadcrumbs::for('clients.index', function ($trail) {
    $trail->push('Clients', route('clients.index'));
});

Breadcrumbs::for('clients-management.index', function ($trail) {
    $trail->push('Clients Management', route('clients-management.index'));
});

Breadcrumbs::for('categories-tags.index', function ($trail) {
    $trail->push('Categories & Tags Management', route('categories-tags.index'));
});

Breadcrumbs::for('locations.index', function ($trail) {
    $trail->push('Title Here', route('locations.index'));
});
