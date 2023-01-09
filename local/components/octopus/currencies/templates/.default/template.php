<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<h3><?= GetMessage("OCTOPUS_TEMPLATE_TITLE") ?></h3>

<?php
foreach ($arResult['RATES'] as $RATE){
    ?>
    <div style="display: flex">
        <p><?= $RATE['NAME'] ?>:</p>
        <p><?= $RATE['VALUE'] ?></p>
    </div>

    <?php
}
?>
