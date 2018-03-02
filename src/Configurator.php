<?php
namespace Coderatio\Laranotify;

class Configurator
{
    /**
     * This will load all styles files
     * @param boolean $allow_foundations
     */
    public function getHeader($allow_foundations = false)
    {
        if ($allow_foundations == true) {
            include __DIR__.'/config/foundations/foundationCssLoader.php';
        }
        include __DIR__ . '/config/cssLoader.php';
    }

    /**
     * This will load all js files and boot package
     * This must be placed after Bootstrap and jQuery js files.
     * @param boolean $allow_foundations
     */
    public function getFooter($allow_foundations = false)
    {
        if ($allow_foundations == true) {
            include __DIR__.'/config/foundations/foundationJsLoader.php';
        }
        include __DIR__ . '/config/jsLoader.php';
    }

}