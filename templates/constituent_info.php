<?php

function get_constituent_label() {
  $constituents_field_label = array();
  $constituents_field_label["constituent_title"] = "Constituent Title";
  $constituents_field_label["host_title"] = "Host";
  $constituents_field_label["contributor"] = "Contributors";
  $constituents_field_label["date"] = "Date";
  $constituents_field_label["publisher"] = "Publisher ";
  $constituents_field_label["publisher_place"] = "Publication Place";
  $constituents_field_label["identifier_local"] = "Identifier (Local)";
  $constituents_field_label["identifier_wing"] = "Identifier (Wing)";
  $constituents_field_label["physical_location"] = "Physical Location";
  $constituents_field_label["digital_location"] = "Digital Location";
  return $constituents_field_label;
}

function get_constituent_info($pid) {
  $constituents_info = array();

#  $url = "http://localhost:8000/islandora/object/$pid/datastream/MODS/view";
  $url = "http://ems.digitalscholarship.utsc.utoronto.ca/islandora/object/$pid/datastream/MODS/view";

  $xml = simplexml_load_file($url);

  if (isset($xml)) {
    $constituents = $xml->xpath('mods:relatedItem[@type="constituent"]');

    foreach ($constituents as $key => $constituents_obj) {
      $title = get_element_string($constituents_obj, "mods:titleInfo/mods:title");
      $constituents_info[$key]["title"] = $title;

      $host_title = get_element_string($constituents_obj, "mods:relatedItem[@type='host']/mods:titleInfo/mods:title");
      $constituents_info[$key]["host_title"] = $host_title;

      $date = get_element_string($constituents_obj, "mods:relatedItem[@type='host']/mods:originInfo/mods:dateCreated");
      $constituents_info[$key]["date"] = $date;

      $publisher = get_element_string($constituents_obj, "mods:relatedItem[@type='host']/mods:originInfo/mods:publisher");
      $constituents_info[$key]["publisher"] = $publisher;

      $publisher_place = get_element_string($constituents_obj, "mods:relatedItem[@type='host']/mods:originInfo/mods:place");
      $constituents_info[$key]["publisher_place"] = $publisher_place;

      $identifier_local = get_element_string($constituents_obj, "mods:relatedItem[@type='host']/mods:identifier[@type='local']");
      $constituents_info[$key]["identifier_local"] = $identifier_local;

      $identifier_wing = get_element_string($constituents_obj, "mods:relatedItem[@type='host']/mods:identifier[@type='wing']");
      $constituents_info[$key]["identifier_wing"] = $identifier_wing;

      $physical_location = get_element_string($constituents_obj, "mods:relatedItem[@type='host']/mods:location/mods:physicalLocation");
      $constituents_info[$key]["physical_location"] = $physical_location;

      $digital_location = get_element_string($constituents_obj, "mods:relatedItem[@type='host']/mods:location/mods:holdingSimple/mods:copyInformation/mods:subLocation");
      $constituents_info[$key]["digital_location"] = $digital_location;

      $name_ele = $constituents_obj->xpath("mods:relatedItem[@type='host']/mods:name[@type='personal']");
      foreach ($name_ele as $key1 => $name_obj) {
        $name = get_element_string($name_obj, "mods:namePart");
        $constituents_info[$key]["name"][$key1]["namepart"] = $name;
        $role = get_element_string($name_obj, "mods:role/mods:roleTerm");
        $constituents_info[$key]["name"][$key1]["role"] = $role;
      }
    }
  }
  return $constituents_info;
}

function get_element_string($xml_obj, $query_path) {
  $xml_element_value = "";
  $xml_element = $xml_obj->xpath($query_path);
  if (isset($xml_element[0])) {
    $xml_element_value = trim($xml_element[0]->__toString());
  }
  return $xml_element_value;
}

?>

