<?php
# Это массив где хранятся все данные формы
$form = [
    "stage1" => [
        "initials" => ["name" => "Ваше имя", "surname" => "Ваша Фамилия", "father" => "Отчество"],
        "professionSelect" => ["engineer" => "Инженер", "hacker" => "Хакер", "programmer" => "Программист", "policemen" => "Полицейский", "other" => "Другое"],
    ],
    "stage2" => [
        "music" => ["pop" => "Поп-музыка", "rock" => "Рок-музыка", "soul" => "Соул-музыка", "anotherMusic" => "Другая-музыка"],
        "films" => ["horror" => "Ужастики", "comedy" => "Комедии", "action" => "Боевики", "anotherFilms" => "Другие"],
        "text" => ["preferencessM" => "Напишите что-нибудь про музыку", "preferencessF" => "Напишите что-нибудь про фильмы"]
    ],
    "stage3" => [
        "animals" => ["cat" => "Кошка", "dog" => "Собака", "cat&dog" => "Кошка и собака", "chimp" => "Мартышка", "noAnimal" => "У меня нет животных"],
        "text1" => ["moniker" => "Кличка"],
        "text2" => [ "noMoniker" => "Почему у вас нет питомца?"],
        "text3" => [ "wish" => "Напишите кого хотите купить?"]
    ],
    "button" => ["button1()", "button2()"]

];
# Подключаем функции
# Функция вставки поля для текста.
# Принимает массив и значение "обязательное поле" и вставляет поле формы для ввода текста
function inputText(array $array,string $class = null,$hidden = null){
    $class? $var = $class: $var = null;
    $hidden? $var1 = $hidden: $var1 = "text";
    foreach ($array as $key => $value)
        echo"<input type=\"$var1\" name=\"$key\" placeholder=\"$value\" class=\"$var\">";
}
# Функция принимающая массив и вставляющая значения выпадающего меню
function inputSelect(array $array){
    foreach ($array as $key => $value)
        echo "<option value=\"$value\">$value</option>";
    
}
# Функция вставляющая баттон, принимает значение для ссылки и тип инпута
function inputButton($ref, string $type=null) {
    $var =  $type? $type : "button" ;
    echo "<a href=\"javascript:$ref\"><input type=\"$var\" value=\"Отправить\" class=\"button\"></a>";
}
# Функция принимающая массив и вставляющая чекбоксы
function inputCheckbox(array $array, string $type){
    foreach ($array as $key => $value)
        echo "<label for=\"$key\">$value</label><input type=\"$type\" name=\"$key\" value=\"$value\" id=\"$key\">";
}
# Функция принимающая массив и вставляющая радиобаттоны
function inputRadio(array $array){
    foreach ($array as $key => $value)
        echo "<input type=\"radio\" name=\"animals\" value=\"$value\" id=\"$key\"> <label for=\"$key\">$value</label>";
    
}
# Общие переменные hidden
$hiddenStage1 = "";
$hiddenStage2 = "hidden";
$hiddenStage3 = "hidden";
$button1 = isset($_POST["button1"]);
$button2 = isset($_POST["button2"]);
$button3 = isset($_POST["button3"]);
# Hidden для баттонов
$buttonHide1 = "submit";
$buttonHide2 = "hidden";
$buttonHide3 = "hidden";
# Переменные формы stage1
$name =isset($_POST["name"])? filter_input(INPUT_POST,"name",FILTER_SANITIZE_STRING): "";
$surname = isset($_POST["surname"])? filter_input(INPUT_POST,"surname",FILTER_SANITIZE_STRING): "";
$father = isset($_POST["surname"])? filter_input(INPUT_POST,"father",FILTER_SANITIZE_STRING): "";
$profession = isset($_POST["professionSelect"])? $_POST["professionSelect"]:"";
$stage1= "$name<br>$father</br>$surname<br>$profession<br>";
#setcookie("stage1Cookie",$stage1, time()+3600);
# Переменные формы stage2
# Первый чекбокс - музыка
$pop = isset($_POST["pop"])? ($_POST["pop"]): "" ;
$rock = isset($_POST["rock"])? ($_POST["rock"]): "" ;
$soul = isset($_POST["soul"])? ($_POST["soul"]): "" ;
$anotherMusic = isset($_POST["anotherMusic"])? ($_POST["anotherMusic"]): "" ;
$music = "$pop $rock $soul $anotherMusic";
# Второй чекбокс - фильмы
$filmsKeys = array_keys($form["stage2"]["films"]);
$horror = isset($_POST["$filmsKeys[0]"]) ? $_POST["$filmsKeys[0]"]: "";
$comedy = isset($_POST["$filmsKeys[1]"]) ? $_POST["$filmsKeys[1]"]: "";
$action = isset($_POST["$filmsKeys[2]"]) ? $_POST["$filmsKeys[2]"]: "";
$anotherFilms= isset($_POST["$filmsKeys[3]"]) ? $_POST["$filmsKeys[3]"]: "";
$films = "$horror $comedy $action $anotherFilms";
# Текст
$textM = isset($_POST["preferencessM"]) ? filter_input(INPUT_POST,"preferencessM",FILTER_SANITIZE_STRING): "";
$textF = isset($_POST["preferencessF"]) ? filter_input(INPUT_POST,"preferencessF",FILTER_SANITIZE_STRING): "";
# Сркытое поле
$hiddenText2 = isset($_POST["hiddenText2"])? $_POST["hiddenText2"]: "";
# Общая переменная для Stage2
$stage2 = "$hiddenText2<br>$music<br>$textM</br>$films<br>$textF<br>";
#setcookie("stage2Cookie",$stage2, time()+3600);
# Переменные формы stage3
$animal = isset($_POST["animals"])? ($_POST["animals"]): "" ;
$moniker = isset($_POST["moniker"])? ($_POST["moniker"]): "" ;
$noMoniker = isset($_POST["noMoniker"])? ($_POST["noMoniker"]): "" ;
# Сркытое поле
$hiddenText3 = isset($_POST["hiddenText3"])? $_POST["hiddenText3"]: "";
# Общая переменная для Stage3
$stage3 = "$hiddenText3<br>$animal<br>$moniker<br>$noMoniker";
#setcookie("stage3Cookie",$stage3, time()+3600);
# Переключатели
# С первого на второй
if($button1=="button1") {
    $hiddenStage2 = "";
    $hiddenStage1 = "hidden";
    $buttonHide1 = "hidden";
    $buttonHide2 = "submit";
}
#  Cо второго на третий
if($button2=="button2"){
    $hiddenStage3 = "";
    $hiddenStage2 = "hidden";
    $buttonHide2 = "hidden";
    $buttonHide3= "submit";
    $hiddenStage1 = "hidden";
    $buttonHide1 = "hidden";
    
}#  Финал
if($button3=="button3"){
    $hiddenStage3 = "hidden";
    $hiddenStage2 = "hidden";
    $buttonHide2 = "hidden";
    $buttonHide3= "hidden";
    $hiddenStage1 = "hidden";
    $buttonHide1 = "hidden";
    
}




?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
    <!--Первый этап формы, передающий Фамилию, Имя и Профессию пользователя-->
    <h2 <?=$hiddenStage1 ?>>Этап 1 из 3 - Знакомство</h2>
    <form action="" method="POST">
        <fieldset <?=$hiddenStage1 ?>>
            <legend>Имя и фамилия </legend>
            <?php inputText($form["stage1"]["initials"]) ?>
        </fieldset>
        <fieldset <?=$hiddenStage1 ?>>
            <legend>Пожалуйста, расскажите нам о вашей профессии</legend>
            <label for="professionSelect">Вы:</label>
            <select name="professionSelect" id="professionSelect" required>
                <?php inputSelect($form["stage1"]["professionSelect"])?>
            </select>
        </fieldset>
        <input type="<?=$buttonHide1 ?>" value="Отправить" name="button1">
    </form>

        <!--Второй этап формы, передающий предпочтения-->
    <form action="" method="POST">
        <h2 <?=$hiddenStage2 ?>>Этап 2 из 3 - Знакомство</h2>
        <fieldset <?=$hiddenStage2 ?>>
            <legend>Ваши мызкальные предпочтения</legend>
            <?php inputCheckbox($form["stage2"]["music"],"checkbox") ?>
        </fieldset>
        <fieldset <?=$hiddenStage2 ?>>
            <legend>А фильмы вам какие нравятся</legend>
            <?php inputCheckbox($form["stage2"]["films"], "checkbox") ?>
        </fieldset>
        <fieldset <?=$hiddenStage2 ?>>
            <legend>Почему вам нравится такая музыка и фильмы?</legend>
            <?php inputText($form["stage2"]["text"]) ?>
            <input type="hidden" value="<?=$stage1?>" name="hiddenText2">
        </fieldset>
        <input type="<?=$buttonHide2 ?>" value="Отправить" name="button2">
    </form>
    
        <!--Третий этап формы, передающий предпочтения питомцев-->
    <form action="" method="POST">
        <h2 <?=$hiddenStage3 ?>>Этап 3 из 3 - Про питомцев</h2>
        <fieldset <?=$hiddenStage3 ?>>
            <legend>У вас есть?</legend>
            <?php inputRadio($form["stage3"]["animals"]) ?>
        </fieldset>
        <fieldset <?=$hiddenStage3 ?>>
            <legend>Если у вас есть питомец, напишите его имя</legend>
            <?php inputText($form["stage3"]["text1"]) ?>
            <legend>Если нет, напишите почему?</legend>
            <?php inputText($form["stage3"]["text2"]) ?>
            <legend>Может вы хотите кого-нибудь завести?</legend>
            <?php inputText($form["stage3"]["text3"]) ?>
            <input type="hidden" value="<?=$stage2?>" name="hiddenText3">
        </fieldset>
        <input type="<?=$buttonHide3 ?>" value="Отправить" name="button3">
    </form>

    </body>
    </html>
<?="<pre>$stage3";





    
