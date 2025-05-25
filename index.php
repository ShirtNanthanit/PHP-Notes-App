<?php require 'db.php' ?>

<?php


// Add notes
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['note'])) {
    $stmt = $pdo->prepare("INSERT INTO notes (content) VALUES (:content)");
    $stmt->execute(['content' => htmlspecialchars($_POST['note'])]);
}



// Get all notes from DB
$stmt = $pdo->prepare("SELECT * FROM notes ORDER BY id DESC");
$stmt->execute();
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/128/768/768818.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Notes</title>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen px-4 py-4">

    <div class="max-w-xl mx-auto mb-8">
        <h1 class="text-3xl font-semibold mb-6 text-center">Notes</h1>

        <form method="post">
        <textarea name="note" required
            class="w-full p-4 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-700 resize-none"
            placeholder="Write your note here..."></textarea>
        <button type="submit"
            class="mt-2 mb-2 bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition">Add</button>
        </form>
  </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl mx-auto px-4">
        <?php foreach ($notes as $note): ?>
            <div class="bg-white p-4 border border-gray-200 shadow-sm rounded-md 
            max-h-80 overflow-hidden cursor-pointer" onclick="this.classList.toggle('max-h-full')">
                <div class="mb-2 text-sm text-right space-x-2">
                    <a href="edit.php?id=<?= $note['id'] ?>" class="text-blue-500 hover:underline">Edit</a>
                    <a href="delete.php?id=<?= $note['id'] ?>" class="text-red-500 hover:underline"
                        onclick="return confirm('Delete this note?')">Delete</a>
                </div>

                <p class="whitespace-pre-line"><?= htmlspecialchars($note['content']) ?></p>

            </div>
        <?php endforeach; ?>
    </div>



</body>

</html>