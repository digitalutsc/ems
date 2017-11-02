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
        'islandora:audio_collection' => 0,
        'islandora:sp_basic_image_collection' => 0,
        'islandora:bookCollection' => 0,
        'ir:citationCollection' => 0,
        'islandora:compound_collection' => 0,
        'islandora:sp_disk_image_collection' => 0,
        'ems:song1' => 0,
        'islandora:entity_collection' => 0,
        'islandora:sp_large_image_collection' => 0,
        'islandora:newspaper_collection' => 0,
        'islandora:oralhistories_collection' => 0,
        'islandora:sp_pdf_collection' => 0,
        'islandora:sp_simple_xml_collection' => 0,
        'islandora:video_collection' => 0,
        'islandora:sp_web_archive_collection' => 0,
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
