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
                echo"<input type=\"$var1\" name=\"$key\" placeholder=\"$value\" class=\"$var\" style=\"width:200px\">";
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
    # Переменные формы stage1
        $name =isset($_POST["name"])? filter_input(INPUT_POST,"name",FILTER_SANITIZE_STRING): "";
        $surname = isset($_POST["surname"])? filter_input(INPUT_POST,"surname",FILTER_SANITIZE_STRING): "";
        $father = isset($_POST["surname"])? filter_input(INPUT_POST,"father",FILTER_SANITIZE_STRING): "";
        $profession = isset($_POST["professionSelect"])? $_POST["professionSelect"]:"";
        $stage1= "$name<br>$father</br>$surname<br>$profession<br>";
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
    # Общая переменная для Stage2
        $stage2 = "$music<br>$textM</br>$films<br>$textF<br>";
    # Переменные формы stage3
        $animal = isset($_POST["animals"])? ($_POST["animals"]): "" ;
        $moniker = isset($_POST["moniker"])? filter_input(INPUT_POST,"moniker",FILTER_SANITIZE_STRING): "" ;
        $noMoniker = isset($_POST["noMoniker"])? filter_input(INPUT_POST,"noMoniker",FILTER_SANITIZE_STRING): "" ;
        $wish = isset($_POST["wish"])? filter_input(INPUT_POST,"wish",FILTER_SANITIZE_STRING): "" ;
        $stage3 = "$animal<br>$moniker<br>$noMoniker<br>$wish";
    # При нажатии на кнопку
        $submit = isset($_POST["yes"])? $_POST["yes"]:"";

        

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .hidden, .stage2, .stage3 {
            display: none;
        }
    </style>
</head>
<body>
    
    <form action="" method="POST"<?php if($submit) echo "hidden"; ?>>
        <!--Первый этап формы, передающий Фамилию, Имя и Профессию пользователя-->
        <h2 class="stage1">Этап 1 из 3 - Знакомство</h2>
        <fieldset class="stage1">
            <legend>Имя и фамилия </legend>
            <?php inputText($form["stage1"]["initials"]) ?>
        </fieldset>
        <fieldset class="stage1">
            <legend>Пожалуйста, расскажите нам о вашей профессии</legend>
            <label for="professionSelect">Вы:</label>
                <select name="professionSelect" id="professionSelect" required>
                    <?php inputSelect($form["stage1"]["professionSelect"])?>
            </select>
        </fieldset>
        <?php inputButton($form["button"][0]) ?>
<!--Второй этап формы, передающий предпочтения-->
<h2 class="stage2">Этап 2 из 3 - Предпочтения</h2>
        <fieldset class="stage2">
            <legend>Ваши мызкальные предпочтения</legend>                                                          
            <?php inputCheckbox($form["stage2"]["music"],"checkbox") ?>
        </fieldset>
        <fieldset class="stage2">
            <legend>А фильмы вам какие нравятся</legend>
            <?php inputCheckbox($form["stage2"]["films"], "checkbox") ?>
        </fieldset>
        <fieldset class="stage2">
            <legend>Напишите, что вы думаете?</legend>
            <?php inputText($form["stage2"]["text"]) ?>
        </fieldset>
        <div class="stage2"><?php inputButton($form["button"][1]) ?> </div>
<!--Второй этап формы, передающий предпочтения по питомцам-->
<h2 class="stage3">Этап 3 из 3 - Про питомцев</h2>
    <fieldset class="stage3">
        <legend>У вас есть?</legend>
        <?php inputRadio($form["stage3"]["animals"]) ?>
    </fieldset>
    <fieldset class="stage3">
        <legend>Если у вас есть питомец, напишите его имя</legend>
        <?php inputText($form["stage3"]["text1"]) ?>
        <legend>Если нет, напишите почему?</legend>
        <?php inputText($form["stage3"]["text2"]) ?>
        <legend>Может вы хотите кого-нибудь завести?</legend>
        <?php inputText($form["stage3"]["text3"]) ?>
    </fieldset>
        <div class="stage3"><input type="submit" value="Отправить" name="yes"></div>
</form>

</body>
<script>
    // Stage1  
    const buttonArray = document.getElementsByClassName("button");
    const stage1 = document.querySelectorAll(".stage1");
    const stage2 = document.querySelectorAll(".stage2");
    const stage3 = document.querySelectorAll(".stage3");
    // при нажатии на кнопку показываем второй этап
    function button1(){
       buttonArray[0].type="hidden";
       for(let key=0; key<stage1.length; key++)
           stage1[key].className="hidden";
        for (let key = 0; key < stage2.length; key++)
            stage2[key].className = "stage1";
    }
    // Stage2 при нажатии на кнопку показываем третий этап
    function button2() {
        buttonArray[1].type = "hidden";
        for (let key = 0; key < stage2.length; key++)
            stage2[key].className = "hidden";
        for (let key = 0; key < stage3.length; key++)
            stage3[key].className = "stage1";
    }
</script>
</html>
<!--Вывод данных-->
<?="$stage1 $stage2 $stage3";


    

    
/**
 * Created by PhpStorm.
 * User: alexanderpanteleev
 * Date: 23.07.18
 * Time: 12:32
 */