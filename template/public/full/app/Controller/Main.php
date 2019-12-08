<?php
namespace MY\Controller;

use MY\Base\Helper\ControllerHelper as C;

class Main
{
    public function __construct()
    {
        $path=parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
        $is_no_path_info_mode=($path==='/no-path-info.php')?true:false;
        $url_phpinfo=C::URL('i');
        C::assignViewData(get_defined_vars());
    }
	public function index()
	{
        $ret=[];
        for($i=0;$i<6;$i++){
            //$t=mt_rand(0,3);
            //var_dump($t);
        }
		C::Show(get_defined_vars(),'main');
	}
    public function i()
    {
        phpinfo();
    }
    protected function getClass($class)
    {
        $t=$class::GetExtendStaticStaticMethodList();
        $ret=array_keys($t);
        $z=new \ReflectionClass($class);
        $methods=$z->getMethods();
        foreach($methods as $v){
            if(!$v->isStatic()){
                continue;
            }
            $ret[]=$v->getName();
        }
        return $ret;
    }
}