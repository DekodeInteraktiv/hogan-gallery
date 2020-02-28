# Changelog

## 1.3.7
- Added filter to allow html tags in captions (`hogan/module/gallery/caption/allowed_html`)

## 1.3.6
- Added filter to override the post values for the gallery item (`hogan/module/gallery/item`)
- Use innerHTML instead of textContent to fetch the content of figcaption. This way html `<br>` can be used to create line breaks.
- PR [#34](https://github.com/DekodeInteraktiv/hogan-gallery/pull/34)

## 1.3.5
- Fixed problem with lots of space under galleries: [https://prosjekt.dekode.no/desk/#/tickets/3444695](https://prosjekt.dekode.no/desk/#/tickets/3444695)

## 1.3.4
- Fixed offset vertical margins for grid layout  [#22](https://github.com/DekodeInteraktiv/hogan-gallery/pull/22)

## 1.3.3
- Added filter to hide expand icon and more images link [#21](https://github.com/DekodeInteraktiv/hogan-gallery/pull/21)

## 1.3.2
- Translations and dependency updates.

## 1.3.1
- Added filters for thumbnail image size [#19](https://github.com/DekodeInteraktiv/hogan-gallery/pull/19)

## 1.3.0
- Added "Masonry" layout [#15](https://github.com/DekodeInteraktiv/hogan-gallery/pull/15)

## 1.2.3
- Add screen reader text to PhotoSwipe buttons [#12](https://github.com/DekodeInteraktiv/hogan-gallery/pull/12)
- Update `hogan-scripts` dependency [#13](https://github.com/DekodeInteraktiv/hogan-gallery/pull/12)

## 1.2.2
- Update module to new registration method introduced in [Hogan Core 1.1.7](https://github.com/DekodeInteraktiv/hogan-core/releases/tag/1.1.7)
- Set hogan-core dependency `"dekodeinteraktiv/hogan-core": ">=1.1.7"`
- Add Dekode Coding Standards.

## 1.2.1
- Add support for Photoswipe animation.
- Enable animation by default.

## 1.2.0
### Breaking Changes
- Remove heading field, provided from Core in [#53](https://github.com/DekodeInteraktiv/hogan-core/pull/53)
- Heading field has to be added using filter (was default on before).

## 1.0.4
- Heading classname changed from `.heading` to `.hogan-heading`. (#5)
- Template markup changed from `ul > li` to `div` (#7)
- Added schema to markup (#7)
