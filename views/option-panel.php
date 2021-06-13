<?php

use ViTelefonchy\classes\OptionPanel;

$webservice = '';
$service_id = '';
if ( isset( $data ) ) {
	$webservice = $data[0][ OptionPanel::VI_TELEFONCHY_OPTIONS_webservice ];
	$service_id = $data[0][ OptionPanel::VI_TELEFONCHY_OPTIONS_service_id ];
}
?>
<div class="container">
    <div class="row">
        <div class="d-block p-2"></div>
    </div>
	<?php
	if ( isset( $data[1], $data[1]['data'] ) ):?>
        <div class="notice notice-success">
            <p>شماره خط: <?php echo $data[1]['data'][0]['trunks'][0]['number'] ; ?></p>
            <p>مانده اعتبار(تومان): <?php echo $data[1]['data'][0]['trunks'][0]['credit']['value'] ; ?></p>
        </div>

	<?php endif; ?>
    <form method="post" action="">
        <table class="form-table" role="presentation">
            <tbody>
            <tr>
                <th scope="row"><label for="vi-telefonchy-webservice">توکن دسترسی (webservice-token)</label></th>
                <td><input name="vi-telefonchy-webservice" type="text" value="<?php echo $webservice; ?>" id="vi-telefonchy-webservice" class="regular-text" aria-describedby="slug-description">
                    <p id="slug-description">توکن دسترسی را در <a href="https://telefonchy.com/my/webservice">پنل تلفنچی</a> پیدا کنید</p>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="vi-telefonchy-service-id">شناسه سرویس ها (service_id)</label></th>
                <td><input name="vi-telefonchy-service-id" type="text" value="<?php echo $service_id; ?>" id="vi-telefonchy-service-id" class="regular-text" aria-describedby="slug-description">
                    <p id="slug-description">شناسه سرویس را در <a href="https://telefonchy.com/my/webservice">پنل تلفنچی</a> پیدا کنید</p>
                </td>
            </tr>

            </tbody>
        </table>

        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="ذخیرهٔ تغییرات"></p></form>

</div>
