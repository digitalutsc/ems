# ems - Early Modern Songscapes

## Context
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
