<?php

class ValidatorController {

    public $name;
    public $email;
    public $phone;
    public $password;
    public $errors;

    public function __construct($name, $email, $phone, $password) {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
    }
   
    /*
    Проверка имени, не менее 3 и не более 16 символов
    */
    public function checkName() {        
        if(mb_strlen($this->name)<3 || mb_strlen($this->name)>16) {
            $this->errors[] = "Некорректный формат имени '{$this->name}'. Должно быть не менее 3 и не более 16 символов";
        }
        return $this;
    }

    /*
    Проверка ввода корректного email
    */
    public function checkEmail() {
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Некорректный формат email: '{$this->email}'";
        }
        return $this;
    }

    /*
    Проверка телефона, формат мобильный номер Беларусь
    */
    public function checkPhone() {
        if(!preg_match("|^\+375\d{9}$|", $this->phone)) {
            $this->errors[] = "Некорректный формат телефонного номера: '{$this->phone}'. Корректный формат +375123456789";
        }
        return $this;
    }

    /*
    Проверка пароля. Более 6 символов, должен содержать минимум 1 цифру
    */
    public function checkPassword() {
        if(!preg_match("|(?=.*[a-z])(?=.*\d)[a-zA-Z\d]{6,}$|", $this->password)) {
            $this->errors[] = "Некорректный пароль. Должен содержать более 6 символов, обязательно должен содержать более 1 цифрового символа";
        }
        return $this;
    }

    /*
    Проверка на наличие ошибок в предыдущих проверках, генерация вывода списка ошибок
    */

    public function showErrors() {
        if (!empty($this->errors)) {
            $result = "<ul>";
                foreach ($this->errors as $error) {
                    $result .= "<li>{$error}</li>";                
                }
            $result .= "</ul>";
            return $result;
        }       
    }

    /*
    Проверка на отсутствие ошибок
    */
    public function isSuccess() {
        if (empty($this->errors)) {            
            return true;
        }
    }
}

?>