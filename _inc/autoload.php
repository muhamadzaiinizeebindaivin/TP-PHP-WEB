<?php
spl_autoload_register(function ($class) {
    error_log("Autoloader called for class: " . $class);
    
    $baseDir = __DIR__ . '/../';
    $classFile = $baseDir . str_replace('\\', '/', $class) . '.php';
    
    error_log("Looking for file: " . $classFile);
    
    if (file_exists($classFile)) {
        error_log("File found: " . $classFile);
        require $classFile;
        return true;
    }
    
    error_log("File NOT found: " . $classFile);
    return false;
});
