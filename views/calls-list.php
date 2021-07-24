<?php
$calls = [];
if ( ! isset( $data['calls'] ) && ! is_array( $data['calls'] ) ) { ?>
    <div class="notice notice-error">
        <p>هیچ داده ای برای نمایش یافت نشد!</p>
        <p>لطفا از توکن های وارد شده در <a href="admin.php?page=vi-telefonchy-opt">تنظیمات</a> اطمینان حاصل فرمایید.</p>
    </div>
<?php } else {
	$calls = $data['calls'];
	?>
    <div class="container">
        <div class="row">
            <table class="table table-hover text-center">
                <thead>
                <tr>
                    <th scope="col">تاریخ</th>
                    <th scope="col">شماره تلفن</th>
                    <th scope="col">وضعیت</th>
                    <th scope="col">مدت زمان (ثانیه)</th>
                </tr>
                </thead>
                <tbody>
				<?php
				foreach ( $calls as $call ):
					$status = "";
					$tr_class = "";
					switch ( $call['status'] ):
						case "NO ANSWER":
							$status   = "بدون پاسخ";
							$tr_class = "table-warning";
							break;
						case "BUSY":
							$status   = "مشغول";
							$tr_class = "table-danger";
							break;
						case "ANSWERED":
							$status   = "پاسخ داده شده";
							$tr_class = "table-success";
							break;
					endswitch;
					?>
                    <tr class="<?php echo esc_html($tr_class); ?>">
                        <td><?php echo esc_html($call['created_at']); ?></td>
                        <td><?php
							if ( preg_match( '/(\d{3})(\d{3})(\d{4})$/', $call['call_source']['number'], $matches ) ) {
								echo esc_html( $matches[1] . '-' . $matches[2] . '-' . $matches[3] );
							} else {
								echo esc_html( $call['call_source']['number'] );
							}
							?></td>
                        <td><?php echo esc_html( $status ); ?></td>
                        <td><?php echo esc_html( $call['time_wait'] ); ?></td>
                    </tr>

				<?php
				endforeach;
				?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
					<?php
					$page_links = paginate_links(
						array(
							'base'      => add_query_arg( 'pagenum', '%#%' ),
							'format'    => '',
							'prev_text' => 'قبلی',
							'next_text' => 'بعدی',
							'total'     => $data['paginator']['total_pages'],
							'current'   => $data['paginator']['current']
						) );
					?><span><?php echo ($page_links); ?> </span>
                </ul>
            </nav>
        </div>
    </div>
	<?php
}