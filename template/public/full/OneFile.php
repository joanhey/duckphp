<?php declare(strict_types=1);
use DuckPhp\App;
use DuckPhp\Core\Route;
use DuckPhp\Core\View;
//未完工
require(__DIR__.'/../../../autoload.php');  // @DUCKPHP_HEADFILE
//// 这个例子极端点，没用任何类，全函数模式。

////

/////////////////////
function get_data()
{
    return App::SG()->_SESSION['content'] ?? '';
}
function add_data($content)
{
    App::SG()->_SESSION['content'] = $content;
}
function update_data($content)
{
    App::SG()->_SESSION['content'] = $content;
}
function delete_data()
{
    unset(App::SG()->_SESSION['content']);
    unset($_SESSION['content']);
}
/////////////
function action_index()
{
    global $view_data;
    $view_data['content'] = nl2br(App::H(get_data()));
    $view_data['url_add'] = App::URL('add');
    $view_data['url_edit'] = App::URL('edit');
    $token = App::SG()->_SESSION['token'] = md5(''.mt_rand());
    $view_data['url_del'] = App::URL('del?token='.$token);
    
    App::Show($data);
}
function action_add()
{
    $data = ['x' => 'add'];
    
    App::Show($data);
}
function action_edit()
{
    $data = ['x' => 'add'];
    $data['content'] = H(get_data());

    App::Show($data);
}
function action_del()
{
    $old_token = App::SG()->_SESSION['token'];
    $new_token = App::SG()->_GET['token'];
    $flag = ($old_token == $new_token)?true:false;
    if ($flag) {
        unset(App::SG()->_SESSION['content']);
    }
    unset(App::SG()->_SESSION['token']);
    $data['msg'] = $flag?'':'验证失败';
    $data['url_back'] = App::URL('');
    
    App::Show($data, 'dialog');
}
function action_do_edit()
{
    update_data(App::SG()->_POST['content']);
    $data = [];
    $data['url_back'] = App::URL('');
    App::Show($data, 'dialog');
}
function action_do_add()
{
    add_data(App::SG()->_POST['content']);
    $data = [];
    $data['url_back'] = DN::URL('');
    App::Show($data, 'dialog');
}
function URL($url)
{
    return App::URL($url);
}
function H($str)
{
    return App::H($str);
}
////////////////////////////////////

class MyView extends \DuckPhp\Core\View
{
    public function _Show($data = [], $view)
    {
        global $view_data;
        $this->data = array_merge($this->data, $data);
        $view_data=$this->data;
        
        $view_data['view']=$view;
    }
    public function _Display($view, $data = null)
    {
        global $view_data;
        $this->data = isset($data)?$data:$this->data;

        $view_data=$this->data;
        $view_data='skip_head_foot']=true;
        $view_data['view']=$view;
    }
}

$options = [];
$options['skip_setting_file'] = true;
$options['is_debug'] = true;
$flag=App::RunQuickly($options,function(){
    Route::G()->add404Handler(function(){
        $path_info=Route::G()->getPathInfo();
        $path_info=ltrim($path_info,'/');
        $path_info=empty($path_info)?'index':$path_info;
        
        $post_prefix=!empty(APP::SG()->_POST)?'do_':'';
        $callback="action_{$post_prefix}{$path_info}";
        
        if(is_callable($callback)){
            ($callback)();
            return true;
        }
        return false;
    });
});
if(!$flag){
    return;
}

if (!$view_data) {
    return;
}

global $view_data;
extract($view_data);


if(!empty($skip_head_foot)){
     ?>
<!doctype html>
<html>
 <meta charset="UTF-8">
<head><title>DuckPhp 单一页面演示</title></head>
<body>
<?php
    echo "<div>Don't run the template file directly, Install it! </div>\n"; //@DUCKPHP_DELETE
?>
<fieldset>
	<legend>DuckPhp 单一页面演示</legend>
	<div style="border:1px red solid;">
<?php
}
if($view===''){
?>
	<h1>首页</h1>
<?php 
    if ($content === '') {
?>
	还没有内容，
	<a href="<?=$url_add?>">添加内容</a>
<?php
    } else {
        ?>
	已经输入，内容为
	<div style="border:1px gray solid;" ><?=$content?></div>
	<a href="<?=$url_edit?>">编辑内容</a>
	<a href="<?=$url_del?>">删除内容（已做GET安全处理）</a>
<?php
    }
?>
<?php
}
if($view==='add'){
?>
	<h1>添加</h1>
	<form method="post" >
		<div><textarea name="content"></textarea></div>
		<input type="submit" />
	</form>
<?php
}
if($view==='edit'){
 ?>
	编辑
	<form method="post">
		<div><textarea name="content"><?=$content?></textarea></div>
		<input type="submit" />
	</form>
<?php
}
if($view==='dialog'){ ?>
	<?php if (!$msg) {?>已经完成<?php } else {
        echo $msg;
    } ?> <a href="<?=$url_back?>">返回主页</a>
<?php
}

if(!empty($skip_head_foot)){
?>
	<hr />
	</div>
</fieldset>
</body>
</html>
<?php
}