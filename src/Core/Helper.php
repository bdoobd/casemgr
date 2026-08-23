<?php 

namespace App\Core;

class Helper {
    /**
     * Конвертирует строку в to-studly-case в ToStudlyCase. Например для использования в названиях классов
     * 
     * @param string $str Строка для конвертирования
     * 
     * @return string
     */
    static public function toStudlyCaps(string $str): string {
        return str_replace(' ', '', ucwords(preg_replace("#-#"," ", $str)));
    }
    /**
     * Конвертирует строку to-camel-case в toCamelCase для именования методов класса
     * 
     * @param string $str Строка для конвертирования
     * 
     * @return string
     */
    static public function toCamelCase(string $str): string {
        return lcfirst(self::toStudlyCaps($str));
    }
}