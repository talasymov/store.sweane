<?php
function InitHere($command = null)
{
    if($command == "SetCookie")
    {
        setcookie("language", BF::ClearCode("value", "str", "post"), time() + 86400, "/");
    }
    else if($command == "ListUsers")
    {
        $users = R::getAll("SELECT carrot_users_id, carrot_users_name FROM carrot_users WHERE carrot_users_permissions <> 777 AND carrot_users_permissions <> 1");

        print(AuxiliaryFn::ArrayToSelect($users, "UsersSelect", "carrot_users_id", "carrot_users_name", "Select User"));
    }
    else if($command == "AddBlog")
    {
        $image = BF::UploadFile("image", "/Images/Blog/");

        if($image["imageStatus"])
        {
        R::exec("INSERT INTO carrot_blog(
        carrot_blog_content,
        carrot_blog_category,
        carrot_blog_language,
        carrot_blog_title,
        carrot_blog_description,
        carrot_blog_keywords,
        carrot_blog_images
        ) VALUES(?, ?, ?, ?, ?, ?, ?)", [
            BF::ClearCode("content", "str", "post"),
            BF::ClearCode("category", "int", "post"),
            BF::ClearCode("language", "str", "post"),
            BF::ClearCode("title", "str", "post"),
            BF::ClearCode("description", "str", "post"),
            BF::ClearCode("keywords", "str", "post"),
            $image["imageUploadedName"]
        ]);
        }

        AuxiliaryFn::StylePrint($image);
    }
    else if($command == "Filter")
    {
        $filter = R::getAll("SELECT *  FROM Product

        LEFT JOIN CharacteristicsOutput ON CharacteristicsOutput.cOutput_id_Product = Product.ID_Product

        WHERE cOutput_id_SubCategory = ? AND cOutput_id_Value IN (?)
        
        GROUP BY Product.ID_Product",
            [BF::ClearCode("category", "int", "post"), implode(",", BF::ClearCode("listVar", "array", "post"))]);

        print(json_encode($filter));
        print("asdd");
    }

    print($command);
}
