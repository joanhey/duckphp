<?php declare(strict_types=1);
/**
 * DuckPHP
 * From this time, you never be alone~
 */
require(__DIR__.'/../../../../autoload.php');  // @DUCKPHP_HEADFILE

use DuckPhp\Core\Route;

class Main
{
    public function index()
    {
        var_dump("Just route test done");
        var_dump(DATE(DATE_ATOM));
    }
    public function i()
    {
        phpinfo();
    }
}
$options = [
    'namespace_controller' => '\\',
];
$flag = Route::RunQuickly($options);
if (!$flag) {
    header(404);
    echo "404!";
}
