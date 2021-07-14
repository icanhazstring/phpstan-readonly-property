# Contributing guidelines

Please note we have a code of conduct, please follow it in all your interactions with the project.

## Pull Request Process

1. Ensure any install or build dependencies are removed before the end of the layer when doing a
   build.
2. Update the `README.md` and `CHANGELOG.md` with details of changes to the interface, this includes new environment
   variables, exposed ports, useful file locations and container parameters.
3. Increase the version numbers in any examples files and the `CHANGELOG.md` to the new version that this
   Pull Request would represent. The versioning scheme we use is [SemVer](http://semver.org/).
4. You may merge the Pull Request in once you have the sign-off of two other developers, or if you
   do not have permission to do that, you may request the second reviewer to merge it for you.

## Code quality

1. Write clean code. Follow the rules set forward by the existing implementation, e.g.
    * Declare strict types
    * PSR-4 compliance of class and file names, namespaces and directory structures
    * No weak (non-typesafe or implicit) comparisons
    * No codesniffer issues
    * No PhpStorm warnings
    * Define and use exceptions specific to your library so that external users of your
      library are free how to deal with them (e.g. catch or convert)
        * define and use interfaces for your exceptions
        * let your exceptions extend specific exceptions if possible,
          e.g. `RuntimeException` rather than `Exception`
    * Support and use dependency injection (DI) wherever possible, especially in
      constructors
2. All unit tests must be 100% green. No notices, warnings or skips allowed.
3. Tests must not have external dependencies such as a real database connection.
   Use, extend or amend the existing mocks and stubs.
4. Maintain the [changelog](CHANGELOG.md).

## Code of Conduct

### Our Pledge

In the interest of fostering an open and welcoming environment, we as
contributors and maintainers pledge to making participation in our project and
our community a harassment-free experience for everyone, regardless of age, body
size, disability, ethnicity, gender identity and expression, level of experience,
nationality, personal appearance, race, religion, or sexual identity and
orientation.

### Our Standards

Examples of behavior that contributes to creating a positive environment
include:

* Using welcoming and inclusive language
* Being respectful of differing viewpoints and experiences
* Gracefully accepting constructive criticism
* Focusing on what is best for the community
* Showing empathy towards other community members

Examples of unacceptable behavior by participants include:

* The use of sexualized language or imagery and unwelcome sexual attention or
  advances
* Trolling, insulting/derogatory comments, and personal or political attacks
* Public or private harassment
* Publishing others' private information, such as a physical or electronic
  address, without explicit permission
* Other conduct which could reasonably be considered inappropriate in a
  professional setting
