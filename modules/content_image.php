<?php  
if (! $data['section_off']) {
    $align_class = ($data['layout'] == 'text_right') ? 'is-reversed' : '';
    
    if ( $data['section_style'] ) {
        include('content_image/advanced.php');
    } else {
        include('content_image/simple.php');
    }
}
?>