# DuckPhp\Core\View
[toc]

## 简介
`组件类` 视图类
## 选项
'path' => '',

    路径
'path_view' => 'view',

    视图路径
'path_view_override' => '',

    用于覆盖的路径——用于插件模式
'skip_view_notice_error' => true,

    关闭 notice 警告，以避免麻烦的处理。


## 公开方法

public function _Show($data = [], $view)

    显示文件，包括页眉页脚
public function _Display($view, $data = null)

    显示文件，不包括页眉页脚
public function setViewHeadFoot($head_file, $foot_file)

    设置页眉页脚
public function assignViewData($key, $value = null)

    设置要显示的数据，可批量
public function setOverridePath($path)

    插件模式下设置视图路径

## 内部方法

protected function getViewFile($path, $view)

    获得 View 文件。
## 详解

DuckPhp\Core\View 的选项共享一个 path,带一个 path_view.

path_view 如果是 / 开始的，会忽略 path 选项

当你想把视图目录 放入 app 目录的时候，请自行调整 path_view

setOverridePath 用于 AppPluginTrait