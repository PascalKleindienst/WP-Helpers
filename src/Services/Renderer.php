<?php

namespace GeistPress\Helpers\Services;

class Renderer
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $parent;

    /**
     * @var string
     */
    public $extension = '.phtml';

    /**
     * Set paths
     *
     * @param string $path
     * @param string|null $parent - path to parent theme
     */
    public function init($path, $parent = null)
    {
        $this->path = $path;
        $this->parent = $parent;
    }

    /**
     * Render a view file
     *
     * @param string $file
     * @param array $data
     * @throws \InvalidArgumentException if file is not found
     * @return boolean
     */
    public function render($file, array $data=[])
    {
        extract($data);
        
        $file = $this->path . $file . $this->extension;

        if (file_exists($file)) {
            return include($file);
        }

        throw new \InvalidArgumentException("File $file does not exist");
    }

    /**
     * Include a parent template
     *
     * @param string $name
     * @return boolean
     */
    public function parent_template($name)
    {
        $template = $this->parent . $name . '.php';
    
        if (file_exists($template)) {
            return include($template);
        }
    }
}
