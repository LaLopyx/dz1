<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма заполнения</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
            margin: auto;
        }
        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <h1>Форма заполнения</h1>
    <form id="userForm">
        <label for="name">Имя:</label><br>
        <input type="text" id="name" name="name"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>

        <label for="age">Возраст:</label><br>
        <input type="number" id="age" name="age"><br><br>

        <label for="specialty">Специальность:</label><br>
        <input type="text" id="specialty" name="specialty"><br><br>

        <label for="experience">Стаж работы:</label><br>
        <input type="text" id="experience" name="experience"><br><br>

        <button type="button" id="submitButton">Отправить</button>
        <p id="errorMessage" class="error"></p>
    </form>

    <script>
        document.getElementById('submitButton').addEventListener('click', function() {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const age = parseInt(document.getElementById('age').value.trim());
            const specialty = document.getElementById('specialty').value.trim();
            const experience = document.getElementById('experience').value.trim();
            const errorMessage = document.getElementById('errorMessage');

            // Очистка сообщения об ошибке
            errorMessage.textContent = '';

            // Проверка заполненности всех полей и возраста
            if (!name || !email || isNaN(age) || !specialty || !experience) {
                errorMessage.textContent = 'Пожалуйста, заполните все поля.';
                return;
            }
            if (age <= 20) {
                errorMessage.textContent = 'Возраст должен быть больше 20 лет.';
                return;
            }

            // AJAX-запрос
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'process.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert(xhr.responseText); // Отображение ответа от сервера
                } else {
                    alert('Произошла ошибка, попробуйте позже.');
                }
            };

            const data = `name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&age=${age}&specialty=${encodeURIComponent(specialty)}&experience=${encodeURIComponent(experience)}`;
            xhr.send(data);
        });
    </script>
</body>
</html>