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
  'islandora_context_condition_collection_member' => array(
    'values' => array(
      0 => TRUE,
    ),
    'options' => array(
      'islandora_collection_membership' => array(
        'ems:root' => 'ems:root',
      ),
    ),
  ),
);
$context->reactions = array(
  'js_module' => array(
    'sites/all/modules/ems' => array(
      'sites/all/modules/ems/js/ems.js' => 'sites/all/modules/ems/js/ems.js',
    ),
  ),
);
$context->condition_mode = 0;
```
