<?php

namespace src\core;

use src\models\actuality\FullActuality;
use src\models\actuality\LightActuality;

class AutoLoader
{
    public function init(): void
    {
        spl_autoload_register([__CLASS__, 'loadClasses']);
    }

    /**
     * @param string $sourceDirectory
     * @return array
     */
    private function getAllSubDir(string $sourceDirectory): array
    {
        $directories = [$sourceDirectory];
        foreach (scandir($sourceDirectory) as $fileName) {
            if (in_array($fileName, ['.', '..'])) continue;
            $path = $sourceDirectory . '/' . $fileName;
            if (!@is_dir($path)) continue;
            $directories = array_merge($directories, $this->getAllSubDir($path));
        }
        return $directories;
    }

    private function loadClasses(string $className): void
    {
        $directories = $this->getAllSubDir(__DIR__ . '/..');
        foreach ($directories as $directory) {
            $files = scandir($directory);
            foreach ($files as $file) {
                if (!@is_dir($file)) {
                    if (!str_ends_with($className . '.php', $file)) {
                        continue;
                    }
                    $file = $directory . '/' . $file;
                    if (str_contains($file, '.php')) {
                        require_once $file;
                    }
                }
            }
        }
    }
}