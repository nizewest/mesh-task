<?php

/**
 * Config for PHP-CS-Fixer ver2
 */

$rules = [
    '@PSR2' => true,
];

$excludes = [
    // add exclude project directory

    'vendor',
    'node_modules',
];

return PhpCsFixer\Config::create()
    ->setRules($rules)
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->exclude($excludes)
            ->notName('README.md')
            ->notName('*.xml')
            ->notName('*.yml')
    );
