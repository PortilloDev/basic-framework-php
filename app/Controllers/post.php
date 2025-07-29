<?php

$title = 'My Posts';

$post = $db->query('SELECT * FROM posts WHERE id = :id', [
    'id' => $_GET['id'] ?? 0
])->firstOrFail();

require __DIR__ . '/../../resources/post.template.php';