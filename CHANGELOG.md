# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.2.0] - 2021-11-16
### Added
### Changed

- Renamed `Readonly` to `IsReadonly` in order to allow BC

### Deprecated
### Removed
### Fixed
### Security

## [0.1.4] - 2021-07-31
### Fixed
- Fix issue with generic data containers accessing properties which are not specifically defined

## [0.1.3] - 2021-07-28
### Added
- Added the possibility to not only write `Readonly` properties from the constructor
- Added a check that prevents a declaring class from having two write access lines to a `Readonly` property

## [0.1.2] - 2021-07-19
### Fixed
- Fixed an issue with BetterReflection throwing an internal error when checking on properties without attributes

## [0.1.1] - 2021-07-17
### Added
- Added support for `phpstan/extension-installer` (thanks to [@simPod](https://github.com/simPod) - [#3](https://github.com/icanhazstring/phpstan-readonly-property/pull/3))
### Changed
- Updated CHANGELOG.md for easier c&p (thanks to [@simPod](https://github.com/simPod) - [#2](https://github.com/icanhazstring/phpstan-readonly-property/pull/2))

## [0.1.0] - 2021-07-14
Initial release
