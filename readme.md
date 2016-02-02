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

