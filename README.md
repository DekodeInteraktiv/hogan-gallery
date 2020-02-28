# Image Gallery Module for [Hogan](https://github.com/dekodeinteraktiv/hogan-core) [![Build Status](https://travis-ci.org/DekodeInteraktiv/hogan-gallery.svg?branch=master)](https://travis-ci.org/DekodeInteraktiv/hogan-gallery)

## Installation
Install the module using Composer `composer require dekodeinteraktiv/hogan-gallery` or simply by downloading this repository and placing it in `wp-content/plugins`

## Available filters
- `hogan/module/gallery/layout/grid/thumbnail_size` for overriding default thumbnail image size for grid layout, default 'thumbnail'.
- `hogan/module/gallery/layout/grid/show_more_link` Show "+ X images" link if more than 6 images in grid layout. Default `true`
- `hogan/module/gallery/layout/slider/show_expand_icon` Show icon to open expand the icon. If false you can click on the image instead. Default `true`.
- `hogan/module/gallery/layout/thumbnail_size` for overriding default thumbnail image size for other layouts than grid, default 'large'.
- `hogan/module/gallery/template` for overriding the default template file.
- `hogan/module/gallery/wrapper_tag` for outer HTML wrapper tag, default `<section>`
- `hogan/module/gallery/wrapper_classes` for outer HTML wrapper CSS classes.
- `hogan/module/gallery/inner_wrapper_classes` for inner HTML `<div>` wrapper classes.
- `hogan/module/gallery/heading/enabled` for enabling heading field, default true.
- `hogan/module/gallery/slider/flickity` flickity options. See https://flickity.metafizzy.co/options.html
- `hogan/module/gallery/item` for overriding the post values for the gallery item.
- `hogan/module/gallery/caption/allowed_html` for allowing html tags in captions.
