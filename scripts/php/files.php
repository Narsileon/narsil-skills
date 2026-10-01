<?php

declare(strict_types=1);

/**
 * @param string $path
 *
 * @return bool
 */
function narsilSkillsIsExcludedPhpPath(string $path): bool
{
    $segments = explode('/', trim(str_replace('\\', '/', $path), '/'));
    $excluded = array_intersect($segments, ['.ddev', '.git', 'node_modules', 'storage', 'vendor']) !== [];

    for ($index = 0; !$excluded && $index < count($segments) - 1; $index++)
    {
        if (
            ($segments[$index] === 'bootstrap' && $segments[$index + 1] === 'cache') ||
            ($segments[$index] === 'public' && $segments[$index + 1] === 'build')
        ) {
            $excluded = true;
        }
    }

    return $excluded;
}

/**
 * @param array<int,string> $paths
 *
 * @return array<int,string>
 */
function narsilSkillsGetPhpFiles(array $paths): array
{
    $files = [];

    foreach ($paths as $path)
    {
        if (is_file($path))
        {
            $realPath = realpath($path) ?: $path;

            if (
                pathinfo($realPath, PATHINFO_EXTENSION) === 'php' &&
                !str_ends_with($realPath, '.blade.php') &&
                !narsilSkillsIsExcludedPhpPath($realPath)
            ) {
                $files[] = $path;
            }

            continue;
        }

        if (!is_dir($path))
        {
            continue;
        }

        $directoryIterator = new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS);
        $filteredIterator = new RecursiveCallbackFilterIterator($directoryIterator, static function (SplFileInfo $file): bool
        {
            return !$file->isDir() || !narsilSkillsIsExcludedPhpPath($file->getPathname());
        });
        $iterator = new RecursiveIteratorIterator($filteredIterator);

        foreach ($iterator as $file)
        {
            $realPath = realpath($file->getPathname()) ?: $file->getPathname();

            if (
                $file->isFile() &&
                $file->getExtension() === 'php' &&
                !str_ends_with($realPath, '.blade.php') &&
                !narsilSkillsIsExcludedPhpPath($realPath)
            ) {
                $files[] = $file->getPathname();
            }
        }
    }

    return array_values(array_unique($files));
}
