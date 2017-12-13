<?php

module_load_include('inc', 'islandora', 'includes/solution_packs');

function getTEIDatastream() {
  $obj_pid = isset($_GET['pid']) ? $_GET['pid'] : '';

  if ($obj_pid != null) {
    $connection = islandora_get_tuque_connection();
    $repository = $connection->repository;
    $object = $repository->getObject($obj_pid);
    $XMLOBJ = $object->getDatastream("OBJ");
    $content = (string) $XMLOBJ->content;
  } else {
    $content = "TEI not found";
  }

  drupal_json_output($content);
  drupal_exit();
}

