<?php

?>

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php $i = 0; foreach($sliders as $slider) {?>
            <li data-target="#carousel-example-generic" data-slide-to="<?=$i;?>"  class="<?= ($i==0) ? 'active' : '' ?>"></li>
        <?php $i++; } ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

        <?php $i=0; foreach($sliders as $slider) { ?>
            <div class="item <?= ($i == 0) ? 'active' : ''?> ">
                <img src="<?= $slider->image?>" alt="...">
                <div class="carousel-caption">
                    <?= $slider->description?>
                </div>
            </div>
        <?php $i++; } ?>

    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>