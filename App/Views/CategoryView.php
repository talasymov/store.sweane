<?php
$categoryId = $data["categoryId"];

$echoFilter = "";

foreach ($data["filters"] as $key => $value)
{
    $header = "<strong>" . $key . "</strong><br />";

    $news = BF::GenerateList($value, '<span><input type="checkbox" class="filter-variable" data-id="?">?</span><br />', ["ID_cValue", "cValueValue"]);

    $echoFilter .= $header . "<br />" . $news . "<br /><br />";
}

$echoProduct = BF::GenerateList($data["products"], '<a href="/product/?"><div style="display: block; border: 1px solid red"><strong>?</strong><span><img src="?">? __ ?</span></div></a>', ["ID_product", "ProductName", "ProductImagesPreview", "ProductPrice", "ProductLastPrice"]);

$bodyText = <<<EOF
    SELECT FROM<br />
    1.7 GHZ + 4 GB + 15.6'<br />
    SELECT * FROM Product
    
    INNERT JOIN Scheme
    
    WHERE ID_cValue = 1 AND ID_cValue = 2
    
    ВЫБРАТЬ ИЗ ПРОДУКТОВ ТЕ У КОТОРЫХ 
    {$echoProduct}
    <br />
    {$echoFilter}

    <button class="filter-search">Search</button>

    <form style="display: hidden" action="/category/{$categoryId}" method="POST" id="form">
      <input type="hidden" id="listVar" name="listVar" value=""/>
      <input type="hidden" id="categoryId" name="categoryId" value=""/>
    </form>
EOF;

$script = <<<EOF
<script>
$(document).ready(function() {
    $(".filter-search").click(function () {
        var listVar = [];
    
        $(".filter-variable:checked").each(function (i, e) {
            listVar.push($(e).attr("data-id"));
        });
        
        $("#listVar").val(listVar);
        $("#categoryId").val({$categoryId});
        
        $("#form").submit();
    });
});
</script>
EOF;
