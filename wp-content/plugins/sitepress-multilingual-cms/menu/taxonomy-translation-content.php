<?php 
// renders WPML_Taxonomy_Translation objects
?>

<div id="wpml_tt_taxonomy_translation_wrap">
    
    <?php global $wp_taxonomies; ?>
    
    <?php if($this->show_selector): ?>
    <label>
    <?php _e('Select taxonomy to translate', 'sitepress'); ?> 
    <select id="icl_tt_tax_switch">
        <?php foreach($wp_taxonomies as $tax_key => $tax): if(!$sitepress->is_translated_taxonomy($tax_key)) continue; ?>
        <option value="<?php echo $tax_key ?>" <?php if($this->taxonomy == $tax_key): ?>selected="selected"<?php endif; ?>><?php echo $tax->labels->name ?></option>        
        <?php endforeach; ?>
    </select>
    </label>
    <?php endif; ?>
    
    <h3><?php printf(__('Translate %s', 'sitepress'), $this->taxonomy_obj->labels->name) ?></h3>

    <div class="icl_tt_tools">
        
        <form id="wpml_tt_filters">
        <input type="hidden" name="taxonomy" value="<?php echo $this->taxonomy ?>" />
        <?php _e('Show', 'sitepress') ?>
        <select name="status">
            <option value="<?php echo WPML_TT_TAXONOMIES_NOT_TRANSLATED ?>" <?php if($this->status == WPML_TT_TAXONOMIES_NOT_TRANSLATED): 
                ?>selected="selected"<?php endif;?> ><?php printf(__('untranslated %s', 'sitepress'), strtolower($this->taxonomy_obj->labels->name)) ?></option>
            <option value="<?php echo WPML_TT_TAXONOMIES_ALL ?>" <?php if($this->status == WPML_TT_TAXONOMIES_ALL): 
                ?>selected="selected"<?php endif;?>><?php printf(__('all %s', 'sitepress'), strtolower($this->taxonomy_obj->labels->name)) ?></option>
        </select>
        &nbsp;
        <?php _e('in', 'sitepress'); ?>
        &nbsp;
        <?php 
            /* assume that the selected language can be only one */ 
            if(count($this->selected_languages) == 1){
                $the_language = current($this->selected_languages);
            }            
        ?>
        <select name="language">
            <option value=""><?php _e('any language', 'sitepress') ?></option>
            <?php foreach($active_languages as $language): if($language['code'] != $sitepress->get_default_language()): ?>
            <option value="<?php echo $language['code'] ?>" <?php if(count($this->selected_languages) == 1 && $language['code'] == $the_language['code']): ?>selected="selected"<?php endif; ?>><?php echo $language['display_name'] ?></option>
            <?php endif; endforeach; ?>
        </select>
        &nbsp;        
        <input type="text" name="search" placeholder="<?php esc_attr_e('search', 'sitepress') ?>" value="<?php if(isset($this->search)) echo esc_attr($this->search) ?>" />
        <?php if(isset($this->search)): ?>
        <img id="wpml_tt_clear_search" src="<?php echo ICL_PLUGIN_URL ?>/res/img/close2.png" width="10" height="10" alt="<?php esc_attr_e('clear', 'sitepress') ?>" title="<?php esc_attr_e('clear search', 'sitepress') ?>" />        
        <?php endif; ?>
        
        &nbsp;
        <input type="submit" class="button-primary" value="<?php esc_attr_e('Apply', 'sitepress') ?>" />
        
        <img src="<?php echo ICL_PLUGIN_URL . '/res/img/ajax-loader.gif' ?>" alt="loading" height="16" width="16" class="wpml_tt_spinner" />
        
        </form>
        
        
        
    </div>

    <div class="icl_tt_main_top">
        
        <table class="wp-list-table widefat fixed">
            <thead>
                <tr>
                    <th><?php echo $this->taxonomy_obj->labels->singular_name ?></th>
                    <?php foreach($this->selected_languages as $language): if($language['code'] != $sitepress->get_default_language()): ?>
                    <th><?php echo $language['display_name'] ?></th>
                    <?php endif; endforeach; ?>
                </tr>
            </thead>
            <tbody>
            <?php if($this->terms): ?>
            <?php foreach($this->terms as $term): ?>
                <tr>
                    <td><?php echo $term->name ?></td>
                    <?php foreach($this->selected_languages as $language): if($language['code'] != $sitepress->get_default_language()): ?>
                    <td>
                        
                        <?php $class = isset($term->translations) && !empty($term->translations[$language['code']]) ? '' : ' lowlight'; ?>
                        <a class="icl_tt_term_name<?php echo $class ?>" href="#" onclick="WPML_Translate_taxonomy.show_form(<?php echo $term->term_taxonomy_id ?>,'<?php echo $language['code'] ?>');return false;">
                        <?php if(isset($term->translations) && !empty($term->translations[$language['code']])): ?>                                
                            <?php echo $term->translations[$language['code']]->name; ?>
                        <?php else: ?>
                            <?php _e('translate', 'sitepress'); ?>
                        <?php endif; ?>
                        </a>
                        
                        <form class="icl_tt_form hidden" id="icl_tt_form_<?php echo $term->term_taxonomy_id . '_' . $language['code'] ?>">    
                        <img src="<?php echo ICL_PLUGIN_URL . '/res/img/ajax-loader.gif' ?>" alt="loading" height="16" width="16" class="wpml_tt_spinner" />
                        <input type="hidden" name="translation_of" value="<?php echo $term->term_taxonomy_id ?>" />
                        <input type="hidden" name="taxonomy" value="<?php echo $this->taxonomy ?>" />
                        <input type="hidden" name="language" value="<?php echo $language['code'] ?>" />
                        <table>
                            <tr>
                                <td><?php _e('Name', 'sitepress') ?></td>
                                <td><input name="name" type="text" value="<?php echo isset($term->translations) && !empty($term->translations[$language['code']]) ? esc_attr($term->translations[$language['code']]->name) : '' ?>" /></td>
                            </tr>
                            <tr>
                                <td><?php _e('Slug', 'sitepress') ?></td>
                                <td><input name="slug" type="text" value="<?php echo isset($term->translations) && !empty($term->translations[$language['code']]) ? urldecode($term->translations[$language['code']]->slug ): '' ?>" /></td>
                            </tr>
                            <tr>
                                <td><?php _e('Description', 'sitepress') ?></td>
                                <td><textarea name="description" cols="22" rows="2"><?php echo isset($term->translations) && !empty($term->translations[$language['code']]) ? esc_attr($term->translations[$language['code']]->description) : '' ?></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="right">                                    
                                    <span class="errors icl_error_text"></span>
                                    <input class="button-secondary cancel" type="button" value="<?php esc_attr_e('cancel', 'sitepress') ?>" />
                                    <input class="button-primary" type="submit" value="<?php esc_attr_e('Ok', 'sitepress') ?>" />
                                </td>
                            </tr>
                        </table>                         
                        </form>  
                                                 
                    </td>
                    <?php endif; endforeach; ?>
                </tr>        
            <?php endforeach; ?>
            <?php else: ?>
                <tr><td align="center" colspan="<?php echo count($this->selected_languages)+1 ?>"><?php _e('No terms found', 'sitepress') ?></td></tr>
            <?php endif; ?>            
            </tbody>
        </table>              
        
        <?php if($this->terms_count > WPML_TT_TERMS_PER_PAGE): ?>            
        <div class="tablenav bottom">
            <div class="tablenav-pages">
                <span class="displaying-num"><?php printf(__('%d items', 'sitepress'), $this->terms_count) ?></span>
                <a class="first-page<?php if($this->current_page == 1):  ?> disabled<?php endif;?>" href="#" title="<?php esc_attr_e('Go to the first page', 'sitepress') ?>">&laquo;</a>        
                <a href="#" title="<?php esc_attr_e('Go to the previous page', 'sitepress') ?>" class="prev-page<?php if($this->current_page == 1):  ?> disabled<?php endif;?>">&lsaquo;</a>
                <span class="paging-input">
                    <input class="current-page" type="text" size="1" value="<?php echo $this->current_page ?>" name="paged" title="<?php esc_attr_e('Current page', 'sitepress') ?>" />
                    <?php _e('of', 'sitepress') ?>
                    <span class="total-pages"><?php echo $total_pages = ceil($this->terms_count / WPML_TT_TERMS_PER_PAGE) ?></span>                
                </span>
                <a class="next-page<?php if($this->current_page == $total_pages):  ?> disabled<?php endif;?>" href="#" title="<?php esc_attr_e('Go to the next page', 'sitepress') ?>">&rsaquo;</a>
                <a class="last-page<?php if($this->current_page == $total_pages):  ?> disabled<?php endif;?>" href="#" title="<?php esc_attr_e('Go to the last page', 'sitepress') ?>">&raquo;</a>        
            </div>
        </div>
        <?php endif; ?>
        
    </div>
    
    
    <?php if(defined('WPML_ST_FOLDER')): ?>
      
    <h3><?php printf(__('Translate the %s labels', 'sitepress'), $this->taxonomy_obj->labels->name) ?></h3>
    <div class="icl_tt_main_middle">
        
                    
        <table class="wp-list-table widefat fixed">
            <thead>
                <tr>
                    <th><?php echo $this->taxonomy_obj->labels->singular_name ?></th>
                    <?php foreach($this->selected_languages as $language): if($language['code'] != $sitepress->get_default_language()): ?>
                    <th><?php echo $language['display_name'] ?></th>
                    <?php endif; endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $this->taxonomy_obj->labels_translations[$sitepress_settings['st']['strings_language']]['singular'] . ' / ' . $this->taxonomy_obj->labels_translations[$sitepress_settings['st']['strings_language']]['general'] ?></td>
                    <?php foreach($this->selected_languages as $language): if($language['code'] != $sitepress->get_default_language()): ?>
                    <td>
                        <?php $class = !$this->taxonomy_obj->labels_translations[$language['code']]['singular'] || !$this->taxonomy_obj->labels_translations[$language['code']]['general'] ? ' lowlight' : ''; ?>
                        <a class="icl_tt_labels_<?php echo $this->taxonomy . '_' . $language['code']?><?php echo $class ?>" href="#" onclick="WPML_Translate_taxonomy.show_labels_form('<?php echo $this->taxonomy ?>','<?php echo $language['code'] ?>'); return false;">
                            <?php if(!$this->taxonomy_obj->labels_translations[$language['code']]['singular'] || !$this->taxonomy_obj->labels_translations[$language['code']]['general']): ?>
                                <?php _e('translate', 'sitepress'); ?>    
                            <?php else: ?>
                                <?php echo $this->taxonomy_obj->labels_translations[$language['code']]['singular'] . ' / ' . $this->taxonomy_obj->labels_translations[$language['code']]['general']; ?>
                            <?php endif; ?>
                        </a>                                                
                        <form class="icl_tt_labels_form hidden" id="icl_tt_labels_form_<?php echo $this->taxonomy . '_' . $language['code'] ?>">    
                        <img src="<?php echo ICL_PLUGIN_URL . '/res/img/ajax-loader.gif' ?>" alt="loading" height="16" width="16" class="wpml_tt_spinner" />
                        <input type="hidden" name="taxonomy" value="<?php echo $this->taxonomy ?>" />
                        <input type="hidden" name="language" value="<?php echo $language['code'] ?>" />
                        <input type="hidden" name="singular_original" value="<?php echo $this->taxonomy_obj->labels_translations[$sitepress_settings['st']['strings_language']]['singular'] ?>" />
                        <input type="hidden" name="general_original" value="<?php echo $this->taxonomy_obj->labels_translations[$sitepress_settings['st']['strings_language']]['general'] ?>" />
                        <table>
                            <tr>
                                <td><?php _e('Singular', 'sitepress') ?></td>
                                <td><input name="singular" type="text" value="<?php echo $this->taxonomy_obj->labels_translations[$language['code']]['singular'] ?>" /></td>
                            </tr>
                            <tr>
                                <td><?php _e('Plural', 'sitepress') ?></td>
                                <td><input name="general" type="text" value="<?php echo $this->taxonomy_obj->labels_translations[$language['code']]['general'] ?>" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="right">                                    
                                    <span class="errors icl_error_text"></span>
                                    <input class="button-secondary cancel" type="button" value="<?php esc_attr_e('cancel', 'sitepress') ?>" />
                                    <input class="button-primary" type="submit" value="<?php esc_attr_e('Ok', 'sitepress') ?>" />
                                </td>
                            </tr>
                        </table>
                        </form>
                    
                    </td>
                    <?php endif; endforeach; ?>
                </tr>        
            </tbody>
        </table>              
        
    </div>
    
    <?php endif; //if(defined('WPML_ST_FOLDER')): ?>
    
    <?php if($this->show_tax_sync): ?>
    <br /><br />
    <div class="icl_tt_main_bottom">
    <form id="icl_tt_sync_assignment">
    <input type="hidden" name="taxonomy" value="<?php echo $this->taxonomy ?>" />
    <input class="button-secondary" type="submit" value="<?php printf(__("Synchronize %s assignment in content", 'sitepress'), $this->taxonomy_obj->labels->name) ?>" />
    <img src="<?php echo ICL_PLUGIN_URL . '/res/img/ajax-loader.gif' ?>" alt="loading" height="16" width="16" class="wpml_tt_spinner" />
    <br /><span class="errors icl_error_text"></span>    
    <div class="icl_tt_sycn_preview"></div>
    </form>
    </div>
    <?php endif; ?>
    
</div>