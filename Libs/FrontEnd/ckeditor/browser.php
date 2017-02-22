<!--<script src="/Landing/Js/library/jquery-1.12.4.min.js"></script>-->
<script type="text/javascript">
function getUrlParam(paramName)
{
var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
var match = window.location.search.match(reParam) ;

return (match && match.length > 1) ? match[1] : '' ;
}
var funcNum = getUrlParam('CKEditorFuncNum');
var fileUrl = '/images/interviews/11244393111907954513726734141507551084news.jpg';
window.opener.CKEDITOR.tools.callFunction(funcNum, url);
function getImg(url)
{
  window.opener.CKEDITOR.tools.callFunction(funcNum, url);
  window.close();
}
</script>
<style media="screen">
  .image {
    display: inline-block;
    width: 100px;
    height: 100px;
    float: left;
    padding: 3px;
    border-radius: 12px;
    border: 1px solid #eaeaea;
    margin: 10px;
    cursor: pointer;
  }
  .image:hover {
    border: 1px solid #bfbfbf;
  }
  .image img {
    object-fit: cover;
    width: 100%;
    height: 100%;
    border-radius: 7px;
  }
</style>
<?php
//$pathFiels = "../../Images/States/";
$pathFiels = "../../img/";

$dh = opendir($pathFiels);

 while($filename = readdir($dh))
 {
   if($filename != "." && $filename != "..")
   {
     $filenameDir = $pathFiels . $filename;
     $filenameDirData = $pathFiels . $filename;

     $filenameDirData =  "/img/". $filename;

    if (file_exists($filenameDir)) {
         echo "<div class=\"image\"><img width=\"100\" src=\"$filenameDir\" onclick=\"getImg('$filenameDirData')\"></div>";
    }
   }
}

?>
