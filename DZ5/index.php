<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма с AJAX</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Форма отправки данных</h2>

    <form>
        <label>Имя:</label><br>
        <input type="text" id="name"><br>

        <label>Email:</label><br>
        <input type="email" id="email"><br>

        <label>Возраст:</label><br>
        <input type="number" id="age"><br>

        <label>Специальность:</label><br>
        <input type="text" id="specialty"><br>

        <label>Опыт работы:</label><br>
        <input type="text" id="experience"><br><br>

        <button type="button" id="submitButton">Отправить</button>
    </form>

    <p id="errorMessage" style="color: red;"></p>
    <h3>Данные из файла:</h3>
    <div id="output"></div>

    <script>
        $('#submitButton').on('click', function () {
            const name = $('#name').val().trim();
            const email = $('#email').val().trim();
            const age = parseInt($('#age').val().trim());
            const specialty = $('#specialty').val().trim();
            const experience = $('#experience').val().trim();
            const errorMessage = $('#errorMessage');
            const outputDiv = $('#output');

            errorMessage.text('');
            outputDiv.html('');

            if (!name || !email || isNaN(age) || !specialty || !experience) {
                errorMessage.text('Пожалуйста, заполните все поля.');
                return;
            }
            if (age <= 20) {
                errorMessage.text('Возраст должен быть больше 20 лет.');
                return;
            }

            $.ajax({
                url: 'process.php',
                type: 'POST',
                data: {
                    name: name,
                    email: email,
                    age: age,
                    specialty: specialty,
                    experience: experience
                },
                success: function (response) {
                    alert(response); 

                    $.get('data.txt', function (data) {
                        outputDiv.html('<pre>' + data + '</pre>');
                    }).fail(function () {
                        outputDiv.text('Не удалось загрузить данные из файла.');
                    });
                },
                error: function () {
                    alert('Произошла ошибка, попробуйте позже.');
                }
            });
        });
    </script>
</body>
</html>
