## Overview

This is an installation profile to setup a basic CiviCRM site for Compucorp. It contains the default dependencies for a new site. It also configures CiviCRM as part of the installation process.

## Requirements

- PHP 7.4 (recommended), Or PHP 7.3.
- Drush 8. Old versions of Drush might be incompatible with PHP 7.x, so please make sure of using the latest Drush 8.x available.

## Usage

#### Site Installation

To create a site using this profile use [compudeploy](https://bitbucket.org/compucorp/compudeploy).

#### For Existing Sites

Compuclient cannot be used on existing sites. For them, it's recommended to use an upgrader module instead. Check [this](https://compucorp.atlassian.net/wiki/spaces/PCHR/pages/676823043/Add+a+Drupal+Upgrader) for instructions on how to create this module.

#### Adding Upgraders

Check [the best practices documentation](https://compucorp.atlassian.net/wiki/spaces/PCHR/pages/676823043/Add+a+Drupal+Upgrader) for instructions on adding an upgrader
