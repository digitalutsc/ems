# ems - Early Modern Songscapes

An Islandora module to help facilitate the loading of the music viewer to be used on a site presenting work from the [Early Modern Songscapes Project](http://digitalscholarship.utsc.utoronto.ca/content/early-modern-songscapes-project)

## Requirements

This module requires the following modules/libraries:

* [Context](https://www.drupal.org/project/context)
* [Context Add Assets](https://www.drupal.org/project/context_addassets)
* [Islandora Context](https://github.com/mjordan/islandora_context)

## Installation
Install the module dependencies and then enable the module.

## Configuration
Please import the following context.
### Context
```
$context = new stdClass();
$context->disabled = FALSE; /* Edit this to true to make a default context disabled initially */
$context->api_version = 3;
$context->name = 'ems';
$context->description = '';
$context->tag = '';
$context->conditions = array(
  'islandora_context_condition_content_models' => array(
    'values' => array(
      0 => TRUE,
    ),
    'options' => array(
      'islandora_cmodels' => array(
        'islandora:sp_simple_xml' => 'islandora:sp_simple_xml',
      ),
    ),
  ),
);
$context->reactions = array(
  'js_module' => array(
    'sites/all/modules/ems' => array(
      'sites/all/modules/ems/js/ems.js' => 'sites/all/modules/ems/js/ems.js',
      'sites/all/modules/ems/lib/verovio-toolkit.js' => 'sites/all/modules/ems/lib/verovio-toolkit.js',
    ),
  ),
);
$context->condition_mode = 0;

```
## Maintainers/Sponsors
Software leads:


Sponsors:


## License

[GNU General Public License, version 3](http://www.gnu.org/licenses/gpl-3.0.txt) or later.
