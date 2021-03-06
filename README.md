# Magento 2 Composer Installer

[![Build Status](https://travis-ci.org/AddictedToMagento/magento2-composer-installer.svg?branch=master)](https://travis-ci.org/AddictedToMagento/magento2-composer-installer)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/AddictedToMagento/magento2-composer-installer/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/AddictedToMagento/magento2-composer-installer/?branch=develop)

## Usage

In `composer.json` of the component specify:
- `type` - type of Magento 2 component
- `extra/map` - list of files to move and their location relative to the path they will be located in the application

## Supported Components

### Magento Module

Type: `magento2-module`

Installation location: `app/code`

Example:
```json
{
    "name": "magento/module-core",
    "description": "N/A",
    "require": {
        ...
    },
    "type": "magento2-module",
    "extra": {
        "map": [
            [
                "*",
                "Magento/Core"
            ]
        ]
    }
}
```

Final location will be `<root>/app/code/Magento/Core`

### Magento Theme

Type: `magento2-theme`

Installation location: `app/design`

Example:
```json
{
    "name": "magento/theme-frontend-plushe",
    "description": "N/A",
    "require": {
        ...
    },
    "type": "magento2-theme",
    "extra": {
        "map": [
            [
                "*",
                "frontend/Magento/plushe"
            ]
        ]
    }
}
```

Final location will be `<root>/app/design/frontend/Magento/plushe`

### Magento Language Package

Type: `magento2-language`

Installation location: `app/i18n`

Example:
```json
{
    "name": "magento/language-de_de",
    "description": "German (Germany) language",
    "require": {
        ...
    },
    "type": "magento2-language",
    "extra": {
        "map": [
            [
                "*",
                "Magento/de_DE"
            ]
        ]
    }
}
```

Final location will be `<root>/app/i18n/Magento/de_DE`

### Magento Library

Support for libraries located in `lib/internal` instead of `vendor` directory.

Installation location: `lib/internal`

Type: `magento2-library`

Example:
```json
{
    "name": "magento/framework",
    "description": "N/A",
    "require": {
       ...
    },
    "type": "magento2-library",
    "extra": {
        "map": [
            [
                "*",
                "Magento/Framework"
            ]
        ]
    }
}
```

Final location will be `<root>/lib/internal/Magento/Framework`

### Magento Component

Default type, if none is specified.

Installation location: `.` (root directory of the code base)

Type: `magento2-component`

Example:
```json
{
    "name": "magento/migration-tool",
    "description": "N/A",
    "require": {
        ...
    },
    "type": "magento2-component",
    "extra": {
        "map": [
            [
                "*",
                "tools/Magento/Migration"
            ]
        ]
    }
}
```

Final location will be `<root>/tools/Magento/Migration`