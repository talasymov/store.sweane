<?php
/**
 * Created by PhpStorm.
 * User: Change World
 * Date: 30.01.2017
 * Time: 19:28
 */
class AuxiliaryFn
{
    protected $statusText = array();

    public function AddStatus($text)
    {
        $this->statusText[] = $text;
    }

    public function GetStatus()
    {
        return var_dump($this->statusText);
    }

    public static function StylePrint($data)
    {
        echo "<pre>";
        echo var_dump($data);
        echo "</pre>";
    }

    public function JustText($text)
    {
        $text = strtr($text, [
            "/" => "",
            "\\" => ""
        ]);

        return $text;
    }

    public function ExplodeParams($link)
    {
        $paramsBase = explode("&", $link);
        $paramsFinal = [];

        foreach($paramsBase as $value)
        {
            $paramsUnSet = explode("=", $value);
            $paramsFinal[$paramsUnSet[0]] = $paramsUnSet[1];
        }
        return $paramsFinal;
    }

    public function CheckNull($value, $default = null)
    {
        if(isset($value))
        {
            return $value;
        }
        else if(isset($default))
        {
            return $default;
        }
        return false;
    }
    //( ( ( Функция для выдачи массива со значениями исходя из ссылки ) ) )

    public static function CheckAndRequire($pathToFile)
    {
        if(file_exists($pathToFile))
        {
            require_once($pathToFile);
            return true;
        }

        return false;
    }

    public static function ArrayToSelect($data, $idSelect, $idOption, $textOption, $nameFirstOption)
    {
        $option = "";

        foreach($data as $key => $value)
        {
            $id = $value[$idOption];
            $text = $value[$textOption];

            $option .= "<option value='{$id}'>{$text}</option>";
        }

        $select = "<select id='{$idSelect}' class='form-control' style='margin-bottom: 10px;'><option value='0'>{$nameFirstOption}</option>" . $option . "</select>";

        return $select;
    }
}