<?php

$header = <<<'EOF'
This file is part of KISPHP - Composer no update.
(c) Bogdan Rizac <<kisphp@users.noreply.github.com>
This source file is subject to the MIT license that is bundled
with this source code in the file LICENSE.
EOF;

$finder = PhpCsFixer\Finder::create()
    ->exclude('tests/Fixtures')
    ->in(__DIR__)
    ->append([
        __DIR__.'/dev-tools/doc.php',
        __DIR__.'/php-cs-fixer',
    ])
;

$config = new PhpCsFixer\Config();
$config
    ->setRiskyAllowed(true)
    ->setUsingcache(false)
    ->setRules([
        '@PHP56Migration' => false,
        '@PHPUnit75Migration:risky' => false,
        '@PhpCsFixer' => true,
        '@PhpCsFixer:risky' => false,
        'general_phpdoc_annotation_remove' => ['annotations' => ['expectedDeprecation']],
        'header_comment' => ['header' => $header],
        'list_syntax' => ['syntax' => 'long'],
        'concat_space' => [
            'spacing' => 'one',
        ],
        'php_unit_internal_class' => false,
        'phpdoc_no_empty_return' => true,
        'phpdoc_add_missing_param_annotation' => true,
        'no_whitespace_in_blank_line' => true,
        'no_superfluous_phpdoc_tags' => false,
        'general_phpdoc_annotation_remove' => true,
        'php_unit_mock' => true,
        'phpdoc_trim' => false,
        'phpdoc_summary' => false,
        'phpdoc_align' => false,
        'phpdoc_types_order' => [
            'null_adjustment' => 'always_last',
        ],
        'header_comment' => false,
        'yoda_style' => false,
    ])
    ->setFinder($finder)
;

// special handling of fabbot.io service if it's using too old PHP CS Fixer version
if (false !== getenv('FABBOT_IO')) {
    try {
        PhpCsFixer\FixerFactory::create()
            ->registerBuiltInFixers()
            ->registerCustomFixers($config->getCustomFixers())
            ->useRuleSet(new PhpCsFixer\RuleSet($config->getRules()));
    } catch (PhpCsFixer\ConfigurationException\InvalidConfigurationException $e) {
        $config->setRules([]);
    } catch (UnexpectedValueException $e) {
        $config->setRules([]);
    } catch (InvalidArgumentException $e) {
        $config->setRules([]);
    }
}

return $config;
