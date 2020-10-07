<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include_once('clases/classNotas.php');
    $objeto = new Notas("1","101","1","1","3.2","50","1");

    echo "<h2>$objeto</h2>";
    ?>
</body>
</html>