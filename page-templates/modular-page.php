<?php 
/* Template Name: Modular Page */

get_header();



/* Loop through flexible content fields and output modules */
$module_num = 1;
$modules = get_field('modules');
foreach($modules as $m) {
    $data = array_slice($m, 1, 1, true);
    $data = $data[$m['acf_fc_layout']];

    render_module($m['acf_fc_layout'], $data, 'mod-'.$module_num);
    $module_num++;
}


get_footer();
    
?>

