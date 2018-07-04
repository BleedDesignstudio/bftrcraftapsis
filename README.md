# Bftr Craft Apsis plugin for Craft CMS 3.x

A work in progress plugin that implements the Apsis API into Craft 3.

## Installation

```bash
$ composer require bleed/bftrcraftapsis
```

Make sure to enter a valid Apsis API key under the plugin settings in the Craft admin panel.

## Examples

### Add subscriber to mailing list

```twig
{% set subscriber = {
	'Name': 'Gilles Deleuze',
	'Email': 'gilles@deleuze.fr'
} %}

{# first param is the mailing list ID #}
{# second param is subscriber object #}
{# third param decides whether or not to update info if the subscriber already exists #}
{{ apsisAddSubscriber('2710122', subscriber, false) }}
```