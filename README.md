assets-bootstrapper
===================

This package is a facility to use [jQuery](http://jquery.com/), [Bootstrap](http://getbootstrap.com/) and
[Font Awesome](http://fortawesome.github.io/Font-Awesome/) with the
[Assets Manager](http://github.com/atelierspierrot/assets-manager) plugin
for [Composer](http://getcomposer.org/).


## Usage

To include this package in your project, just add the following line in your `composer.json`:

    "require": {
        ...
        "atelierspierrot/assets-bootstrapper": "1.*"
    }

For more infos about "how to use" the libraries, please see:

-   the [Assets Manager Composer plugin](https://github.com/atelierspierrot/assets-manager)
-   the [Template Engine documentation](https://github.com/atelierspierrot/templatengine)

This package defines the following "presets":

- `jquery` to embed the distributed version of the jQuery library
- `jquery-cdn` to use the hosted version of jQuery by [googleapis.com](http://googleapis.com/)
- `bootstrap` to embed the distributed version of the Bootstrap library ; note that the default version DOES NOT include the Glyphicons
- `bootstrap-glyphicons` to embed the distributed version of the Bootstrap library INCLUDING the Glyphicons
- `bootstrap-theme` to embed the distributed version of the Bootstrap's theme
- `bootstrap-cdn` to use the hosted version of Bootstrap by [bootstrapcdn.com](http://netdna.bootstrapcdn.com/)
- `font-awesome` to embed the distributed version of the Font Awesome font icons
- `font-awesome-cdn` to use the hosted version of the Font Awesome font icons by [bootstrapcdn.com](http://netdna.bootstrapcdn.com/)


## Third-parties

This package embeds:

- [jQuery](http://jquery.com/), released under the [MIT license](http://en.wikipedia.org/wiki/MIT_License) and copyright jQuery Foundation, Inc.
- [Bootstrap](http://getbootstrap.com/), released under the [MIT license](http://en.wikipedia.org/wiki/MIT_License) and copyright Twitter.
- [Font Awesome](http://fortawesome.github.io/Font-Awesome/), released under the [SIL OFL 1.1 license](http://scripts.sil.org/OFL) and copyright Dave Gandy.

See the CHANGELOG of the package for versions of the third-parties embedded with each release.
