<?php
namespace GeistPress\Helpers\Foundation;

use GeistPress\Helpers\Facades\Loader as FacadeLoader;

class Loader
{
    /**
     * @var \GeistPress\Helpers\Facades\Loader
     */
    protected $facadeLoader;

    /**
     * Init Facade Loader
     */
    public function __construct()
    {
        $this->facadeLoader = new FacadeLoader();
    }

    /**
     * Register all registerable classes of a directory
     *
     * @param string $path
     * @param string|null $namespace Root namespace of $path
     * @throws \InvalidArgumentException if $path is not a valid directory
     */
    public function register($path, $namespace = null)
    {
        if (!file_exists($path) || !is_dir($path)) {
            throw new \InvalidArgumentException("$path is not a valid directory");
        }
        
        // load classes from $path
        spl_autoload_register(function ($class) use ($path, $namespace) {
            include $path . DIRECTORY_SEPARATOR . str_replace($namespace, '', $class) . '.php';
        });

        // init all classes and call their register method
        foreach (glob($path . '/*.php') as $file) {
            $class = basename($file, '.php');
            $class = is_null($namespace) ? $class : "$namespace\\$class";
            
            if (class_exists($class)) {
                $obj = new $class();
                    
                if ($obj instanceof Registerable) {
                    $obj->register();
                }
            }
        }
    }
}
