<?php

require_once __DIR__ . '/../autoload.php';

use App\Models\Post;
use App\Models\User;


if (!$_GET['id']) {
    header('Location: /');
    exit();
}

$post = (new Post())
    -> searchById((int) $_GET['id']);
if (!$post -> getData()) {
    header('Location: /');
    exit();
}

$postData = $post->getData();
$user = (new User())->searchById($postData['userId']);
$userData = $user->getData();


?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link rel="stylesheet" href="./assets/main.css">
</head>
<body>
<main class="container max-w-sm mx-auto p-6">
        <h1 class=" text-4xl font-bold text-center py-4"><?php print($post -> getData()['title']); ?></h1>
        <h2 class="text-xl text-center mb-2 text-gray-700">Written by: <?php echo htmlspecialchars($userData['name']); ?> (<?php echo htmlspecialchars($userData['email']); ?>)</h2>
        <aside class="max-w-sm mx-auto my-10">
            <a href="/" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Return back</a>
        </aside>
        <section class="max-w-sm">
            <p><?php print(nl2br($post -> getData()['body'])); ?></p>
        </section>
    </main>
</body>
</html>