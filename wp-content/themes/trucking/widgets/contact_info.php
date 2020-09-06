<?php
extract( $args );
extract( $instance );

?>

<div class="contact-info-widget">
<?php
if ( $time_icon != '' || $time_title != '' || !$time_number != '' ) {
    ?>
    <div class="media time-info pull-right">
        <?php if ( $time_icon ) { ?>
            <div class="media-left media-middle">
                <img src="<?php echo esc_url($time_icon); ?>" alt="">
            </div>
        <?php } ?>
        <div class="media-body">
            <?php if ($time_number) { ?>
                <h4 class="media-heading"><?php echo trim($time_number); ?></h4>
            <?php } ?>
            <?php if ($time_title) { ?>
                <p><?php echo trim($time_title); ?></p>
            <?php } ?>
        </div>
    </div>
    <?php
}
?>

<?php
if ( $address_icon != '' || $address_title != '' || !$address_number != '' ) {
    ?>
    <div class="media address-info pull-right">
        <?php if ( $address_icon ) { ?>
            <div class="media-left media-middle">
                <img src="<?php echo esc_url($address_icon); ?>" alt="">
            </div>
        <?php } ?>
        <div class="media-body">
            <?php if ($address_number) { ?>
                <h4 class="media-heading"><?php echo trim($address_number); ?></h4>
            <?php } ?>
            <?php if ($address_title) { ?>
                <p><?php echo trim($address_title); ?></p>
            <?php } ?>
        </div>
    </div>
    <?php
}
?>

<?php
if ( $phone_icon != '' || $phone_title != '' || !$phone_number != '' ) {
    ?>
    <div class="media phone-info pull-right">
        <?php if ( $phone_icon ) { ?>
            <div class="media-left media-middle">
                <img src="<?php echo esc_url($phone_icon); ?>" alt="">
            </div>
        <?php } ?>
        <div class="media-body">
            <?php if ($phone_number) { ?>
                <h4 class="media-heading"><?php echo trim($phone_number); ?></h4>
            <?php } ?>
            <?php if ($phone_title) { ?>
                <p><?php echo trim($phone_title); ?></p>
            <?php } ?>
        </div>
    </div>
    <?php
}
?>
</div>