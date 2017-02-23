<?php
class BF
{
    public function CheckUserInSystem($login, $password)
    {
        $check = R::getRow("SELECT * FROM carrot_users WHERE carrot_users_login = ? AND carrot_users_password = ?", [BF::GeneratePass($login), BF::GeneratePass($password)]);

        if(count($check) > 0)
        {
            return 1;
        }

        return 0;
    }

    public static function ReturnInfoUser($return)
    {
        if(BF::CheckUserInSystem($_SESSION["login"], $_SESSION["password"]) == 1)
        {
            $id = R::getRow("SELECT carrot_users_id, carrot_users_name, carrot_users_permissions  FROM carrot_users WHERE carrot_users_login = ?", [BF::GeneratePass($_SESSION["login"])]);

            return $id[$return];
        }

        return false;
    }

    public function RedirectUser($redirectTo, $needResult) // Redirect To, if result 1, Or Need Result, if result 0
    {

        if($needResult == 1)
        {
            if(BF::CheckUserInSystem($_SESSION["login"], $_SESSION["password"]) == 1)
            {
                header("Location: /" . $redirectTo);
            }
        }
        else
        {
            if(BF::CheckUserInSystem($_SESSION["login"], $_SESSION["password"]) == 0)
            {
                header("Location: /" . $redirectTo);

                die();
            }
        }
    }

    public static function LoginUser($login, $password)
    {
        $_SESSION["login"] = $login;
        $_SESSION["password"] = $password;
    }

    public static function QuitUser()
    {
        unset($_SESSION["login"]);
        unset($_SESSION["password"]);
    }

    public static function GeneratePass($text)
    {
        $text = "_23_asd_" . $text . "_asd_324";
        $password = md5($text);
        return $password;
    }

    public static function IncludeScripts($array)
    {
        $script = "";

        foreach($array as $value)
        {
            $script .= <<<EOF
<script type="text/javascript" src="/Libs/FrontEnd/{$value}.js"></script>
EOF;
        }

        return print($script);
    }

    public static function IncludeStyles($array)
    {
        $style = "";

        foreach($array as $value)
        {
            $style .= <<<EOF
<link rel="stylesheet" href="/Libs/FrontEnd/{$value}.css">
EOF;
        }

        return print($style);
    }

    public static function CreateLikeQuery($arrayWithColumns, $searchText)
    {
        $query = "";

        $explodeText = explode(" ", $searchText);
        $countWords = count($explodeText);
        $countColumns = count($arrayWithColumns);

        for ($i = 0; $i < $countWords; $i++)
        {
            $word = $explodeText[$i];

            $text = "";

            for ($y = 0; $y < $countColumns; $y++)
            {
                $value = $arrayWithColumns[$y];

                if($y != $countColumns - 1 && $countColumns != 1)
                {
                    $text .= "{$value} LIKE '%{$word}%' OR ";

                    continue;
                }
                else if($countColumns == 1)
                {
                    $text .= "{$value} LIKE '%{$word}%'";

                    continue;
                }

                $text .= "{$value} LIKE '%{$word}%'";
            }

            if($i != $countWords - 1 && $countWords != 1)
            {
                $query .= "({$text}) AND ";

                continue;
            }
            else if($countWords == 1)
            {
                $query .= $text;

                continue;
            }

            $query .= "({$text})";
        }

        return $query;
    }

    public static function ClearText($data)
    {
        return html_entity_decode(html_entity_decode($data));
    }

    public static function ClearCode($data, $type = null, $from = "array")
    {
        $data = BF::CheckFrom($data, $from);

        switch($type) {
            case("int"):
                $data = intval($data);
                break;
            case("float"):
                $data = floatval($data);
                break;
            case("bool"):
                $data = boolval($data);
                break;
            case("double"):
                $data = doubleval($data);
                break;
            case("str"):
                $data = htmlentities(strval($data));
                break;
            case("array"):
                $data = $data;
                break;
            default:
                $data = intval($data);
                break;
        }
        return $data;
    }

    public static function CheckFrom($var, $from = "array")
    {
        switch ($from)
        {
            case("array"):
                if(isset($var))
                {
                    return $var;
                }
                break;
            case("post"):
                if(isset($_POST[$var]) && $_POST[$var] != null)
                {
                    return $_POST[$var];
                }
                break;
            case("get"):
                if(isset($_GET[$var]) && $_GET[$var] != null)
                {
                    return $_GET[$var];
                }
                break;
            case("cookie"):
                if(isset($_COOKIE[$var]) && $_COOKIE[$var] != null)
                {
                    return $_COOKIE[$var];
                }
                break;
            default:
                return false;
        }

        return false;
    }

    public static function ReturnStatusAccount($countProjects, $countTasks)
    {
        if( ($countProjects >= 0 && $countProjects <= 3) && ($countTasks >= 0 && $countTasks <= 5) )
        {
            return ["dashboard_account_status_basic", 0];
        }
        else if( ($countProjects > 3 && $countProjects <= 5) && ($countTasks > 5 && $countTasks <= 8) )
        {
            return ["dashboard_account_status_medium", 5];
        }
        else if($countProjects > 6 && $countTasks > 8)
        {
            return ["dashboard_account_status_pro", 15];
        }

        return false;
    }

    public static function UploadFile($name, $path)
    {
        $dataInfo = [];

        $target_dir = $_SERVER["DOCUMENT_ROOT"] . $path;
        $target_file = $target_dir . basename($_FILES[$name]["name"]);

        $dataInfo["fileInfo"] = $target_file;

        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES[$name]["tmp_name"]);

        if($check !== false) {
            $dataInfo["imageMime"] = $check["mime"];
            $uploadOk = 1;
        } else {
            $dataInfo["imageMime"] = "File is not an image.";
            $uploadOk = 0;
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            $dataInfo["imageExists"] = "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size

        $dataInfo["imageSize"] = $_FILES[$name]["size"];

        if ($_FILES[$name]["size"] > 1000000) {
            $uploadOk = 0;
        }
        $dataInfo["imageType"] = "Support";

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            $dataInfo["imageType"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $dataInfo["imageUploaded"] = "Sorry, your file was not uploaded.";
            $dataInfo["imageStatus"] = false;
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
                $dataInfo["imageUploaded"] = "The file has been uploaded.";
                $dataInfo["imageUploadedName"] = basename( $_FILES[$name]["name"]);
                $dataInfo["imageStatus"] = true;
            } else {
                $dataInfo["imageUploaded"] = "Sorry, there was an error uploading your file.";
                $dataInfo["imageStatus"] = false;
            }
        }

        return $dataInfo;
    }

    public static function ReturnCondition($data, $var1, $var2)
    {
        if($var1 == $var2)
        {
            return $data;
        }

        return false;
    }

    public static function ReturnPercent($parent, $child)
    {
        if($parent == 0)
        {
            return 0;
        }

        return intval($child * 100 / $parent);
    }

    public static function GenerateList($array, $shell, $data)
    {
        $menuLi = "";

        foreach ($array as $value)
        {
            $i = 0;
            $shellPrepare = $shell;

            while($position = strpos($shellPrepare, "?"))
            {
                if(isset($data[$i]))
                {
                    $shellPrepare = BF::StringReplaceFirst("?", $value[$data[$i]], $shellPrepare);

                    $i++;
                }
                else
                {
                    return false;

                }
            }

            $menuLi .= $shellPrepare;
        }

        return $menuLi;
    }

    public static function GenerateListSimple($array, $shell, $data)
    {
        $menuLi = "";

        $array = explode($data, $array);

        foreach ($array as $value)
        {
            $i = 0;
            $shellPrepare = $shell;

            while($position = strpos($shellPrepare, "?"))
            {
                $shellPrepare = BF::StringReplaceFirst("?", $value, $shellPrepare);

                $i++;
            }


            if(isset($value) && $value != null)
            {
                $menuLi .= $shellPrepare;
            }
        }

        return $menuLi;
    }

    public static function StringReplaceFirst($from, $to, $subject)
    {
        $from = '/'.preg_quote($from, '/').'/';

        return preg_replace($from, $to, $subject, 1);
    }

    public static function NotFound()
    {
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location: /404/');

        die();
    }

}