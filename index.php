<?php
session_start();

if (isset($_POST['ok'])) {
    $_SESSION['ekstr1'][$_SESSION['count']] = $_POST['setEkstr1'];
    $_SESSION['ekstr2'][$_SESSION['count']] = $_POST['setEkstr2'];
    $_SESSION['ekstr3'][$_SESSION['count']] = $_POST['setEkstr3'];
    $_SESSION['user'][$_SESSION['count']] = $_POST['setNumber'];

    ($_POST['setEkstr1'] == $_POST['setNumber']) ? $_SESSION['trust1'][$_SESSION['count']] = 1 : $_SESSION['trust1'][$_SESSION['count']] = 0;
    ($_POST['setEkstr2'] == $_POST['setNumber']) ? $_SESSION['trust2'][$_SESSION['count']] = 1 : $_SESSION['trust2'][$_SESSION['count']] = 0;
    ($_POST['setEkstr3'] == $_POST['setNumber']) ? $_SESSION['trust3'][$_SESSION['count']] = 1 : $_SESSION['trust3'][$_SESSION['count']] = 0;
}

$ekstr1All = ''; $ekstr2All = ''; $ekstr3All = '';
$userAll = '';
$trust1 = 0; $trust2 = 0; $trust3 = 0;  $trustCount =1;
if (!isset($_SESSION['count'])) {
    $_SESSION['count'] = 1;
} else {
    $trustCount = $_SESSION['count'];
    $_SESSION['count']++;

    for ($i=1; $i<$_SESSION['count']; $i++) {
        ($i == 1) ? $symbol = ' ': $symbol = ', ';
        $ekstr1All = $ekstr1All.$symbol.$_SESSION['ekstr1'][$i];
        $ekstr2All = $ekstr2All.$symbol.$_SESSION['ekstr2'][$i];
        $ekstr3All = $ekstr3All.$symbol.$_SESSION['ekstr3'][$i];

        $userAll = $userAll.$symbol.$_SESSION['user'][$i];

        $trust1 += $_SESSION['trust1'][$i];
        $trust2 += $_SESSION['trust2'][$i];
        $trust3 += $_SESSION['trust3'][$i];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Тест</title>
</head>
<body>
<form method="post">
    <h3>Веб-приложение для проведения тестирования экстрасенсов</h3>
    <hr>
    <span style="color:#db1689"> Загадайте двухзначное число и нажмите кнопку => </span>
    <input  type="button" value="ok" onclick="start();">

    <div id="myDiv" style="display:none";>
        <br>
        <span style="color:#008080"> Экстрасенсы считают,что вы загадали указанные числа: </span>
        <table border="1">
            <tr>
                <td>Экстрасенс 1</td>
                <td>Экстрасенс 2</td>
                <td>Экстрасенс 3</td>
            </tr>
            <tr align="center">
                <td> <input type="text" name="setEkstr1" id="setEkstr1" size="5" readonly> </td>
                <td> <input type="text" name="setEkstr2" id="setEkstr2" size="5" readonly> </td>
                <td> <input type="text" name="setEkstr3" id="setEkstr3" size="5" readonly> </td>
            </tr>
        </table>
        <br>
        <span style="color:#008080"> Введите двухзначное число, которое вы загадали: </span>
        <br>
        <input type="text" name="setNumber" id="setNumber" placeholder="Например, 11">
        <input type="submit" value="ok" name="ok" onclick="ok();">
     </div>

    <hr>
    <div id="info">
        <span style="color:#008080"> История догадок экстрасенсов: </span>
        <table border="1">
            <tr>
                <td>Экстрасенс 1</td>
                <td> <? echo $ekstr1All ?> </td>
            </tr>
            <tr>
                <td>Экстрасенс 2</td>
                <td> <? echo $ekstr2All ?> </td>
            </tr>
            <tr>
                <td>Экстрасенс 3</td>
                <td> <? echo $ekstr3All ?> </td>
            </tr>
        </table>

        <br>
        <span style="color:#008080"> История чисел пользователя: </span>
        <table border="1">
            <tr>
                <td>Пользователь</td>
                <td> <? echo $userAll ?> </td>
            </tr>
        </table>

        <br>
        <span style="color:#008080"> Достоверность (кол-во правильных ответов / к общему числу догадок): </span>
        <table border="1">
            <tr>
                <td>Экстрасенс 1</td>
                <td> <? echo ($trust1 / $trustCount) ?> </td>
            </tr>
            <tr>
                <td>Экстрасенс 2</td>
                <td> <? echo ($trust2 / $trustCount)  ?> </td>
             </tr>
            <tr>
                <td>Экстрасенс 3</td>
                <td> <? echo ($trust3 / $trustCount)  ?> </td>
            </tr>
        </table>
    </div>
</form>

<script src="https://unpkg.com/imask"> </script>
<script>
    var element = document.getElementById('setNumber');
    var maskOptions = {
        mask: '00',
        lazy: false
    }
    var mask = new IMask(element, maskOptions);

    function start() {
        let arr = [];
        for (let i=1; i<4; i++) {
            arr[i] = Math.floor(Math.random() * 90 ) + 10;
        }

        document.getElementById('setEkstr1').value = arr[1];
        document.getElementById("setEkstr2").value = arr[2];
        document.getElementById("setEkstr3").value = arr[3];

        document.getElementById("myDiv").style.display = "block";
    }
</script>

</body>
</html>


