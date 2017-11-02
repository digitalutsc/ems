<?php

module_load_include('inc', 'islandora', 'includes/solution_packs');

function getTEIDatastream() {
  $song_collection_pid = isset($_GET['tei_pid']) ? $_GET['tei_pid'] : '';

  $tei_pid = getTEIPID($song_collection_pid);
  if ($tei_pid != null) {
    $connection = islandora_get_tuque_connection();
    $repository = $connection->repository;
    $object = $repository->getObject($tei_pid);
    $XMLOBJ = $object->getDatastream("OBJ");
    $content = (string) $XMLOBJ->content;
  } else {
    $content = "TEI not found";
  }

  drupal_json_output($content);
  drupal_exit();
}


function getTEIPID($song_collection_pid) {
  $url = parse_url(variable_get('islandora_solr_url', 'localhost:8080/solr'));

  $query = 'RELS_EXT_isMemberOfCollection_uri_s:"info:fedora/' . $song_collection_pid . '" AND RELS_EXT_hasModel_uri_s:"info:fedora/islandora:sp_simple_xml"';
  $fields = array('PID');

  $params = array(
    'fl' => $fields,
    'qt' => 'standard',
  );

  try {
    $solr = new Apache_Solr_Service($url['host'], $url['port'], $url['path'] . '/');
    $solr->setCreateDocuments(FALSE);

    $results = $solr->search($query, 0, 1000, $params);
    $json = json_decode($results->getRawResponse(), TRUE);
  } catch (Exception $e) {
    watchdog("EMS module", "Unable to find TEI");
    throw $e;
  }

  if(count($json['response']['docs']) >= 1) {
    $tei_pid = $json['response']['docs'][0]["PID"];
  } else {
    $tei_pid = null;
  }
  return $tei_pid;

}
