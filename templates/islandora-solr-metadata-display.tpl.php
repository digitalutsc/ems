<?php
/**
 * @file
 * Islandora_solr_metadata display template.
 *
 * Variables available:
 * - $solr_fields: Array of results returned from Solr for the current object
 *   based upon defined display configuration(s). The array structure is:
 *   - display_label: The defined display label corresponding to the Solr field
 *     as defined in the configuration in translatable string form.
 *   - value: An array containing all the result(s) found for the specific field
 *     in Solr for the current object when queried against Solr.
 * - $found: Boolean indicating if a Solr doc was found for the current object.
 * - $not_found_message: A string to print if there was no document found in
 *   Solr.
 *
 * @see template_preprocess_islandora_solr_metadata_display()
 * @see template_process_islandora_solr_metadata_display()
 */
?>
<?php if ($found):
  if (!(empty($solr_fields) && variable_get('islandora_solr_metadata_omit_empty_values', FALSE))):?>
<fieldset <?php $print ? print('class="islandora islandora-metadata"') : print('class="islandora islandora-metadata collapsible collapsed"');?>>
  <legend><span class="fieldset-legend"><?php print t('Details'); ?></span></legend>
  <div class="fieldset-wrapper">
    <dl xmlns:dcterms="http://purl.org/dc/terms/" class="islandora-inline-metadata islandora-metadata-fields">
    <?php
      $row_field = 0;
      $skip_fields = array(
        "mods_name_personal_role_roleTerm_text_ms",
        "PID"
      );

    ?>
      <?php $row_field = 0; ?>
      <?php foreach($solr_fields as $value): ?>
        <!-- Skip the fields we are going to programmatically add -->
        <?php if (in_array($value['solr_field'], $skip_fields)) {
          continue;
        } ?>

        <!-- name (role) -->
        <?php if ($value['solr_field'] == "mods_name_personal_namePart_ms") { ?>
          <dt class="<?php print $row_field == 0 ? ' first' : ''; ?>">
            <?php print $value['display_label']; ?>
          </dt>

          <dd class="<?php print $row_field == 0 ? ' first' : ''; ?>">
          <?php
            $names = $value['value'];
            $roles = $solr_fields['mods_name_personal_role_roleTerm_text_ms']['value'];
            $names_roles = array();

            foreach ($names as $key => $name_value) {
              $role_value = "";
              if (isset($roles[$key])) {
                $role_value = $roles[$key];
              }
              $name_role = $name_value . " (" . $role_value . ")";
              array_push($names_roles, $name_role);
            }
            $names_roles = array_unique($names_roles);
            print check_markup(implode($variables['separator'], $names_roles), 'islandora_solr_metadata_filtered_html');
           ?>
           </dd>
        <?php continue;
        } ?>

        <dt class="<?php print $row_field == 0 ? ' first' : ''; ?>">
          <?php print $value['display_label']; ?>
        </dt>
        <dd class="<?php print $row_field == 0 ? ' first' : ''; ?>">
          <?php print check_markup(implode($variables['separator'], $value['value']), 'islandora_solr_metadata_filtered_html'); ?>
        </dd>
        <?php $row_field++; ?>
      <?php endforeach; ?>
      <?php
        $constituents_field_label = $variables['constituent_labels'];
        $constituents_info = $variables['constituent_info'];
        $indent_space = "&nbsp;&nbsp;&nbsp";

        foreach ($constituents_info as $key => $constituents_obj) {
        $constituents_num = $key + 1;

        if (trim($constituents_obj["title"]) == "") {
          continue;
        }

      ?>
                    <dt class="<?php print $row_field == 0 ? ' first' : ''; ?>">
                      <?php print $constituents_field_label["constituent_title"] . " " . $constituents_num; ?>
                    </dt>
                    <dd class="<?php print $row_field == 0 ? ' first' : ''; ?>">
                      <?php print $constituents_obj["title"]; ?>
                    </dd>

                  <?php if($constituents_obj["host_title"] != "") { ?>
                        <dt class="<?php print $row_field == 0 ? ' first' : ''; ?>">
                          <?php print $indent_space . $constituents_field_label["host_title"]; ?>
                        </dt>
                        <dd class="<?php print $row_field == 0 ? ' first' : ''; ?>">
                          <?php print $constituents_obj["host_title"]; ?>
                        </dd>
                  <?php } ?>

                    <dt class="<?php print $row_field == 0 ? ' first' : ''; ?>">
                      <?php print $indent_space . $constituents_field_label["contributor"]; ?>
                    </dt>
                    <dd class="<?php print $row_field == 0 ? ' first' : ''; ?>">
                      <?php
                        if(isset($constituents_info[0]["name"])) {

                        $name_info = $constituents_info[0]["name"];
                        $names_roles = array();
                          foreach ($name_info as $key => $name_obj) {
                            $name_part = $name_obj["namepart"];
                            $role = $name_obj["role"];
                            $name_role = $name_part . " (" . $role . ") ";
                            array_push($names_roles, $name_role);
                          }
                          $names_roles = array_unique($names_roles);
                          print check_markup(implode($variables['separator'], $names_roles), 'islandora_solr_metadata_filtered_html');

                        }
                      ?>
                    </dd>

                    <?php if($constituents_obj["date"] != "") { ?>
                    <dt class="<?php print $row_field == 0 ? ' first' : ''; ?>">
                      <?php print $indent_space .  $constituents_field_label["date"]; ?>
                    </dt>
                    <dd class="<?php print $row_field == 0 ? ' first' : ''; ?>">
                      <?php print $constituents_obj["date"]; ?>
                    </dd>
                    <?php } ?>

                    <?php if($constituents_obj["publisher"] != "") { ?>
                    <dt class="<?php print $row_field == 0 ? ' first' : ''; ?>">
                      <?php print $indent_space . $constituents_field_label["publisher"]; ?>
                    </dt>
                    <dd class="<?php print $row_field == 0 ? ' first' : ''; ?>">
                      <?php print $constituents_obj["publisher"]; ?>
                    </dd>
                    <?php } ?>

                    <?php if($constituents_obj["publisher_place"] != "") { ?>
                    <dt class="<?php print $row_field == 0 ? ' first' : ''; ?>">
                      <?php print$indent_space .  $constituents_field_label["publisher_place"]; ?>
                    </dt>
                    <dd class="<?php print $row_field == 0 ? ' first' : ''; ?>">
                      <?php print $constituents_obj["publisher_place"]; ?>
                    </dd>
                    <?php } ?>

                    <?php if($constituents_obj["identifier_local"] != "") { ?>
                    <dt class="<?php print $row_field == 0 ? ' first' : ''; ?>">
                      <?php print $indent_space . $constituents_field_label["identifier_local"]; ?>
                    </dt>
                    <dd class="<?php print $row_field == 0 ? ' first' : ''; ?>">
                      <?php print $constituents_obj["identifier_local"]; ?>
                    </dd>
                    <?php } ?>

                    <?php if($constituents_obj["identifier_wing"] != "") { ?>
                    <dt class="<?php print $row_field == 0 ? ' first' : ''; ?>">
                      <?php print $indent_space . $constituents_field_label["identifier_wing"]; ?>
                    </dt>
                    <dd class="<?php print $row_field == 0 ? ' first' : ''; ?>">
                      <?php print $constituents_obj["identifier_wing"]; ?>
                    </dd>
                    <?php } ?>

                    <?php if($constituents_obj["physical_location"] != "") { ?>
                    <dt class="<?php print $row_field == 0 ? ' first' : ''; ?>">
                      <?php print $indent_space . $constituents_field_label["physical_location"]; ?>
                    </dt>
                    <dd class="<?php print $row_field == 0 ? ' first' : ''; ?>">
                      <?php print $constituents_obj["physical_location"]; ?>
                    </dd>
                    <?php } ?>

                    <?php if($constituents_obj["digital_location"] != "") { ?>
                    <dt class="<?php print $row_field == 0 ? ' first' : ''; ?>">
                      <?php print $indent_space . $constituents_field_label["digital_location"]; ?>
                    </dt>
                    <dd class="<?php print $row_field == 0 ? ' first' : ''; ?>">
                      <?php print $constituents_obj["digital_location"]; ?>
                    </dd>

                <?php }} ?>      
    </dl>
  </div>
</fieldset>
<?php endif; ?>
<?php else: ?>
  <fieldset <?php $print ? print('class="islandora islandora-metadata"') : print('class="islandora islandora-metadata collapsible collapsed"');?>>
    <legend><span class="fieldset-legend"><?php print t('Details'); ?></span></legend>
    <?php //XXX: Hack in markup for message. ?>
    <div class="messages--warning messages warning">
      <?php print $not_found_message; ?>
    </div>
  </fieldset>
<?php endif; ?>

