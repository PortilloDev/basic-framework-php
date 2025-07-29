<?php 

$title = "Create new project";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validator = new Validator($_POST, [
        'title' => 'required|min:3|max:190',
        'url' => 'required|url|max:190',
        'description' => 'required|min:3|max:500'
    ]);


    if (! $validator->fails()) {
        $db->query('INSERT INTO links (title, url, description) VALUES (:title, :url, :description)', [
            'title' => $_POST['title'],
            'url' => $_POST['url'],
            'description' => $_POST['description']
        ]);

        // Redirect to the links page or show success message
        $_SESSION['success'] = 'Enlace creado exitosamente.';
        header('Location: /links');
        exit;
    } else {
              $errors = $validator->errors();
    }
}

require __DIR__ . '/../../resources/links-create.template.php';