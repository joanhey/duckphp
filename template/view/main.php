<?php
// use MY\Base\Helper\ViewHelper as V;
    $in_full=true;
    $in_full=false;  //@DUCKPHP_DELETE_IN_FULL
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Hello DuckPHP!</title>
</head>
<body>
<h1>Hello DuckPHP</h1>
<div>
欢迎使用 DuckPHP ,<?php echo $var;?>
</div>
<?php
    if($in_full){
?>
<div>
请使用安装选项 --full 以打开开启 <a href="javascript:;">完整演示</a>
</div>
<?php
    }else{
?>
<div>
<a href="/full/public/index.php">转到完整演示页面</a>
</div>
    
<?php
    }
?>
</body>
</html>