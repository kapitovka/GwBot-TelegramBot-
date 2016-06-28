<?php
include("config.php");
$output = json_decode(file_get_contents('php://input'), TRUE);


$chat_id = $output['message']['chat']['id'];
$first_name = $output['message']['chat']['first_name'];
$message = $output['message']['text'];
$message_id = $output['message']['message_id'];

switch($message){
   
    case '/start':
         $text = "Главное меню";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id);     
        sendMessage($api,$chat_id,$text,$reply_markup);
        break;
        
    case '1.Слово':
        
         $text1 = sendRandRec($dbhost,$dbuser,$dbpass,$dbBaseName);
        $text = "Слово.".$text1;
        loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id);      
        sendMessage($api,$chat_id,$text,$reply_markup);
        break;
        
    case '2.Помощь':
         $text = "Помощь по боту?!";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id);      
        sendMessage($api,$chat_id,$text,$reply_markup);
        break;
        
    case '/help':
         $text = "Помощь по боту?!";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id);      
        sendMessage($api,$chat_id,$text,$reply_markup);
        break;
        
    case '3.Настройки':
        $text = "Основные настройки:
1.Выбрать часовой пояс.
2.Включить/Выключить рассылку(3 раза в день)
3.Вернуться в главное меню.";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id);    
          sendMessage($api,$chat_id,$text,$reply_markup_conf);
        break;
        
    case '1.Часовой пояс':
        $text = "Укажите часовой пояс в формате GSM.Допустимые значения от -11 до +12.";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id);      
        sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
    case '2.Рассылка':
        $text = 'Включить/Выключить рассылку.';
          loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id);      
          sendMessage($api,$chat_id,$text,$reply_markup_delivery);
        break;
        
    case 'Главное меню':
        $text = "Главное меню";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id);      
         sendMessage($api,$chat_id,$text,$reply_markup);
        break;
        
         case '-11':
        $text = "Часовой пояс -11";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id);    
        setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$message);
         sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
         case '-10':
        $text = "Часовой пояс -10";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id);  
         setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$message);
         sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
         case '-9':
        $text = "Часовой пояс -9";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id); 
         setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$message);
         sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
         case '-8':
        $text = "Часовой пояс -8";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id); 
         setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$message);
         sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
         case '-7':
        $text = "Часовой пояс -7";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id);  
         setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$message);
          sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
         case '-6':
        $text = "Часовой пояс -6";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id);   
         setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$message);
        sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
         case '-5':
        $text = "Часовой пояс -5";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id); 
         setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$message);
        sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
         case '-4':
        $text = "Часовой пояс -4";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id); 
         setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$message);
        sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
         case '-3':
        $text = "Часовой пояс -3";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id); 
         setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$message);
        sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
         case '-2':
        $text = "Часовой пояс -2";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id); 
         setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$message);
        sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
         case '-1':
        $text = "Часовой пояс -1";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id);   
         setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$message);
        sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
         case '0':
        $text = "Часовой пояс 0";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id); 
         setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$message);
        sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
         case '+1':
        $text = "Часовой пояс +1";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id);  
         setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$message);
        sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
         case '+2':
        $text = "Часовой пояс +2";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id); 
         setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$message);
        sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
         case '+3':
        $text = "Часовой пояс +3";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id);   
         setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$message);
        sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
         case '+4':
        $text = "Часовой пояс +4";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id);  
         setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$message);
        sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
         case '+5':
        $text = "Часовой пояс +5";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id); 
         setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$message);
        sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
         case '+6':
        $text = "Часовой пояс +6";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id); 
         setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$message);
        sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
         case '+7':
        $text = "Часовой пояс +7";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id);    
         setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$message);
        sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
         case '+8':
        $text = "Часовой пояс +8";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id);  
         setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$message);
        sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
        case '+9':
        $text = "Часовой пояс +9";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id);    
         setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$message);
        sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
         case '+10':
        $text = "Часовой пояс +10";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id);  
         setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$message);
        sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
         case '+11':
        $text = "Часовой пояс +11";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id); 
         setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$message);
        sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
         case '+12':
        $text = "Часовой пояс +12";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id);  
         setTimeZone($dbhost,$dbuser,$dbpass,$dbBaseName,$dbTableName,$chat_id,$message);
        sendMessage($api,$chat_id,$text,$reply_markup_timezone);
        break;
        
        case '1.Включить':
        $text = "Рассылка включена.";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id);  
        $deliver = "1";
         setDelivery($dbhost,$dbuser,$dbpass,$dbBaseName,$chat_id,$deliver);
        sendMessage($api,$chat_id,$text,$reply_markup_delivery);
        break;
        
        case '2.Выключить':
        $text = "Рассылка выключена.";
         loging($dbhost,$dbuser,$dbpass,$dbBaseName,$first_name,$chat_id);  
        $deliver = "0";
         setDelivery($dbhost,$dbuser,$dbpass,$dbBaseName,$chat_id,$deliver);
        sendMessage($api,$chat_id,$text,$reply_markup_delivery);
        break;
        
    default:
        break;
        
}   


?>
