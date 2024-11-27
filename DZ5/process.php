
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $age = (int) $_POST['age'];
    $specialty = htmlspecialchars(trim($_POST['specialty']));
    $experience = htmlspecialchars(trim($_POST['experience']));

    // Проверка валидности данных
    if (empty($name) || empty($email) || empty($specialty) || empty($experience) || $age <= 20) {
        echo "Некорректные данные.";
        exit;
    }

    // Формирование строки для записи
    $data = "Имя: $name\nEmail: $email\nВозраст: $age\nСпециальность: $specialty\nСтаж работы: $experience\n\n";

    // Запись в файл
    $file = 'data.txt';
    if (file_put_contents($file, $data, FILE_APPEND)) {
        echo "Данные успешно сохранены!";
    } else {
        echo "Ошибка сохранения данных.";
    }
}
