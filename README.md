# Gtstudio Hyva Theme Variables

## Description

This module allows you to control Hyva variables by the admin 

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

- Unzip the zip file in `app/code/Gtstudio`
- Enable the module by running `php bin/magento module:enable Gtstudio_HyvaThemeVariables`
- Apply database updates by running `php bin/magento setup:upgrade`\*
- Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

- Install the module composer by running `composer require Gtstudio/module-theme-variables`
- enable the module by running `php bin/magento module:enable Gtstudio_HyvaThemeVariables`
- apply database updates by running `php bin/magento setup:upgrade`\*
- Flush the cache by running `php bin/magento cache:flush`

- For information about a module installation in Magento 2, see [Enable or disable modules](https://devdocs.magento.com/guides/v2.4/install-gde/install/cli/install-cli-subcommands-enable.html).

## Usage

### Adding new variables

You can add your variables in Content > Design > Configuration then select your theme and add the variables in "Variables" Section.

After this step you need to clear magento cache.

In your less files you can use escape for css3 variables support.

Eg : `color: ~"var(--color-primary)"`

## Extensibility

Extension developers can interact with this module. For more information about the Magento extension mechanism, see [Magento plug-ins](https://devdocs.magento.com/guides/v2.4/extension-dev-guide/plugins.html).

[The Magento dependency injection mechanism](https://devdocs.magento.com/guides/v2.4/extension-dev-guide/depend-inj.html) enables you to override the functionality of the module.

### UI components

You can extend product and category updates using the UI components located in the `view/adminhtml/ui_component` directory.

For information about a UI component in Magento 2, see [Overview of UI components](https://devdocs.magento.com/guides/v2.4/ui_comp_guide/bk-ui_comps.html).

## Compatibility

This module requires PHP 8 or higher.

## Additional information

For information about significant changes in patch releases, see [Release information](https://devdocs.magento.com/guides/v2.4/release-notes/bk-release-notes.html).
