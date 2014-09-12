GruntHashAssetsBundle
=====================

The [grunt-hash](https://www.npmjs.org/package/grunt-hash) [grunt](http://www.gruntjs.com/) plugin allows you to rename files according to their content.

For example a file named `main.css` will be renamed to `main.54e79f6f.css`.

So the file is not easy to include in a Twig template (its name will change at every content change).

This plugin adds a twig function called `grunt_asset`.


Usage
-----

You can call it like this :

```twig
<link rel="stylesheet" href="{{ grunt_asset('css/main.css') }}" />
```

It will look for files called `main*.css` in the `web/assets/css` directory and serve it as `/assets/main.54e79f6f.css`.

If no file is found or more than one file is found an exception will be thrown.

Configuration
-------------

Here is the default plugin configuration :

```yam
grunt_hash_assets:
    assets_dir: %kernel.root_dir%/../web/assets/
    assets_base_path: /assets
```
