# Image Gallery Module for [Hogan](https://github.com/dekodeinteraktiv/hogan-core) [![Build Status](https://travis-ci.org/DekodeInteraktiv/hogan-gallery.svg?branch=master)](https://travis-ci.org/DekodeInteraktiv/hogan-gallery)

## Installation
Install the module using Composer `composer require dekodeinteraktiv/hogan-gallery` or simply by downloading this repository and placing it in `wp-content/plugins`

## Available filters
- `hogan/module/gallery/image_size` for overriding default thumbnail image size, default 'thumbnail'.
- `hogan/module/gallery/template` for overriding the default template file.
- `hogan/module/gallery/wrapper_tag` for outer HTML wrapper tag, default `<section>`
- `hogan/module/gallery/wrapper_classes` for outer HTML wrapper CSS classes.
- `hogan/module/gallery/inner_wrapper_classes` for inner HTML `<div>` wrapper classes.
- `hogan/module/gallery/heading/enabled` for enabling heading field, default true.
- `hogan/module/gallery/slider/flickity` flickity options. See https://flickity.metafizzy.co/options.html

## Changelog
### 1.0.4
- Heading classname changed from `.heading` to `.hogan-heading`. (#5)
- Template markup changed from `ul > li` to `div` (#7)
- Added schema to markup (#7)
