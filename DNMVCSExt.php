<?php
namespace DNMVCS;

class SimpleRouteHook
{
	use DNSingleton;

	public $key_for_simple_route='_r';
	public function onURL($url=null)
	{
		$key_for_simple_route=$this->key_for_simple_route;
		
		$path='';
		if(class_exists('\DNMVCS\SuperGlobal' ,false)){
			$path=SuperGlobal::SERVER('REQUEST_URI');
			$path_info=SuperGlobal::SERVER('PATH_INFO');
		}else{
			$path=$_SERVER['REQUEST_URI'];
			$path_info=$_SERVER['PATH_INFO'];
		}
		$path=parse_url($path,PHP_URL_PATH);
		
		if(strlen($path_info)){
			$path=substr($path,0,0-strlen($path_info));
		}
		if($url===null || $url===''){return $path;}
		$c=parse_url($url,PHP_URL_PATH);
		$q=parse_url($url,PHP_URL_QUERY);

		$q=$q?'&'.$q:'';
		$url=$path.'?'.$key_for_simple_route.'='.$c.$q;
		return $url;
	
	}
	public function hook($route)
	{
		$route->setURLHandler([$this,'onURL']);

		if(class_exists('\DNMVCS\SuperGlobal' ,false)){
			$path_info=SuperGlobal::REQUEST($k);
		}else{
			$path_info=$_REQUEST[$k]??null;
		}
	
		
		
		$path_info=ltrim($path_info,'/');
		$route->path_info=$path_info;
		$route->calling_path=$path_info;
	}
}
class StrictService
{
	use DNSingleton { G as public parentG;}
	public static function G($object=null)
	{
		$object=self::_before_instance($object);
		return static::parentG($object);
	}
	
	public static function _before_instance($object)
	{
		if(!DNMVCS::Developing()){return $object;}
		$class=static::class;
		list($_0,$_1,$caller)=debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS,3);
		$caller_class=$caller['class'];
		$namespace=DNMVCS::G()->options['namespace'];
		if(substr($class,0,0-strlen("LibService"))=="LibService"){
			do{
				if(substr($caller_class,0,strlen("\\$namespace\\Service\\"))=="\\$namespace\\Service\\"){break;}
				if(substr($caller_class,0,0-strlen("Service"))=="Service"){break;}
				DNMVCS::ThrowOn(true,"LibService Must Call By Serivce");
			}while(false);
		}else{
			do{
				if(substr($caller_class,0,strlen("\\$namespace\\Service\\"))=="\\$namespace\\Service\\"){
					DNMVCS::ThrowOn(true,"Service Can not call Service");
				}
				if(substr($caller_class,0,strlen("Service"))=="Service"){
					DNMVCS::ThrowOn(true,"Service Can not call Service");
				}
				if(substr($caller_class,0,strlen("\\$namespace\\Model\\"))=="\\$namespace\\Model\\"){
					DNMVCS::ThrowOn(true,"Service Can not call by Model");
				}
				if(substr($caller_class,0,strlen("Model"))=="Model"){
					DNMVCS::ThrowOn(true,"Service Can not call by Model");
				}	
				
			}while(false);
		}
		return $object;
	}	
}
class StrictModel
{
	use DNSingleton { G as public parentG;}
	public static function G($object=null)
	{
		$object=self::_before_instance($object);
		return static::parentG($object);
	}
	public static function _before_instance($object)
	{
		
		if(!DNMVCS::Developing()){return $object;}
		list($_0,$_1,$caller)=debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS,3);
		$caller_class=$caller['class'];
		$namespace=DNMVCS::G()->options['namespace'];
		do{
			if(substr($caller_class,0,strlen("\\$namespace\\Service\\"))=="\\$namespace\\Service\\"){break;}
			if(substr($caller_class,0,0-strlen("Service"))=="Service"){break;}
			if(substr($caller_class,0,0-strlen("ExModel"))=="ExModel"){break;}
			DNMVCS::ThrowOn(true,"Model Can Only call by Service or ExModel!");
		}while(false);
		return $object;
	}
}
class DBExt extends DNDB
{
	//Warnning, escape the key by yourself
	protected function quote_array($array)
	{
		$this->check_connect();
		$a=array();
		foreach($array as $k =>$v){
			$a[]=$k.'='.$this->pdo->quote($v);
		}
		return implode(',',$a);
	}
	public function find($table_name,$id,$key='id')
	{
		$sql="select {$table_name} from terms where {$key}=? limit 1";
		return $this->fetch($sql,$id);
	}
	
	public function insert($table_name,$data,$return_last_id=true)
	{
		$sql="insert into {$table_name} set ".$this->quote_array($data);
		$ret=$this->execQuick($sql);
		if(!$return_last_id){return $ret;}
		$ret=$this->pdo->lastInsertId();
		return $ret;
	}
	public function delete($table,$id,$key='id')
	{
		throw new Exception("DNMVCS Fatal : override me to delete");
		$sql="delete from {$table_name} where {$key}=? limit 1";
		return $this->execQuick($sql,$id);
	}
	
	public function update($table_name,$id,$data,$key='id')
	{
		if($data[$key]){unset($data[$key]);}
		$frag=$this->quote_array($data);
		$sql="update {$table_name} set ".$frag." where {$key}=?";
		$ret=$this->execQuick($sql,$id);
		return $ret;
	}
}



class ProjectCommonAutoloader
{
	use DNSingleton;
	protected $path_common;
	public function init($options)
	{
		$this->path_common=isset($options['fullpath_project_share_common'])??'';
		return $this;
	}
	public function run()
	{
		spl_autoload_register(function($class){
			if(strpos($class,'\\')!==false){ return; }
			$path_common=$this->path_common;
			if(!$path_common);return;
			$flag=preg_match('/Common(Service|Model)$/',$class,$m);
			if(!$flag){return;}
			$file=$path_common.'/'.$class.'.php';
			if (!$file || !file_exists($file)) {return;}
			require $file;
		});
	}
}
class ProjectCommonConfiger extends DNConfiger
{
	public $fullpath_config_common;

	public function init($path,$options)
	{
		$this->fullpath_config_common=isset($options['fullpath_config_common'])??'';
		return parent::init($path,$options);
	}
	protected function loadFile($basename,$checkfile=true)
	{	
		$common_config=[];
		if($this->fullpath_config_common){
			$file=$this->fullpath_config_common.$basename.'.php';
			if(is_file($file)){
				$common_config=(function($file){return include($file);})($file);
			}
		}
		$ret=parent::loadFile($basename,$checkfile);
		$ret=array_merge($common_config,$ret);
		return $ret;
	}
	
}
class FunctionDispatcher 
{
	use DNSingleton;
	
	protected $path_info;
	public $post_prefix='do_';
	public $prefix='action_';
	public $default_callback='action_index';
	public function hook($route)
	{
		$this->path_info=$route->path_info;
		$route->callback=[$this,'runRoute'];
	}
	public function runRoute()
	{
		//TODO 和
		$post=(DNRoute::G()->request_method==='POST')?$this->post_prefix:'';
		$callback=$this->prefix.$post.$this->path_info;
		if(is_callable($callback)){
			($callback)();
		}else{
			if(is_callable($this->default_callback)){
				($this->default_callback)();
			}else{
				(DNRoute::G()->the404Handler)();
				return false;
			}
		}
		return true;;
	}
	
}
class FunctionView extends DNView
{
	public $prefix='view_';
	public $head_callback;
	public $foot_callback;
	
	private $callback;
	
	public function init($path)
	{
		$ret=parent::init($path);
		$options=DNMVCS::G()->options;
		$this->head_callback=$options['function_view_head']??'';
		$this->foot_callback=$options['function_view_foot']??'';
		return $ret;
	}
	protected function includeShowFiles()
	{
		extract($this->data);
		
		if($this->head_callback){
			if(is_callable($this->head_callback)){
				($this->head_callback)($this->data);
			}
		}else{
			if($this->head_file){
				$this->head_file=rtrim($this->head_file,'.php').'.php';
				include($this->path.$this->head_file);
			}
		}
		
		$this->callback=$this->prefix.$this->view;
		if(is_callable($this->callback)){
			($this->callback)($this->data);
		}else{
			include($this->view_file);
		}
		
		if($this->head_callback){
			if(is_callable($this->foot_callback)){
				($this->foot_callback)($this->data);
			}
		}else{
			if($this->foot_file){
				$this->foot_file=rtrim($this->foot_file,'.php').'.php';
				include($this->path.$this->foot_file);
			}
		}
	}
}
class DNMVCSExt
{
	use DNSingleton;
	const DEFAULT_OPTIONS_EX=[
			'setting_file_basename'=>'setting',
			'key_for_simple_route'=>null,
			
			'use_function_view'=>false,
				'function_view_head'=>'view_header',
				'function_view_foot'=>'view_footer',
			'use_function_dispatch'=>false,
			'use_common_configer'=>false,
				'fullpath_project_share_common'=>'',
			'use_common_autoloader'=>false,
				'fullpath_config_common'=>'',
			'use_ext_db'=>false,
			'use_strict_db_manager'=>false,
		];
	public function afterInit($dn)
	{
		$dn=DNMVCS::G();
		$ext_options=$dn->options['ext'];
		
		$options=array_merge(self::DEFAULT_OPTIONS_EX,$ext_options);
		
		if($options['use_common_autoloader']){
			ProjectCommonAutoloader::G()->init($options)->run();
		}
		
		if($options['use_common_configer']){
			$dn->initConfiger(DNConfiger::G(ProjectCommonConfiger::G()));
			$dn->isDev=DNConfiger::G()->_Setting('is_dev')??$dn->isDev;
			// 可能要调整测试状态
		}
		if($options['use_function_view']){
			$dn->initView(DNView::G(FunctionView::G()));
		}
		$ReInitDB=false;
		if($options['use_strict_db_manager']){
			DNDBManager::G()->setBeforeGetDBHandler([static::class,'CheckDBPermission']);
		}
		
		if($options['use_ext_db']){
			$options['db_create_handler'] =[DBExt::class,'CreateDBInstance'];
			$options['db_close_handler'] =[DBExt::class,'CloseDBInstance'];
			$ReInitDB=true;
		}
		if($ReInitDB){
			$dn->initDBManager(DNDBManager::G());
		}
		
		if($options['key_for_simple_route']){
			SimpleRouteHook::G()->key_for_simple_route=$options['key_for_simple_route'];
			DNRoute::G()->addRouteHook([SimpleRouteHook::G(),'hook']);
		}
		if($options['use_function_dispatch']){
			DNRoute::G()->addRouteHook([FunctionDispatcher::G(),'hook']);
		}
	}
	public static function CheckDBPermission()
	{
		if(!DNMVCS::Developing()){return;}
		
		list($_0,$_1,$_2,$caller,$bak)=$backtrace=debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS,5);
		
		$caller_class=$caller['class'];
		if($caller_class===DNMVCS::class){$caller_class=$bak['class'];}
		$namespace=DNMVCS::G()->options['namespace'];
		$namespace_controller=DNMVCS::G()->options['namespace_controller'];
		$default_controller_class=DNMVCS::G()->options['default_controller_class'];
		$namespace_controller.='\\';
		do{
			if($caller_class==$default_controller_class){
				DNMVCS::ThrowOn(true,"DB Can not Call By Controller");
			}
			if(substr($caller_class,0,strlen($namespace_controller))==$namespace_controller){
				DNMVCS::ThrowOn(true,"DB Can not Call By Controller");
			}
			
			if(substr($caller_class,0,strlen("\\$namespace\\Service\\"))=="\\$namespace\\Service\\"){
				DNMVCS::ThrowOn(true,"DB Can not Call By Service");
			}
			if(substr($caller_class,0-strlen("Service"))=="Service"){
				DNMVCS::ThrowOn(true,"DB Can not Call By Service");
			}
		}while(false);
	}
	public function _RecordsetUrl(&$data,$cols_map=[])
	{
		//need more quickly;
		if($data===[]){return $data;}
		if($cols_map===[]){return $data;}
		$keys=array_keys($data[0]);
		array_walk($keys,function(&$val,$k){$val='{'.$val.'}';});
		foreach($data as &$v){
			foreach($cols_map as $k=>$r){
				$values=array_values($v);
				$v[$k]=DNMVCS::URL(str_replace($keys,$values,$r));
				
			}
		}
		unset($v);
		return $data;
	}
	public function _RecordsetH(&$data,$cols=[])
	{
		if($data===[]){return $data;}
		$cols=is_array($cols)?$cols:array($cols);
		if($cols===[]){
			$cols=array_keys($data[0]);
		}
		foreach($data as &$v){
			foreach($cols as $k){
				$v[$k]=DNMVCS::H( $v[$k], ENT_QUOTES );
			}
		}
		return $data;
	}
	public function _ExitJson($ret)
	{
		DNView::G()->header('Content-Type:text/json');
		//DNMVCS::G()->onBeforeShow();
		echo json_encode($ret,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK);
		exit;
	}
	public function _ExitRedirect($url,$only_in_site=true)
	{
		if($only_in_site && parse_url($url,PHP_URL_HOST)){
			//something  wrong
			exit;
		}
		DNView::G()->header('location: '.$url);
		DNView::G()->header('',true,302);
		//DNMVCS::G()->onBeforeShow();
		exit;
	}
}
//mysqldump -uroot -p123456 DnSample -d --opt --skip-dump-date --skip-comments | sed 's/ AUTO_INCREMENT=[0-9]*\b//g' >../data/database.sql

