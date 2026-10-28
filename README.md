# CookieChimp for Omeka S

Integrates the CookieChimp consent management widget into public Omeka S site pages.

Maintained by Temple University Libraries.

## Requirements

- Omeka S 4.x
- A CookieChimp widget authorized for the site's hostname
- PHP and Laminas components provided by Omeka S

The module declares an Omeka S version constraint of `^4.0.0`.

## Installation

Clone the repository into the Omeka S modules directory:

    git clone https://github.com/tulibraries/omeka-s-cookiechimp.git modules/CookieChimp

Alternatively, register it as a Git submodule:

    git submodule add -b main \
      git@github.com:tulibraries/omeka-s-cookiechimp.git \
      modules/CookieChimp

Enable the CookieChimp module through the Omeka S administrative interface.

## Configuration

The module currently uses the Temple University Libraries CookieChimp widget:

    https://cookiechimp.com/widget/a2ZtgNB.js

The widget URL is defined in `Module.php`.

The module does not currently provide an administrative configuration interface or environment-variable override.

CookieChimp domain authorization and consent settings are managed outside Omeka S.

## How It Works

The module registers a listener for the Omeka S `view.layout` event.

For public site requests, the listener adds the CookieChimp widget to the view's `headScript()` helper using `prependFile()`.

The module does not inject CookieChimp into administrative requests.

The Exhibits integration investigation confirmed that all seven inspected public themes trigger `view.layout` before rendering `headScript()`.

## Script Loading and Consent

The module prepends CookieChimp to scripts already registered with `headScript()` when its listener executes.

This does not guarantee that CookieChimp executes before scripts subsequently prepended by other event listeners or scripts inserted directly into theme templates.

The module does not independently block Google Analytics or other tracking technologies. CookieChimp consent enforcement must be verified against the site's actual tracking configuration.

## Validation

After installation and activation:

1. Open a public site page on an authorized hostname.
2. Confirm that the CookieChimp widget script appears in the document head.
3. Confirm that the consent banner renders as expected.
4. Test consent acceptance, rejection, and preference reopening.
5. Inspect browser network requests and cookies before and after consent.
6. Verify that nonessential tracking respects the configured consent requirements.
7. Test active themes and keyboard accessibility.

The banner appearing does not, by itself, establish consent compliance.

## Development

The module currently consists of:

    CookieChimp/
    ├── Module.php
    ├── README.md
    └── config/
        └── module.ini

Validate PHP syntax with:

    php -l Module.php

## Status

Initial implementation. PHP syntax validation has passed.

Runtime activation, QA deployment, script ordering, and consent enforcement have not yet been verified.

## License

This project is licensed under the MIT License. See [LICENSE](LICENSE).
