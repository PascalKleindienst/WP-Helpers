# WP-Helpers
[![Travis](https://img.shields.io/travis/PascalKleindienst/WP-Helpers.svg?style=flat-square)](https://travis-ci.org/PascalKleindienst/WP-Helpers)
[![StyleCI](https://styleci.io/repos/75538120/shield?branch=master)](https://styleci.io/repos/75538120)
[![Code Climate](https://img.shields.io/codeclimate/github/PascalKleindienst/WP-Helpers.svg?style=flat-square)](https://codeclimate.com/github/PascalKleindienst/WP-Helpers)

## Installation
```bash
$ composer require geistpress/wp-helpers
```
## Usage
Init the Load and View Helper and register Sidebars
```php
// Init WP-Helpers
add_action('init', function () {
    // Init Loader
    $loader = new \GeistPress\Helpers\Foundation\Loader();

    // Register all class in sidebars directory with the App\Sidebars namespace
    $loader->register(__DIR__ . '/resources/sidebars', 'App\Sidebars'); 

    // Register only the Bar class and return its instance
    $foobar = $loader->register(\Foo\Bar::class); 

    // Init Views
    \GeistPress\Helpers\Facades\View::init(__DIR__ . '/resources/views/');
});
```

### Registerable
To register a class with the loader the class needs to implement the `Registerable` interface and contain a `register` method
```php
namespace App\Sidebars;

use GeistPress\Helpers\Foundation\Registerable;

class HeaderBar implements Registerable
{
    /**
     * Register sidebar
     */
    public function register()
    {
        register_sidebar([
            'name'          => __('Header Bar', 'app'),
            'id'            => 'header-bar',
            'description'   => __('Top Bar above the navbar', 'app'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
        ]);
    }
}
```

### Views
```php

// Render /resources/views/breadcrumbs.phtml and pass the variable $current='home' to it
\GeistPress\Helpers\Facades\View::render('breadcrumbs', ['current' => 'home']);
```