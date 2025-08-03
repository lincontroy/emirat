// .php-cs-fixer.dist.php
<?php

return PhpCsFixer\Config::create()
    ->setRules(['@PSR12' => true])
    ->setFinder(
        PhpCsFixer\Finder::create()->in(__DIR__)
    );
