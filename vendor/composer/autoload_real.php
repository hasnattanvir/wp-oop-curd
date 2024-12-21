<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit540ba7cd54f696a63d4448e10d25daa0
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit540ba7cd54f696a63d4448e10d25daa0', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit540ba7cd54f696a63d4448e10d25daa0', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit540ba7cd54f696a63d4448e10d25daa0::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
