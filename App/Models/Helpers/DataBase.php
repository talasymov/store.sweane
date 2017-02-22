<?php
class DataBase
{
    /*
     * Header
     */
    public static function GetMenu()
    {
        return R::getAll("SELECT * FROM Header");
    }
    public static function GetContacts()
    {
        return R::getAll("SELECT * FROM Phones");
    }
    public static function GetShares()
    {
        return R::getAll("SELECT * FROM Shares");
    }
    public static function GetRootCategory()
    {
        return R::getAll("SELECT * FROM RootCategory");
    }
    public static function GetPopularProducts()
    {
        return R::getAll("SELECT ProductName, ProductImages, ProductPrice FROM Product WHERE ProductPopular_FK = 1 LIMIT 6");
    }
    public static function GetLastProducts()
    {
        return R::getAll("SELECT ProductName, ProductImages, ProductPrice FROM Product ORDER BY ProductAddDate DESC LIMIT 6");
    }
    public static function GetSalesProducts()
    {
        return R::getAll("SELECT ProductName, ProductImages, ProductPrice, ProductLastPrice FROM Product WHERE ProductSale_FK = 1 LIMIT 6");
    }
    public static function GetNews()
    {
        return R::getAll("SELECT * FROM News ORDER BY news_id DESC LIMIT 3");
    }
}