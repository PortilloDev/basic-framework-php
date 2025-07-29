<?php 

$title = "Create new post";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $excerpt = $_POST['excerpt'] ?? '';
    $content = $_POST['content'] ?? '';

    $errors = [];

    if (!$title) {
        $errors[] = 'El título es obligatorio.';
    }

    if (!$excerpt) {
        $errors[] = 'El extracto es obligatorio.';
    }

    if (!$content) {
        $errors[] = 'El contenido es obligatorio.';
    }

    if (empty($errors)) {
       $db->query('INSERT INTO posts (title, excerpt, content) VALUES (:title, :excerpt, :content)', [
           'title' => $title,
           'excerpt' => $excerpt,
           'content' => $content
       ]);
        $_SESSION['success'] = 'Publicación creada exitosamente.';
       
        // Redirect to the links page
        header('Location: /');
        exit;
    }

}

require __DIR__ . '/../../resources/posts-create.template.php';