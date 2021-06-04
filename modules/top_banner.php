<?php
    $display_class = '';
    if ($data['mobile_image']) {
        $display_class = 'u-hide-mobile';
    }
?>

<section <?php echo $id_string; ?> class="top-banner">
    <div class="container">
        <div class="row">
            <div class="top-banner__image-container">
                <img class="<?php echo $display_class; ?>" src="<?php echo $data['image']['sizes']['max-grid']; ?>" alt="<?php echo $data['image']['alt']; ?>" loading="eager">
                <?php if ($data['mobile_image']) : ?>
                    <img class="u-mobile-only" src="<?php echo $data['mobile_image']['sizes']['half-width']; ?>" alt="<?php echo $data['mobile_image']['alt']; ?>" loading="eager">
                <?php endif; ?>
            </div>
            <h1 class="top-banner__title | u-px-mobile-30"><?php echo $data['title']; ?></h1>
        </div>
    </div>
</section>