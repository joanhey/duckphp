<?php
namespace tests\DuckPhp\Ext;

use DuckPhp\Ext\Misc;
use DuckPhp\DuckPhp;
use DuckPhp\SingletonEx\SingletonEx;

class MiscTest extends \PHPUnit\Framework\TestCase
{
    public function testAll()
    {
        \MyCodeCoverage::G()->begin(Misc::class);
        $path_lib=\MyCodeCoverage::GetClassTestPath(Misc::class);
        $options=[
            'path'=>$path_lib,
            'path_lib'=>'',
        ];
        Misc::G()->init($options,DuckPhp::G());
        $options=[
            'path_lib'=>$path_lib,
            'use_super_global'=>false,
            'error_404'=>null,
        ];
        Misc::G()->init($options,DuckPhp::G());
        
        Misc::Import('file');
        
        $data=[];
        Misc::RecordsetUrl($data);
        Misc::RecordsetH($data);
        
        $data=[['id'=>'1','text'=>'<b>'],['id'=>'2','text'=>'&']];
        Misc::RecordsetUrl($data, []);
        $ret=Misc::RecordsetUrl($data, ['url'=>'edit/{id}']);
        $data=Misc::RecordsetH($data);
        print_r($data);
        
        
        
        DuckPhp::G()->system_wrapper_replace([
            'exit' =>function(){ echo "change!\n";},
        ]);
        DuckPhp::G()->init($options)->run();
        
        
        DuckPhp::G()->setRouteCallingMethod('m1');

        DuckPhp::G()->setRouteCallingMethod('m1');
        
        $object=new \stdClass();
        Misc::DI('a',$object);
        Misc::DI('a');
        
        try{
            Misc::CallAPI(FakeService::class,'m1',['id'=>'1'],FakeInterface::class);
        }catch(\Exception $ex){
        }
        try{
            Misc::CallAPI(FakeService::class,'m2',['id'=>[]],"");
        }catch(\Exception $ex){
        }
        try{
            Misc::CallAPI(FakeService::class,'m1',[]);
        }catch(\Exception $ex){
        }
                    Misc::CallAPI(FakeService::class,'m1',['id'=>'1']);
        Misc::G()->isInited();

        \MyCodeCoverage::G()->end();
        /*
        Misc::G()->init($options=[], $context=null);
        Misc::G()->_Import($file);
        Misc::G()->_RecordsetUrl($data, $cols_map=[]);
        Misc::G()->_RecordsetH($data, $cols=[]);
        Misc::G()->callAPI($class, $method, $input);
        Misc::G()->mapToService($serviceClass, $input);
        Misc::G()->explodeService($object, $namespace=null);
        //*/
    }
    
}
interface FakeInterface
{
    public function foo();
}
class FakeService
{
    use SingletonEx;

    public function m1(int $id,string $name="xx")
    {
        return DATE(DATE_ATOM);
    }
public function m2(int $id)
    {
        return DATE(DATE_ATOM);
    }
}
class FakeObject 
{
    public $fakeService=null;
    public $notServcieVar=null;
    
    use SingletonEx;
    public function foo()
    {
        var_dump(DATE(DATE_ATOM));
    }
}
