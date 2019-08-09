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
        $skip_fields = array("mods_name_personal_role_roleTerm_text_ms",
          "mods_relatedItem_constituent_titleInfo_title_ms",
          "mods_relatedItem_constituent_relatedItem_host_titleInfo_title_ms",
          "mods_relatedItem_constituent_relatedItem_host_originInfo_dateCreated_ms",
          "mods_relatedItem_constituent_relatedItem_host_originInfo_publisher_ms",
          "mods_relatedItem_constituent_relatedItem_host_identifier_local_ms",
          "mods_relatedItem_constituent_relatedItem_host_name_personal_role_roleTerm_text_ms");
      ?>
      <?php foreach($solr_fields as $value): ?>
        <!-- Skip the fields we are going to programmatically add -->
        <?php if(in_array($value['solr_field'], $skip_fields)) { continue; } ?>

        <!-- name (role) -->
        <?php if($value['solr_field'] == "mods_name_personal_namePart_ms") { ?>
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
                        if(isset($roles[$key])) {
                            $role_value = $roles[$key];
                        }
                        $name_role = $name_value . " (" . $role_value . ") ";
                        array_push($names_roles, $name_role);
                    }
                    print check_markup(implode($variables['separator'], $names_roles), 'islandora_solr_metadata_filtered_html');
                ?>
            </dd>
        <?php continue; } ?>

        <?php if($value['solr_field'] == "mods_relatedItem_constituent_relatedItem_host_name_personal_namePart_ms") { ?>
              <dt class="<?php print $row_field == 0 ? ' first' : ''; ?>">
                <?php print $value['display_label']; ?>
              </dt>
              <dd class="<?php print $row_field == 0 ? ' first' : ''; ?>">
                <?php
                $names = $value['value'];
                $roles = $solr_fields['mods_relatedItem_constituent_relatedItem_host_name_personal_role_roleTerm_text_ms']['value'];
                $names_roles = array();

                foreach ($names as $key => $name_value) {
                  $role_value = "";
                  if(isset($roles[$key])) {
                    $role_value = $roles[$key];
                  }
                  $name_role = $name_value . " (" . $role_value . ") ";
                  array_push($names_roles, $name_role);
                }
                print check_markup(implode($variables['separator'], $names_roles), 'islandora_solr_metadata_filtered_html');
                ?>
              </dd>
        <?php continue; } ?>

        <dt class="<?php print $row_field == 0 ? ' first' : ''; ?>">
          <?php print $value['display_label']; ?>
        </dt>
        <dd class="<?php print $row_field == 0 ? ' first' : ''; ?>">
          <?php print check_markup(implode($variables['separator'], $value['value']), 'islandora_solr_metadata_filtered_html'); ?>
        </dd>
        <?php $row_field++; ?>
      <?php endforeach; ?>

      <?php
      $titles = $solr_fields['mods_relatedItem_constituent_titleInfo_title_ms']['value'];
      $title_label = $solr_fields['mods_relatedItem_constituent_titleInfo_title_ms']['display_label'];
      $number_of_constituent = sizeof($titles);

      $hosts = $solr_fields['mods_relatedItem_constituent_relatedItem_host_titleInfo_title_ms']['value'];
      $host_label = $solr_fields['mods_relatedItem_constituent_relatedItem_host_titleInfo_title_ms']['display_label'];

      $dates = $solr_fields['mods_relatedItem_constituent_relatedItem_host_originInfo_dateCreated_ms']['value'];
      $date_label = $solr_fields['mods_relatedItem_constituent_relatedItem_host_originInfo_dateCreated_ms']['display_label'];

      $publishers = $solr_fields['mods_relatedItem_constituent_relatedItem_host_originInfo_publisher_ms']['value'];
      $publisher_label = $solr_fields['mods_relatedItem_constituent_relatedItem_host_originInfo_publisher_ms']['display_label'];

      $local_ids = $solr_fields['mods_relatedItem_constituent_relatedItem_host_identifier_local_ms']['value'];
      $local_id_label = $solr_fields['mods_relatedItem_constituent_relatedItem_host_identifier_local_ms']['display_label'];

      foreach ($titles as $key => $title) {
      ?>

        <dt class="<?php print $row_field == 0 ? ' first' : ''; ?>">
          <?php print $title_label; ?>
        </dt>
        <dd class="<?php print $row_field == 0 ? ' first' : ''; ?>">
          <?php print $title; ?>
        </dd>

        <?php if(sizeof($hosts) == $number_of_constituent) { ?>
         <dt class="<?php print $row_field == 0 ? ' first' : ''; ?>">
           <?php print $host_label; ?>
         </dt>
        <dd class="<?php print $row_field == 0 ? ' first' : ''; ?>">
          <?php
            if(isset($hosts[$key])) {
                print $hosts[$key];
            }
          ?>
        </dd>
        <?php } ?>

        <?php if(sizeof($dates) == $number_of_constituent) { ?>
        <dt class="<?php print $row_field == 0 ? ' first' : ''; ?>">
          <?php print $date_label; ?>
        </dt>
        <dd class="<?php print $row_field == 0 ? ' first' : ''; ?>">
          <?php
            if(isset($dates[$key])) {
              print $dates[$key];
            }
          ?>
        </dd>
        <?php } ?>

        <?php if(sizeof($publishers) == $number_of_constituent) { ?>
        <dt class="<?php print $row_field == 0 ? ' first' : ''; ?>">
          <?php print $publisher_label; ?>
        </dt>
        <dd class="<?php print $row_field == 0 ? ' first' : ''; ?>">
          <?php
            if(isset($publishers[$key])) {
              print $publishers[$key];
            }
          ?>
        </dd>
        <?php } ?>

        <?php if(sizeof($local_ids) == $number_of_constituent) { ?>
        <dt class="<?php print $row_field == 0 ? ' first' : ''; ?>">
          <?php print $local_id_label; ?>
        </dt>
        <dd class="<?php print $row_field == 0 ? ' first' : ''; ?>">
          <?php
            if(isset($local_ids[$key])) {
              print $local_ids[$key];
            }
          ?>
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


