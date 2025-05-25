<?php

require 'db.php';

$id = $_GET['id'] ?? null;

if(!$id) exit('Invalid ID');

// Update note
if($_SERVER['REQUEST_METHOD'] === "POST" && !empty(htmlspecialchars($_POST['update']))){
    $stmt = $pdo->prepare("UPDATE notes SET content = :content WHERE id = :id");
    $stmt->execute([
        'content' => htmlspecialchars($_POST['update']),
        'id' => $id
    ]);
    header('Location: index.php');
    exit;

}


$stmt = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
$stmt->execute([
    'id' => $id
]);
$note = $stmt->fetch(PDO::FETCH_ASSOC);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <title>Edit</title>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex justify-center items-center px-4">
    <div class="bg-white max-w-xl w-full p-6 rounded-lg shadow-md min-h-[600px]">
        <form action="" method="post">
            <textarea name="update" required class="rounded-sm w-full p-4 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-grey-400 
            resize-none mb-4 h-120"><?= htmlspecialchars($note['content'])?></textarea>
            
            <div class="text-right">
                <button type="submit" class="rounded-md bg-gray-800 text-white px-4 py-2 hover:bg-gray-600 transition">Edit</button>
            </div>
            
        </form>
    </div>
</body>
</html>