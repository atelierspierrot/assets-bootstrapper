assets-bootstrapper
===================

This package is a facility to use [Bootstrap](http://getbootstrap.com/) and
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

- `jquery-cdn` to use the hosted version of jQuery by [googleapis.com](http://googleapis.com/)
- `bootstrap` to embed the distributed version of the Bootstrap library ; note that the default version DOES NOT include the Glyphicons
- `bootstrap-theme` to embed the distributed version of the Bootstrap's theme
- `font-awesome` to embed the distributed version of the Font Awesome font icons


## Third-parties

This package embeds:

- [Bootstrap](http://getbootstrap.com/), released under the [MIT license](http://en.wikipedia.org/wiki/MIT_License) and copyright Twitter.
- [Font Awesome](http://fortawesome.github.io/Font-Awesome/), released under the [SIL OFL 1.1 license](http://scripts.sil.org/OFL) and copyright Dave Gandy.

See the CHANGELOG of the package for versions of the third-parties embedded with each release.
