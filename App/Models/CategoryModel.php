<?php
class CategoryModel
{
    public function GetData($params = null)
    {
        if($_POST["listVar"])
        {
            $products = R::getAll("SELECT *  FROM Product
    
            LEFT JOIN CharacteristicsOutput ON CharacteristicsOutput.cOutput_id_Product = Product.ID_Product
            
            WHERE cOutput_id_SubCategory = ? AND cOutput_id_Value IN (?)
            
            GROUP BY Product.ID_Product",

            [BF::ClearCode("categoryId", "int", "post"), BF::ClearCode("listVar", "array", "post")]);
        }
        else
        {
            $products = R::getAll("SELECT * FROM Product
            
            INNER JOIN SubCategory ON SubCategory.ID_subCategory = Product.ProductCategory_FK
            
            WHERE ProductCategory_FK = ?", [BF::ClearCode($params["child"], "int")]);
        }

        $filter = R::getAll("SELECT * FROM CharacteristicsSchema
        WHERE cSchema_Category_FK = ?", [BF::ClearCode($params["child"], "int")]);

        $subFilter = [];

        foreach ($filter as $value)
        {
            $subFilter[$value["cSchema_Name"]] = R::getAll("SELECT * FROM CharacteristicsValue
            WHERE cValueSchema_FK = ?", [BF::ClearCode($value["ID_cSchema"], "int")]);
        }

        $data["products"] = $products;
        $data["filters"] = $subFilter;
        $data["categoryId"] = BF::ClearCode($params["child"], "int");

        return $data;
    }
}