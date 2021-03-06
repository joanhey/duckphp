<?php declare(strict_types=1);
/**
 * DuckPhp
 * From this time, you never be alone~
 */
namespace DuckPhp\Core;

use DuckPhp\Core\ComponentBase;

class View extends ComponentBase
{
    /** @var array */
    public $options = [
        'path' => '',
        'path_view' => 'view',
        'path_view_override' => '',
        'skip_view_notice_error' => true,
    ];
    /** @var string */
    public $path;
    /** @var array */
    public $data = [];
    
    /** @var ?string */
    protected $head_file;
    /** @var ?string */
    protected $foot_file;
    /** @var ?string */
    protected $view_file;
    /** @var int */
    protected $error_reporting_old;
    
    //@override
    protected function initOptions(array $options): void
    {
        $this->path = parent::getComponenetPathByKey('path_view');
    }
    public static function Show(array $data = [], string $view = null): void
    {
        static::G()->_Show($data, $view);
    }
    public static function Display(string $view, ?array $data = null): void
    {
        static::G()->_Display($view, $data);
    }
    
    public function _Show(array $data, string $view): void
    {
        if ($this->options['skip_view_notice_error'] ?? false) {
            $this->error_reporting_old = error_reporting();
            error_reporting($this->error_reporting_old & ~E_NOTICE);
        }
        
        $this->view_file = $this->getViewFile($this->path, $view);
        $this->head_file = $this->getViewFile($this->path, $this->head_file);
        $this->foot_file = $this->getViewFile($this->path, $this->foot_file);
        
        $this->data = array_merge($this->data, $data);
        $data = null;
        $view = null;
        extract($this->data);
        
        if ($this->head_file) {
            include $this->head_file;
        }
        
        include $this->view_file;
        
        if ($this->foot_file) {
            include $this->foot_file;
        }
        if ($this->options['skip_view_notice_error'] ?? false) {
            $this->error_reporting_old = error_reporting();
            error_reporting($this->error_reporting_old & ~E_NOTICE);
        }
    }
    public function _Display(string $view, ?array $data = null): void
    {
        $this->view_file = $this->getViewFile($this->path, $view);
        $this->data = isset($data)?$data:$this->data;
        $data = null;
        $view = null;
        extract($this->data);
        
        include $this->view_file;
    }
    public function reset(): void
    {
        $this->head_file = null;
        $this->foot_file = null;
        $this->data = [];
    }
    public function getViewData(): array
    {
        return $this->data;
    }
    public function setViewHeadFoot(?string $head_file, ?string $foot_file): void
    {
        $this->head_file = $head_file;
        $this->foot_file = $foot_file;
    }
    /**
     *
     * @param mixed $key
     * @param mixed $value
     * @return void
     */
    public function assignViewData($key, $value = null): void
    {
        if (is_array($key) && $value === null) {
            $this->data = array_merge($this->data, $key);
        } else {
            $this->data[$key] = $value;
        }
    }
    public function setOverridePath(string $path): void
    {
        $this->options['path_view_override'] = $path;
    }
    protected function getViewFile(string $path, ?string $view): string
    {
        if (empty($view)) {
            return '';
        }
        $base_file = preg_replace('/\.php$/', '', $view).'.php';
        $file = $path.$base_file;
        if (($this->options['path_view_override'] ?? false) && !is_file($file)) {
            $file = $this->options['path_view_override'].$base_file;
        }
        return $file;
    }
}
