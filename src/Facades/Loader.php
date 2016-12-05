<?php
namespace GeistPress\Helpers\Facades;

use Mrubiosan\Facade\FacadeLoader;
use Mrubiosan\Facade\ServiceLocatorAdapter\CallableAdapter;

class Loader
{
    /**
     * @var array
     */
    public $loaded = [];

    /**
     * @var array
     */
    private $facades = [];

    /**
     * Init FacadeLoader
     */
    public function __construct()
    {
        // Facades
        $this->facades = [
            'view' => function ($loader) {
                if (!array_key_exists('view', $loader->loaded)) {
                    $loader->loaded['view'] = new \GeistPress\Helpers\Services\Renderer();
                }

                return $loader->loaded['view'];
            }
        ];

        // Locator+Loader
        $locator = new CallableAdapter(function ($name) {
            return $this->load($name);
        });

        FacadeLoader::init($locator);
    }

    /**
     * Load a facade
     *
     * @param string $name
     * @return mixed
     */
    private function load($name)
    {
        // Facade does not exist
        if (!array_key_exists($name, $this->facades)) {
            throw new \InvalidArgumentException("No facade with name $name found");
        }

        // load facade
        $class = $this->facades[$name];

        if (is_callable($class)) {
            return $class($this);
        }

        if (class_exists($class)) {
            return new $class();
        }

        // neither callable nor class
        throw new \InvalidArgumentException("Facade $name could not be instanciated");
    }
}
