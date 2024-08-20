<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/lab4/textLogic.php');
presets();
$result = convertText();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/Project/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="/Project/css/style.css" rel="stylesheet">
    <title>Text</title>
</head>

<body>
    <div class="container" style="margin-top: 20px; margin-bottom: 20px;">
        <center>
            <form method="post">
                <textarea class="form-control" name="task" id="task" cols="30" rows="10"></textarea>
                <button type="submit" class="btn btn-success">Отправить</button>
                <div id="outputText">
                    <?php foreach($result as $res) {
                        echo ($res);
                    }?>
                </div>
            </form>
        </center>
    </div>
</body>