# DuckPhp\Helper\HelperTrait

## 简介
所有助手类都有的trait

## 助手类公用方法列表
- IsDebug()

    判断是否在调试状态，App 的  `is_debug` 选项 ,`duckphp_is_debug` 设置项。
    
- IsRealDebug()
    这个用于调试标识开，但是实际还是调试状态。用于特定用处。
    
- Platform()
    获得平台标志，App 的  `platform` 选项 ,`duckphp_platform` 设置项。
    
- Logger($object=null)
    返回Logger类。
    $object 是替换入的新的 Logger 类。


- AssignExtendStaticMethod($key, $value = null)   详见 [Core/ExtendableStaticCallTrait](Core-ExtendableStaticCallTrait.md)
    分配固定方法。

- GetExtendStaticMethodList() 详见 [Core/ExtendableStaticCallTrait](Core-ExtendableStaticCallTrait.md)
    获得
- \_\_callStatic($name, $arguments) 详见 [Core/ExtendableStaticCallTrait](Core-ExtendableStaticCallTrait.md)
    静态方法已经被接管。

- debug_log($message, $context=[])
    测试状态 Log 数据。
    
- trace_dump()
    显示调用堆栈
    
- var_dump(...$args)
    替代 var_dump ，在非调试状态下不显示
## 详解

HelperTrait 只有静态方法

`__callStatic` 和 `GetExtendStaticMethodList`, `AssignExtendStaticMethod`, 是 来自 `Core/ExtendableStaticCallTrait`
