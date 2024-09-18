<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $d1 = new DateTime($_POST['date1']);
    $d2 = new DateTime($_POST['date2']);
    $interval = $d1->diff($d2);
    $_SESSION['days'] = $interval->days;
    $_SESSION['minutes'] = ($interval->days * 24 * 60) + ($d1->getTimestamp() - $d2->getTimestamp()) / 60;
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

$days = $_SESSION['days'] ?? '';
$minutes = $_SESSION['minutes'] ?? '';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Разница между датами</title>
</head>
<body>
    <h1>Ввод дат</h1>
    <form method="post">
        <input type="date" name="date1" required>
        <input type="date" name="date2" required>
        <button type="submit">Узнать разницу</button>
    </form>
    <?php if ($days !== ''): ?>
        <h2>Результаты:</h2>
        <p>Дней: <strong><?= $days ?></strong></p>
        <p>Минут: <strong><?= $minutes ?></strong></p>
    <?php endif; ?>
</body>
</html>