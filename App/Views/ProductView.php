<?php

$echoCharacteristics = BF::GenerateList($data["characteristics"], '<div>?: ?</div><br/ >', ["cSchema_Name", "cValueValue"]);
$echoImages = BF::GenerateListSimple($data["product"]["ProductImages"], '<img src="?" />', ';');
$echoReviews = BF::GenerateList($data["reviews"], '<strong>? ?</strong><span>?</span><span>?</span><br />', ["Name", "Surname", "ReviewText", "ReviewDate"]);
$echoSimilarProduct = BF::GenerateList($data["similarProducts"], '<a href="/product/?"><div style="display: block; border: 1px solid red"><strong>?</strong><span><img src="?">? __ ?</span></div></a>', ["ID_product", "ProductName", "ProductImagesPreview", "ProductPrice", "ProductLastPrice"]);

$bodyText = <<<EOF
    <h1>{$data["product"]["ProductName"]}</h1>
    <h2>{$data["product"]["ProductPrice"]} грн</h2>
    {$echoImages}
    <img src="{$data["product"]["ProductImagesPreview"]}" />
    {$echoCharacteristics}
    {$echoReviews}
    <div style="border: 3px solid #ccc">
        <div style="border: 2px solid red; margin: 10px; padding: 10px;">
            {$echoCharacteristics}
        </div>
        <div style="border: 2px solid red; margin: 10px; padding: 10px;">
            {$data["product"]["ProductDescription"]}
        </div>
        <div style="border: 2px solid red; margin: 10px; padding: 10px;">
            {$echoReviews}
        </div>
    </div>
    {$echoSimilarProduct}
EOF;
