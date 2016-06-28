<?php
date_default_timezone_set("UTC"); // Настройка часовой зоны.(Default:UTC)
/**
 * Telegram Bot access token и URL.
 */
$access_token = '208935857:AAGLYljYEQvzNmM71jegfXs4z9RvkMsSYsc';//*:*****
$api = 'https://api.telegram.org/bot' . $access_token;
/**
* Данные для доступа в Базу Данных Mysqli.Information for login to Mysqli Data Base.
*/
$dbhost     = 'localhost';//Хост БД.
$dbuser     = '';//Логин к БД.
$dbpass     = '';//Пароль к БД.
$dbBaseName     = '';//Имя БД.
$dbTableName    = ''; //ИМя таблицы в БД.
/**
*Настройки.Configs.
*Клавиатура.(Кнопки меню под чатом).Keyboard.
*
*Array = ['keyboard'=>[ ['1st.Button','2nd.Button','...'],['...','...','...'],['...','...','...'] ], 'resize_keyboard'=>'true/false' , 'one_time_keyboard'=>'true/false' ]; Default => false;
*
*Need encode to JSON! Необходимо закодировать JSON в формат!
*/
 
$menu = ['keyboard' => [
    ['1.Слово', '2.Помощь' ],
    ['3.Настройки']]
        ];
$reply_markup = json_encode($menu);

$configs = ['keyboard' => [
    ['1.Часовой пояс', '2.Рассылка' ],
    ['Главное меню']]
           ];
$reply_markup_conf = json_encode($configs);

$tz = ['keyboard' => [
    ['-11', '-10','-9','-8','-7','-6' ],
    ['-5', '-4','-3','-2','-1','0' ],
    ['+1', '+2','+3','+4','+5','+6' ],
    ['+7', '+8','+9','+10','+11','+12' ],
    ['Главное меню']]
      ];
$reply_markup_timezone = json_encode($tz);

$delivery = ['keyboard' => [
    ['1.Включить', '2.Выключить' ],
    ['Главное меню']]
            ];
$reply_markup_delivery = json_encode($delivery);

/**
*Основные функции. General function.
*/

/**Логирование использования бота каждым пользователем/Создание записи о пользователе в БД.
*Увеличивает значение ячейки в столбце command на +1, при каждом запросе к боту.
*/
function loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id,$api,$reply_markup){

$link=mysqli_connect("$dbhost", "$dbuser", "$dbpass", "$dbBaseName");
$result = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM `$dbTableName` WHERE (chat_id='$chat_id')"));// Поиск записи пользователя в БД.
    
if(!is_null($result)){

    mysqli_query($link, "UPDATE `$dbTableName` SET `command` = `command` + 1 WHERE (chat_id='$chat_id')");// Обновление записи о пользователе.
    
} else { mysqli_query( $link, "INSERT INTO `log`(`id`, `first_name`, `chat_id`, `command`, `delivery`, `time_zone`) VALUES ('id','$first_name','$chat_id','1','0','0')"); }// Создание записи о пользователе в БД. 
    
mysqli_close($link);
}
//Отправка случайной записи их БД.
function sendRandRec($dbhost,$dbuser,$dbpass,$dbBaseName){
        $link=mysqli_connect("$dbhost", "$dbuser", "$dbpass", "$dbBaseName");
        $text =mysqli_fetch_row(mysqli_query($link, "SELECT word FROM `Words` ORDER BY RAND() LIMIT 1"));//Выбор строки (N) из таблицы (T).
        $text = $text[0];//Запись в $text первое значение массива.
        mysqli_close($link);
    return $text;
}
//Отправка сообщения пользователю.
function sendMessage($api,$chat_id, $message, $reply_markup) {
file_get_contents($api . '/sendMessage?chat_id=' . $chat_id . '&text=' . urlencode($message) . '&reply_markup=' . $reply_markup);
}
//Функция отправки рассылки.
function delivery($dbhost,$dbuser,$dbpass,$dbBaseName,$api,$reply_markup){
        //Ежечасная проверка позльзователей для рассылки по временной зоне.
    for($i = -11; $i<=12; $i++){
        
        $time_client = $i * 3600;
        $real_time = time() + $time_client;
        $date = date("H",$real_time);
      
   switch($date){
       case '09';
           $link=mysqli_connect("$dbhost", "$dbuser", "$dbpass", "$dbBaseName"); 
           $result =mysqli_query($link, "SELECT `chat_id` FROM `$dbTableName` WHERE (`time_zone`='$i') AND (`delivery`='1')");
           $count = mysqli_num_rows($result);
           
           for($j=0;$j<=$count;$j++){
           $row = mysqli_fetch_row($result);
           $chat_id = "$row[0]";

           $text = "Рассылка.09:00.".sendWord($dbhost,$dbuser,$dbpass,$dbBaseName);
           sendMessage($api,$chat_id,$text,$reply_markup);
}
           
           mysqli_free_result($result);
           mysqli_close($link); 
           break;
           
       case '13';
           $link=mysqli_connect("$dbhost", "$dbuser", "$dbpass", "$dbBaseName"); 
           $result =mysqli_query($link, "SELECT `chat_id` FROM `$dbTableName` WHERE (`time_zone`='$i') AND (`delivery`='1')");
           $count = mysqli_num_rows($result);
           
           for($j=0;$j<=$count;$j++){
           $row = mysqli_fetch_row($result);
           $chat_id = "$row[0]";	

           $text = "Рассылка.13:00.".sendWord($dbhost,$dbuser,$dbpass,$dbBaseName);
           sendMessage($api,$chat_id,$text,$reply_markup);
}          
           
           mysqli_free_result($result);
           mysqli_close($link); 
           break;
           
       case '19';
           $link=mysqli_connect("$dbhost", "$dbuser", "$dbpass", "$dbBaseName"); 
           $result =mysqli_query($link, "SELECT `chat_id` FROM `$dbTableName` WHERE (`time_zone`='$i') AND (`delivery`='1')");
           $count = mysqli_num_rows($result);
           
           for($j=0;$j<=$count;$j++){
           $row = mysqli_fetch_row($result);
           $chat_id = "$row[0]";

           $text = "Рассылка.19:00.".sendWord($dbhost,$dbuser,$dbpass,$dbBaseName);
           sendMessage($api,$chat_id,$text,$reply_markup);
}           
           
           mysqli_free_result($result);
           mysqli_close($link); 
           break;
    }
          
    }
             
}
//Установка временной зоны.
   function setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$time_zone){
   	$link = mysqli_connect("$dbhost","$dbuser","$dbpass","$dbBaseName");
       
   	$result = mysqli_query($link, "SELECT * FROM `$dbTableName` WHERE (chat_id='$chat_id')");
       //START DEBUG
       /**
       
            $chat_id = "";
            $res1 = gettype($result);
            $text = "$time_zone .*******************. $res1";
            $access_token = '';
            $api = 'https://api.telegram.org/bot' . $access_token;
       
            $menu = ['keyboard' => [
                ['1.Слово', '2.Помощь' ],
                ['3.Настройки']]
                    ];
            $reply_markup = json_encode($menu);
            sendMessage($api,$chat_id,$text,$reply_markup);//debug0
       */
       //FINISH DEBUG
       $result = mysqli_fetch_row($result);
         
       if(!is_null($result)) {
mysqli_query($link,"UPDATE `$dbTableName` SET `time_zone` = $time_zone WHERE (chat_id='$chat_id')");   	
   	}
       
   mysqli_close($link);
}
//Включенние/Отключенние рассылки.
    function setDelivery($dbhost,$dbuser,$dbpass,$dbBaseName,$chat_id,$deliver){
   	$link = mysqli_connect("$dbhost","$dbuser","$dbpass","$dbBaseName");
       
   	$result = mysqli_fetch_row(mysqli_query($link, "SELECT * FROM `$dbTableName` WHERE (chat_id='$chat_id')"));
       
   	if(!is_null($result)) {
mysqli_query($link,"UPDATE `$dbTableName` SET `delivery` = $deliver WHERE (chat_id='$chat_id')");   	
   	}
       
   mysqli_close($link);
}


?>