<?php declare(strict_types=1);
/**
 * DuckPhp
 * From this time, you never be alone~
 */

namespace LazyToChange\System;

use DuckPhp\DuckPhp;

class App extends DuckPhp
{
    //@override
    public $options = [
        // 'use_setting_file' => false,
        // 'use_setting_file' => true,
        
        //'is_debug' => false,
        'is_debug' => true,
        
        //'platform' => '',
        'platform' => 'platform', // @DUCKPHP_DELETE
        
        
        'error_404' => '_sys/error_404',
        'error_500' => '_sys/error_500',
        
        //'path_info_compact_enable' => false,
        //'path_info_compact_enable' => true, // @DUCKPHP_DELETE
        
        // 'helper_map' => DuckPhp::DEFAULT_HELPER_MAP,
    ];
    /**
     * console command sample
     */
    public function command_routes()
    {
        echo "override you the routes\n";
    }
    public function __construct()
    {
        parent::__construct();
        $options = [];

        // @autogen by tests/genoptions.php
        // ---- 脚本生成,下面是可用的默认选项 ---- 

        // 所有配置 (DuckPhp\Core\Configer)
        // $options['all_config'] = array ( );

        // 在 cli 下开启缓存模式 (DuckPhp\Core\AutoLoader)
        // $options['autoload_cache_in_cli'] = false;

        // 自动加载的目录和命名空间映射 (DuckPhp\Core\AutoLoader)
        // $options['autoload_path_namespace_map'] = array ( );

        // 在输出前关闭资源（DB,Redis） (DuckPhp\Core\App)
        // $options['close_resource_at_output'] = false;

        // 额外的配置文件数组 (DuckPhp\Core\Configer)
        // $options['config_ext_files'] = array ( );

        // 控制器基类 (DuckPhp\Core\Route, DuckPhp\Ext\StrictCheck)
        // $options['controller_base_class'] = NULL;

        // 控制器类名后缀 (DuckPhp\Core\Route)
        // $options['controller_class_postfix'] = '';

        // 激活兼容后缀的 /  (DuckPhp\Core\Route)
        // $options['controller_enable_slash'] = false;

        // 控制器标记，隐藏特别的入口 (DuckPhp\Core\Route)
        // $options['controller_hide_boot_class'] = false;

        // 控制器，缺失方法的调用方法 (DuckPhp\Core\Route)
        // $options['controller_methtod_for_miss'] = '_missing';

        // 扩展名，比如你要 .html (DuckPhp\Core\Route)
        // $options['controller_path_ext'] = '';

        // 控制器，POST 方法前缀 (DuckPhp\Core\Route)
        // $options['controller_prefix_post'] = 'do_';

        // 控制器禁止直接访问G方法 (DuckPhp\Core\Route)
        // $options['controller_stop_g_method'] = false;

        // 控制器禁止直接访问静态方法 (DuckPhp\Core\Route)
        // $options['controller_stop_static_method'] = false;

        // 控制器使用单例模式 (DuckPhp\Core\Route)
        // $options['controller_use_singletonex'] = false;

        // 控制器默认欢迎方法 (DuckPhp\Core\Route)
        // $options['controller_welcome_class'] = 'Main';

        // 单一数据库配置 (DuckPhp\Ext\DbManager)
        // $options['database'] = NULL;

        // 是否扩充方法至助手类 (DuckPhp\Ext\DbManager)
        // $options['database_auto_method_extend'] = true;

        // 数据库列表 (DuckPhp\Ext\DbManager)
        // $options['database_list'] = NULL;

        // 从设置里读取数据库列表 (DuckPhp\Ext\DbManager)
        // $options['database_list_reload_by_setting'] = true;

        // 尝试使用单一数据库配置 (DuckPhp\Ext\DbManager)
        // $options['database_list_try_single'] = true;

        // 记录sql 错误等级 (DuckPhp\Ext\DbManager)
        // $options['database_log_sql_level'] = 'debug';

        // 记录sql 查询 (DuckPhp\Ext\DbManager)
        // $options['database_log_sql_query'] = false;

        // 错误的时候打开日志 (DuckPhp\Core\App)
        // $options['default_exception_do_log'] = true;

        // 错误的时候打开日志 (DuckPhp\Core\App)
        // $options['default_exception_self_display'] = true;

        // 404 页面 (DuckPhp\Core\App)
        // $options['error_404'] = NULL;

        // 500 页面 (DuckPhp\Core\App)
        // $options['error_500'] = NULL;

        // 错误调试页面 (DuckPhp\Core\App)
        // $options['error_debug'] = NULL;

        // 默认开启的扩展 (DuckPhp\Core\App)
        // $options['ext'] = array ( );

        // 助手类映射，比较复杂 (DuckPhp\Core\App)
        // $options['injected_helper_map'] = '';

        // 是否调试状态 (DuckPhp\Core\App, DuckPhp\Ext\StrictCheck)
        // $options['is_debug'] = false;

        // 日志文件名模板 (DuckPhp\Core\Logger)
        // $options['log_file_template'] = 'log_%Y-%m-%d_%H_%i.log';

        // 日志前缀 (DuckPhp\Core\Logger)
        // $options['log_prefix'] = 'DuckPhpLog';

        // 命名空间 (DuckPhp\Core\App, DuckPhp\Core\AutoLoader, DuckPhp\Core\Route, DuckPhp\Ext\RouteHookApiServer, DuckPhp\Ext\StrictCheck)
        // $options['namespace'] = 'LazyToChange';

        // 控制器的命名空间 (DuckPhp\Core\Route, DuckPhp\Ext\StrictCheck)
        // $options['namespace_controller'] = 'Controller';

        // 重写类名 (DuckPhp\Core\App)
        // $options['override_class'] = '';

        // 基础目录 (DuckPhp\Core\App, DuckPhp\Core\AutoLoader, DuckPhp\Core\Configer, DuckPhp\Core\Logger, DuckPhp\Core\View, DuckPhp\Ext\CallableView, DuckPhp\Ext\EmptyView, DuckPhp\Ext\Misc)
        // $options['path'] = '';

        // 配置目录 (DuckPhp\Core\Configer)
        // $options['path_config'] = 'config';

        // GET 动作方法名的 key (DuckPhp\Ext\RouteHookPathInfoCompat)
        // $options['path_info_compact_action_key'] = '_r';

        // GET 模式类名的 key (DuckPhp\Ext\RouteHookPathInfoCompat)
        // $options['path_info_compact_class_key'] = '';

        // 使用 _GET 模拟无 PathInfo 配置 (DuckPhp\Ext\RouteHookPathInfoCompat)
        // $options['path_info_compact_enable'] = false;

        // 日志目录 (DuckPhp\Core\Logger)
        // $options['path_log'] = 'logs';

        // 命名空间目录 (DuckPhp\Core\AutoLoader)
        // $options['path_namespace'] = 'app';

        // 视图目录 (DuckPhp\Core\View, DuckPhp\Ext\CallableView, DuckPhp\Ext\EmptyView)
        // $options['path_view'] = 'view';

        // 覆盖视图目录 (DuckPhp\Core\View, DuckPhp\Ext\CallableView, DuckPhp\Ext\EmptyView)
        // $options['path_view_override'] = '';

        // 平台 (DuckPhp\Core\App)
        // $options['platform'] = '';

        // 路由映射 (DuckPhp\Ext\RouteHookRouteMap)
        // $options['route_map'] = array ( );

        // 是否扩充方法至助手类 (DuckPhp\Ext\RouteHookRouteMap)
        // $options['route_map_auto_extend_method'] = true;

        // 路由配置名，使用配置模式用路由 (DuckPhp\Ext\RouteHookRouteMap)
        // $options['route_map_by_config_name'] = '';

        // 重要路由映射 (DuckPhp\Ext\RouteHookRouteMap)
        // $options['route_map_important'] = array ( );

        // 设置，预先载入的设置 (DuckPhp\Core\Configer)
        // $options['setting'] = array ( );

        // 设置文件 (DuckPhp\Core\Configer)
        // $options['setting_file'] = 'setting';

        // 跳过404处理 (DuckPhp\Core\App)
        // $options['skip_404_handler'] = false;

        // 跳过 自动加载 (DuckPhp\Core\AutoLoader)
        // $options['skip_app_autoload'] = false;

        // 跳过异常检查 (DuckPhp\Core\App)
        // $options['skip_exception_check'] = false;

        // 跳过 PATH_INFO 修复 (DuckPhp\Core\Route)
        // $options['skip_fix_path_info'] = false;

        // 跳过插件模式检查 (DuckPhp\Core\App)
        // $options['skip_plugin_mode_check'] = false;

        // 跳过 View 视图的 notice (DuckPhp\Core\View, DuckPhp\Ext\CallableView, DuckPhp\Ext\EmptyView)
        // $options['skip_view_notice_error'] = true;

        // 使用系统自带加载器 (DuckPhp\Core\App)
        // $options['use_autoloader'] = false;

        // 使用 .env 文件 (DuckPhp\Core\Configer)
        // $options['use_env_file'] = false;

        // 从设置文件里再入is_debug,platform.  (DuckPhp\Core\App)
        // $options['use_flag_by_setting'] = true;

        // 使用 OB 函数缓冲数据 (DuckPhp\Core\RuntimeState)
        // $options['use_output_buffer'] = false;

        // 使用设置文件 (DuckPhp\Core\Configer)
        // $options['use_setting_file'] = false;

        // 使用短函数， \_\_url, \_\_h 等 ，详见 Core\Functions.php (DuckPhp\Core\App)
        // $options['use_short_functions'] = true;

        // 使用super_global 类。关闭以节约性能 (DuckPhp\Core\App)
        // $options['use_super_global'] = true;

        // ---- 下面是默认未使用的扩展 ----

        /*
        $options['ext']['DuckPhp\\Ext\\CallableView'] = true;
            // callableview 视图类
            $options['callable_view_class'] = NULL;

            // callableview 页脚
            $options['callable_view_foot'] = NULL;

            // callableview 页眉
            $options['callable_view_head'] = NULL;

            // callableview 视图函数模板
            $options['callable_view_prefix'] = NULL;

            // callableview 可调用视图跳过默认视图替换
            $options['callable_view_skip_replace'] = false;

            // 【共享】基础目录
            // $options['path'] = '';

            // 【共享】视图目录
            // $options['path_view'] = 'view';

            // 【共享】覆盖视图目录
            // $options['path_view_override'] = '';

            // 【共享】跳过 View 视图的 notice
            // $options['skip_view_notice_error'] = true;

        //*/
        /*
        $options['ext']['DuckPhp\\Ext\\Console'] = true;
            // 命令行类别名
            $options['cli_command_alias'] = array ( );

            // 启用命令行
            $options['cli_enable'] = true;

            // 命令行启用模式
            $options['cli_mode'] = 'replace';

        //*/
        /*
        $options['ext']['DuckPhp\\Ext\\EmptyView'] = true;
            // 给View 的key
            $options['empty_view_key_view'] = 'view';

            // 默认的 Main
            $options['empty_view_key_wellcome_class'] = 'Main/';

            // 跳过默认的view
            $options['empty_view_skip_replace'] = false;

            // 跳过 Main/
            $options['empty_view_trim_view_wellcome'] = true;

            // 【共享】基础目录
            // $options['path'] = '';

            // 【共享】视图目录
            // $options['path_view'] = 'view';

            // 【共享】覆盖视图目录
            // $options['path_view_override'] = '';

            // 【共享】跳过 View 视图的 notice
            // $options['skip_view_notice_error'] = true;

        //*/
        /*
        $options['ext']['DuckPhp\\Ext\\FacadesAutoLoader'] = true;
            // 使用 facdes 的 autoload
            $options['facades_enable_autoload'] = true;

            // facade 映射
            $options['facades_map'] = array ( );

            // facades 开始的namespace
            $options['facades_namespace'] = 'Facades';

        //*/
        /*
        $options['ext']['DuckPhp\\Ext\\JsonRpcExt'] = true;
            // json 的后端
            $options['jsonrpc_backend'] = 'https://127.0.0.1';

            // 设置 token 检查回调
            $options['jsonrpc_check_token_handler'] = NULL;

            // json 启用 autoload
            $options['jsonrpc_enable_autoload'] = true;

            // jsonrpc 是否开启 debug 模式
            $options['jsonrpc_is_debug'] = false;

            // jsonrpc 默认的命名空间
            $options['jsonrpc_namespace'] = 'JsonRpc';

            // json 服务接口
            $options['jsonrpc_service_interface'] = '';

            // json 命名空间
            $options['jsonrpc_service_namespace'] = '';

            // jsonrpc 自动调整 wrap
            $options['jsonrpc_wrap_auto_adjust'] = true;

        //*/
        /*
        $options['ext']['DuckPhp\\Ext\\Misc'] = true;
            // 是否扩方法至助手类
            $options['misc_auto_method_extend'] = true;

            // 【共享】基础目录
            // $options['path'] = '';

            // 库目录
            $options['path_lib'] = 'lib';

        //*/
        /*
        $options['ext']['DuckPhp\\Ext\\RedisCache'] = true;
            //  redis cache 缓存前缀
            $options['redis_cache_prefix'] = '';

            // redis cache 跳过 默认 cache替换
            $options['redis_cache_skip_replace'] = false;

        //*/
        /*
        $options['ext']['DuckPhp\\Ext\\RedisManager'] = true;
            // 单一Redisc配置
            $options['redis'] = NULL;

            // 是否扩充方法至助手类
            $options['redis_auto_extend_method'] = true;

            //  redis 配置列表
            $options['redis_list'] = NULL;

            //  redis 使用 settting 文件
            $options['redis_list_reload_by_setting'] = true;

            // 尝试使用单一Redis配置
            $options['redis_list_try_single'] = true;

        //*/
        /*
        $options['ext']['DuckPhp\\Ext\\RouteHookApiServer'] = true;
            // API服务器， 404 引发异常的模式
            $options['api_server_404_as_exception'] = false;

            // API服务器， 接口，或基类，  ~ 开始的表示是当前命名空间
            $options['api_server_base_class'] = '';

            // API服务器， 类名后缀
            $options['api_server_class_postfix'] = '';

            // API服务器， 命名空间，配合 namespace选项使用
            $options['api_server_namespace'] = 'Api';

            // API服务器，  使用可变单例模式，方便替换实现
            $options['api_server_use_singletonex'] = false;

            // 【共享】命名空间
            // $options['namespace'] = '';

        //*/
        /*
        $options['ext']['DuckPhp\\Ext\\RouteHookDirectoryMode'] = true;
            // 目录模式的基类
            $options['mode_dir_basepath'] = '';

        //*/
        /*
        $options['ext']['DuckPhp\\Ext\\RouteHookRewrite'] = true;
            // 是否扩充方法至助手类
            $options['rewrite_auto_extend_method'] = true;

            // 目录重写映射
            $options['rewrite_map'] = array ( );

        //*/
        /*
        $options['ext']['DuckPhp\\Ext\\StrictCheck'] = true;
            // 【共享】控制器基类
            // $options['controller_base_class'] = NULL;

            // 【共享】是否调试状态
            // $options['is_debug'] = false;

            // 【共享】命名空间
            // $options['namespace'] = 'LazyToChange';

            // strict_check 的business目录
            $options['namespace_business'] = '';

            // 【共享】控制器的命名空间
            // $options['namespace_controller'] = 'Controller';

            // strict_check 的model 目录
            $options['namespace_model'] = '';

            // batchbusiness
            $options['postfix_batch_business'] = 'BatchBusiness';

            //  businesslib
            $options['postfix_business_lib'] = 'Lib';

            // ExModel
            $options['postfix_ex_model'] = 'ExModel';

            // model
            $options['postfix_model'] = 'Model';

            // 不用传输过来的 app类，而是特别指定类
            $options['strict_check_context_class'] = NULL;

            // 是否开启 strict chck
            $options['strict_check_enable'] = true;

        //*/
        // @autogen end
        
        $this->options = array_replace_recursive($this->options, $options);
    }
    //@override
    protected function onPrepare()
    {
        //your code here
    }
    //@override
    protected function onInit()
    {
        // your code here
    }
    //@override
    protected function onRun()
    {
        // your code here
    }
}
