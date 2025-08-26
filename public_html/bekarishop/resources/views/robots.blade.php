<?php
	$data = App\Models\Siteinfo::first();
?>

{!! $data->robots_txt !!}