OnceitRaygunBundle
==================

This bundle integrates the [raygun4php](https://github.com/MindscapeHQ/raygun4php) library into Symfony2.

Install it through composer.

Enable it in AppKernel.

In order to get it working you must pass your API key. Otherwise errors will simply
be ignored. This is useful for development environments.

You can also define tags.

Wishlist:

- [ ] Add logging capabilities to perform a 'an error message would be sent at this point' or 'an error message was sent at this point'

- [ ] Allow configuration about what kind of exceptions should be thrown

- [ ] Allow customization of a callable that should be _called_ to get the set up on Raygun's client information
