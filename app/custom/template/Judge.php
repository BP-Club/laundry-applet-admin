<?php   
namespace app\custom\template;
use app\custom\Custom;

class Judge extends Custom
{
    
      const DICTIONARY = [
           "<" => "lessThan",
           "<=" => "lessThanOrEqualTo",
           ">" => "moreThan",
           ">=" => "moreThanOrEqualTo",
      ];

    
      
      public static function lessThan($a,$b){
          
           return $a < $b;
          
      }
      
      public static function lessThanOrEqualTo($a,$b){
          
           return $a <= $b;
          
      }
      
      public static function moreThan($a,$b){
          
           return $a > $b;
           
      }
     
      public static function  moreThanOrEqualTo($a,$b){
          
           return $a >= $b;
           
      }

}