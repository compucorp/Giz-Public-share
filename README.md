# GIZ Repository for all GIZ sites

This is Compucorp's base Drupal 7 distribution, built with the [compuclient](https://github.com/compucorp/compuclient) installation profile.

## How can I use this repository?

- As a template for new repositories for GIZ clients

## How is this repository updated?

- This repository will be updated along with Compuclient release based on Compuclient request. The apply then shall apply to all GIZ sites. 

## Why I am see other sites upgrader in the module

Historically, all GIZ sites have its own repository (SPAPATPA, INSU, ITP), since we migrate them to use the same repository. The upgrader must be exist before it gets uninstalled from database properly and enable a new upgrader. 

When setting up the new site giz_updates module must be enabled. 
