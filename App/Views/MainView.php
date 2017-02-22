<?php
$shares = BF::GenerateList(DataBase::GetShares(), '<img src="?" />', ["shares_img"]);
$rootCategory = BF::GenerateList(DataBase::GetRootCategory(), '<span>?</span>', ["CategoryName"]);
$popular = BF::GenerateList(DataBase::GetPopularProducts(), '<span>?<img src="?" />?</span>', ["ProductName", "ProductImages", "ProductPrice"]);
$sales = BF::GenerateList(DataBase::GetSalesProducts(), '<span>?<img src="?" />??</span>', ["ProductName", "ProductImages", "ProductPrice", "ProductLastPrice"]);
$last = BF::GenerateList(DataBase::GetLastProducts(), '<span>?<img src="?" />??</span>', ["ProductName", "ProductImages", "ProductPrice", "ProductLastPrice"]);
$news = BF::GenerateList(DataBase::GetNews(), '<span style="border: 2px solid red;">?<img src="?" /></span>', ["news_title", "news_img"]);

$bodyText = <<<EOF
    {$rootCategory} {$shares}<br /><br /><br />
    <h1>Popular</h1>
    {$popular}
    <h1>Sales</h1>
    {$sales}
    <h1>Last</h1>
    {$last}
    <h1>News</h1>
    {$news}<br />
    {TEXT ABOUT US}<br />
EOF;
