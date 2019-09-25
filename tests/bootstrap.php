<?php
require __DIR__ . '/../autoload.php';


/*
$dest=__DIR__.'/../tests';
$source=__DIR__.'/../src';

TestFileGenerator::Run($source,$dest);
return;
*/
//-----------------------------------------------




class MyCodeCoverage
{
    protected static function include_file($file)
    {
        return include $file;
    }
    public function createReport()
    {
        $path=realpath(__DIR__.'/../src');
        $coverage = new \SebastianBergmann\CodeCoverage\CodeCoverage();
        $coverage->filter()->addDirectoryToWhitelist($path);
        $coverage->setTests(array (
          'T' => 
          array (
            'size' => 'unknown',
            'status' => -1,
          ),
        ));

        $source=realpath(__DIR__.'/dumps');
        $directory = new \RecursiveDirectoryIterator($source, \FilesystemIterator::CURRENT_AS_PATHNAME | \FilesystemIterator::SKIP_DOTS);

        $iterator = new \RecursiveIteratorIterator($directory);
        $files = \iterator_to_array($iterator, false);
        foreach ($files as $file) {
            $coverage->merge(static::include_file($file));
            
        }

        $writer = new \SebastianBergmann\CodeCoverage\Report\Html\Facade;
        $writer->process($coverage,__DIR__ . '/reports');
        
    }
    static function G($object=null)
    {
        //Simplist
        static $_instance;
        $_instance=$object?:($_instance??new static);
        return $_instance;
    }
    protected $coverage;
    protected $test_class;
    protected function setPath($path)
    {
        if(is_file($path)){
            $this->coverage->filter()->addFileToWhitelist($path);
        }elseif (is_object($path)) {
            $this->coverage->setFileter($path);
        }else{
            $this->coverage->filter()->addDirectoryToWhitelist($path);
        }
    }
    public function classToPath($class)
    {
        $ref=new ReflectionClass($class);
        return $ref->getFileName();
    }
    public function begin($class,$name='T')
    {
        $this->test_class=$class;
        $this->coverage = new \SebastianBergmann\CodeCoverage\CodeCoverage();
        $this->setPath($this->classToPath($class));
        $this->coverage->start($name);
    }
    public function end()
    {
        $this->coverage->stop();
        
        $writer = new \SebastianBergmann\CodeCoverage\Report\PHP;
        $path=substr(str_replace('\\','/',$this->test_class),strlen('DNMVCS\\'));
        $path=__DIR__.'/dumps/'.$path .'.php';
        $writer->process($this->coverage,$path);
        $this->coverage=null;
        $this->test_class='';
    }
    
    ///////////////////////
    public function run($path,$name,$callback)
    {
        $this->begin($path,$name);
        ($callback)($path,$name);
        return $this->end();
    }
    public function merge($path,$name,$data_list)
    {
        $coverage =$this->coverage??new \SebastianBergmann\CodeCoverage\CodeCoverage;
        $this->setPath($path);
        foreach($data_list as $data){
            $this->coverage->append($data,$name);
        }
    }
    public function reportHtml($output_path)
    {
        $writer = new \SebastianBergmann\CodeCoverage\Report\Html\Facade;
        $writer->process($this->coverage,$output_path);
    }
    public function report($output_path)
    {
        /*
        $report = $this->coverage->getReport();
        $t=$report->getClasses();
        $ret=array_shift($t);
        unset($ret['methods']);
        var_dump( $ret );
        
        return;
        */
        $writer = new \SebastianBergmann\CodeCoverage\Report\Text;
        $x=$writer->process($this->coverage,$output_path);
        echo $x;
    }
    public function clear()
    {
        $this->coverage=null;
    }
}
$dest=realpath(__DIR__.'/../tests/').'/input2/';
$source=realpath(__DIR__.'/../src/').'/';

class TestFileGenerator
{
    static function Run($source,$dest)
    {
        $source=realpath($source).'/';
        $dest=realpath($dest).'/';
        
        $directory = new \RecursiveDirectoryIterator($source, \FilesystemIterator::CURRENT_AS_PATHNAME | \FilesystemIterator::SKIP_DOTS);
        $iterator = new \RecursiveIteratorIterator($directory);
        $files = \iterator_to_array($iterator, false);
        foreach ($files as $file) {
            $short_file=substr($file,strlen($source));
            
            if($short_file==='Ext/Oldbones.php' || $short_file==='Ext/Lazybones.php'){
                continue;
            }
            static::MakeDir($short_file,$dest);
            
            $data =static::MakeTest($file,$short_file);
            
            $file_name=$dest.str_replace('.php','Test.php',$short_file);
            if( is_file($file_name)){
                echo "File Exists:".$file_name."\n";
                continue;
            }
            file_put_contents($file_name,$data);
        }
    }
    protected static function MakeDir($short_file,$dest)
    {
        $blocks=explode(DIRECTORY_SEPARATOR, $short_file);
        array_pop($blocks);
        $full_dir=$dest;
        foreach ($blocks as $t) {
            $full_dir.=DIRECTORY_SEPARATOR.$t;
            if (!is_dir($full_dir)) {
                mkdir($full_dir);
            }
        }
    }
    protected static function MakeTest($file,$short_file)
    {
        $data=file_get_contents($file);
        preg_match_all('/ function (([^\(]+)\([^\)]*\))/',$data,$m);
        $funcs=$m[1];
        
        $ns='DNMVCS\\'.str_replace('/','\\',dirname($short_file));
        $namespace='tests\\'.str_replace('/','\\',dirname($short_file));
        if(dirname($short_file)=='.'){
            $namespace='tests';
        }
        $class=basename($short_file,'.php').'Test';
        $init_class=basename($short_file,'.php').'';
        $ret='<'.'?php';
        $ret.=<<<EOT

use {$ns}\\{$init_class};

class $class extends \PHPUnit\Framework\TestCase
{
    public function testAll()
    {
        \$this->assertTrue(true);return;

EOT;
        foreach ($funcs as $v) {
            $v=str_replace('&','',$v);
            $ret.=<<<EOT
        {$init_class}::G()->$v;

EOT;
    }
            $ret.=<<<EOT
        \$this->assertTrue(true);
    }
}

EOT;

        return $ret;
    }
}