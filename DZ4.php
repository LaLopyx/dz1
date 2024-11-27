<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$uploadDir = "C:/MAMP/htdocs/DZ2/uploads/";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image'])) {
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['image'];
            $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
            if (strtolower($fileExtension) === 'jpg' || strtolower($fileExtension) === 'jpeg') {
                $uniqueName = substr(md5(date('Y-m-d H:i:s')), 0, 16) . '.jpg';
                $uploadFilePath = $uploadDir . $uniqueName;

             
                if (!is_dir($uploadDir)) {
                    echo "Ошибка: Директория загрузки не существует.";
                    exit;
                }

               
                if (move_uploaded_file($file['tmp_name'], $uploadFilePath)) {
                    echo "Файл успешно загружен: $uniqueName";
                } else {
                    echo "Ошибка: не удалось переместить файл в $uploadFilePath.";
                }
            } else {
                echo "Ошибка: файл не является изображением JPG.";
            }
        } else {
            echo "Ошибка загрузки файла: " . $_FILES['image']['error'];
        }
    } else {
        echo "Файл не был загружен.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Загрузка изображения</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="image">Выберите файл (только JPG):</label>
        <input type="file" name="image" id="image" accept="image/jpeg" required>
        <button type="submit">Загрузить</button>
    </form>
</body>
</html>