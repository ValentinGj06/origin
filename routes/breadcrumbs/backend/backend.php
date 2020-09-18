<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

Breadcrumbs::for('client.index', function ($trail) {
    $trail->push('Title Here', route('client.index'));
});

require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';
