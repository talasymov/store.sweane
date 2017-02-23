<?php
class ProductModel extends Model
{
    public function GetData($params = null)
    {
        $product = R::getRow("SELECT * FROM Product
        
        WHERE ID_product = ?
        
        GROUP BY Product.ID_product", [BF::ClearCode($params["child"], "int")]);

        $data["product"] = $product;
        $data["characteristics"] = $this->GetCharacteristics($product["ID_product"]);
        $data["reviews"] = $this->GetReviews($product["ID_product"]);
        $data["similarProducts"] = $this->GetSimilarReviews($product["ProductCategory_FK"]);

        return $data;
    }

    public static function GetCharacteristics($idProduct)
    {
        return R::getAll("SELECT * FROM CharacteristicsOutput

        INNER JOIN CharacteristicsSchema ON CharacteristicsSchema.ID_cSchema = CharacteristicsOutput.cOutput_id_Schema
        
        INNER JOIN CharacteristicsValue ON CharacteristicsValue.ID_cValue = CharacteristicsOutput.cOutput_id_Value
        
        WHERE CharacteristicsOutput.cOutput_id_Product = ?", [$idProduct]);
    }

    public static function GetReviews($idProduct)
    {
        $reviews = R::getAll("SELECT * FROM Review

        INNER JOIN User ON User.ID_user = Review.ID_user_FK
        
        WHERE ID_product_FK = ?", [$idProduct]);

        return $reviews;
    }

    public static function GetSimilarReviews($idCategory)
    {
        $products = R::getAll("SELECT * FROM Product
        
        WHERE ProductCategory_FK = ?
        
        GROUP BY Product.ID_product", [$idCategory]);

        return $products;
    }
}