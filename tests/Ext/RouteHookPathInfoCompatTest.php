<?php
namespace tests\DuckPhp\Ext;

use DuckPhp\Ext\RouteHookPathInfoCompat;
use DuckPhp\Core\App;
use DuckPhp\Core\Route;
use DuckPhp\Core\SuperGlobal;

class RouteHookPathInfoCompatTest extends \PHPUnit\Framework\TestCase
{
    public function testAll()
    {
        \MyCodeCoverage::G()->begin(RouteHookPathInfoCompat::class);
        
        $route_options=[
            'namespace'=>__NAMESPACE__,
            'namespace_controller'=>'\\'.__NAMESPACE__,
            'controller_welcome_class'=> 'RouteHookPathInfoCompatTestMain',

        ];
        Route::G(new Route())->init($route_options);
        App::G()->init([]);
        $options=[
            'path_info_compact_enable'=>false,
            'path_info_compact_action_key'=>'',
            'path_info_compact_class_key'=>'',

        ];
        RouteHookPathInfoCompat::G(new RouteHookPathInfoCompat())->init($options, App::G());
        
        $options=[
            'path_info_compact_enable'=>true,
            'path_info_compact_action_key'=>'',
            'path_info_compact_class_key'=>'',
        ];
        RouteHookPathInfoCompat::G(new RouteHookPathInfoCompat())->init($options);
        $options=[
            'path_info_compact_enable'=>true,

            'path_info_compact_action_key'=>'_r',
            'path_info_compact_class_key'=>'',
        ];
        RouteHookPathInfoCompat::G()->init($options, App::G());
        
        

        SuperGlobal::G()->_SERVER['REQUEST_URI']='';
        SuperGlobal::G()->_SERVER['PATH_INFO']='';


        Route::G()->prepare([
            'PATH_INFO'=>'Missed',
            'REQUEST_METHOD'=>'POST',
        ]);
        Route::G()->run();
        
        echo "------------------------------------------------\n";
if(true){
        RouteHookPathInfoCompat::G()->onURL("zzz");
        echo "------------------------------------------------\n";
}
        //x/index.php/init
        SuperGlobal::G()->_SERVER['REQUEST_URI']='/x/index.php/model/action';
        SuperGlobal::G()->_SERVER['PATH_INFO']='/model/action';
        SuperGlobal::G()->_SERVER['SCRIPT_FILENAME']='/test/index.php';
        $options=[
            'path_info_compact_action_key'=>'_r',
            'path_info_compact_class_key'=>'m',
        ];
        var_dump(Route::URL('/Test'));

        RouteHookPathInfoCompat::G()->init($options);
        
        var_dump(Route::URL(''));

        var_dump(RouteHookPathInfoCompat::URL('index.php/bb?cc=dd&m=abc'));
        var_dump(RouteHookPathInfoCompat::URL('aa/bb?cc=dd&m=abc'));
        var_dump(RouteHookPathInfoCompat::URL('aa/bb?cc=dd&m='));

        //------------
        
                        RouteHookPathInfoCompat::G()->isInited();

        \MyCodeCoverage::G()->end();
        /*
        RouteHookPathInfoCompat::G()->init($options=[], $context=null);
        RouteHookPathInfoCompat::G()->onURL($url=null);
        RouteHookPathInfoCompat::G()->hook($route);
        //*/
    }
}
class RouteHookPathInfoCompatTestMain
{    
    function index(){
        var_dump(DATE(DATE_ATOM));
    }
}