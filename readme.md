# Composer no update

[![Build Status](https://travis-ci.org/kisphp/composer-no-update.svg?branch=master)](https://travis-ci.org/kisphp/composer-no-update)
[![codecov.io](https://codecov.io/github/kisphp/composer-no-update/coverage.svg?branch=master)](https://codecov.io/github/kisphp/composer-no-update?branch=master)

[![Latest Stable Version](https://poser.pugx.org/kisphp/composer-no-update/v/stable)](https://packagist.org/packages/kisphp/composer-no-update)
[![Total Downloads](https://poser.pugx.org/kisphp/composer-no-update/downloads)](https://packagist.org/packages/kisphp/composer-no-update)
[![License](https://poser.pugx.org/kisphp/composer-no-update/license)](https://packagist.org/packages/kisphp/composer-no-update)
[![Monthly Downloads](https://poser.pugx.org/kisphp/composer-no-update/d/monthly)](https://packagist.org/packages/kisphp/composer-no-update)

This repository will prevent to run `composer update` without parameters. You should always run `composer update {repository}` to update only specific repositories that you use in your application.

If you know what you are doing and still want to run the update without any parameters, then you have two ways to do it:

```bash
COMPOSER_UPDATE_FORCE=1 composer update
```

or 

```bash
composer update --no-plugins

# this option will disable all composer plugin
```

