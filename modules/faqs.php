<?php if ( ! $data['faqs_off'] ) : ?>
    <section <?php echo $id_string; ?> class="faqs">
        <img src="<?php images_folder(); ?>borders/top_cta_yellow.svg" class="faqs__top">
        <div class="faqs__inner | u-px-mobile-15">
            <div class="container | js-hidden">
                <div class="row">
                    
                    <div class="col-lg-8 offset-lg-2 faqs__intro">
                        <?php if ($data['title']) : ?>
                            <h1 class="faqs__title"><?php echo $data['title']; ?></h1>
                        <?php endif; ?>

                        <?php if ($data['notice']) : ?>
                            <div class="faqs__notice | c-wysiwyg"><?php echo $data['notice']; ?></div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="col-lg-10 offset-lg-1 faqs_questions">

                        <?php $question_count = 1;
                            foreach( $data['questions'] as $q ) :
                                $active_class = ($question_count == 1) ? 'is-active' : '';
                                ?>
                                    <div class="faqs__question-container | <?php echo $active_class; ?>">
                                        <div class="faqs__question | js-faqs-toggle">
                                            <div class="faqs__question-inner">
                                                <h3 class="question"><?php echo $q['question']; ?></h3>
                                                <div class="toggle-icon">
                                                    <span class="line line-1"></span>
                                                    <span class="line line-2"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="faqs__answer | c-wysiwyg"><?php echo $q['answer']; ?></div>
                                    </div>
                                <?php
                            $question_count++;
                            endforeach; 
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <img src="<?php images_folder(); ?>borders/bottom_cta_yellow.svg" class="faqs__bottom">
    </section>
<?php endif; ?>