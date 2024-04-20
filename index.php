<?php

    require './functions.php';

    $fileName = 'data.json';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['name'], $_POST['phone'])) {

            addContact($fileName, $_POST['name'], $_POST['phone']);
        } 
        
        elseif (isset($_POST['delete'])) {

            deleteContact($fileName, $_POST['delete']);
        }

        header("Location: " . $_SERVER['PHP_SELF']);

        exit;
    }

    $contacts = getContacts($fileName);
?>

<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="./style.css">

        <title>Телефонный справочник</title>

    </head>

        <body>

            <div class="container">

                <h1>Телефонный справочник</h1>

                <ul>

                    <?php foreach ($contacts as $index => $contact): ?>

                        <li>

                            <?= htmlspecialchars($contact['name'], ENT_QUOTES, 'UTF-8') ?> : <?= htmlspecialchars($contact['phone'], ENT_QUOTES, 'UTF-8') ?>

                            <form method="post" style="display: inline;">

                                <button type="submit" name="delete" value="<?= $index ?>">Удалить</button>

                            </form>

                        </li>

                    <?php endforeach; ?>

                </ul>

                <h2>Новый контакт</h2>

                <form method="post">

                        <input type="text" name="name" placeholder="Имя" required>

                        <input type="text" name="phone" class="mask-phone form-control" placeholder="Номер телефона" required>

                        <button type="submit">Добавить контакт</button>
                        
                </form>

            </div>
        
        </body>

        <script src="./jquery.maskedinput-master/lib/jquery-1.9.0.min.js" ></script>

        <script src="./jquery.maskedinput-master/src/jquery.maskedinput.js"></script>

        <script>

            $.mask.definitions['h'] = "[0|1|3|4|5|6|7|9]"
    
            $(".mask-phone").mask("+7 (h99) 999-99-99");
        
        </script>

</html>