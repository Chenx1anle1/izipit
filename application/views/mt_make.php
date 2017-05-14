	<div class="container top">
		<table class="table table-striped table-hover">
		<thead style="border-style: none">
			<tr style="border-style: none">
	        	<th style="color: #ff5f83">标签</th>
	          	<th style="color: #ff5f83">数量</th>
	          	<th style="color: #ff5f83"></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
	        </tr>
		</thead>
	        <tbody style="border-style: none">
	          	<?php foreach ($make as $key => $value): ?>
				<?php if( $key % 5 == 0 ): ?>
					<tr style="border-style: none">
						<?php endif ?>
							<td style="border-style: none">
								<label class="icon-tag" style="color: #ff5f83">
									<?php $url = base_url('tag/' . $value['tag_name']); ?>
									<a title="标签名" href="<?php echo $url ?>">
										<?php echo $value['tag_name'] ?>
									</a>
								</label>
							</td>
							<td style="border-style: none">
							<a title="标签数量" href="<?php echo $url ?>">
								<?php echo "(".$value['tag_amount'].")" ?>
							</a>
							</td>
						<?php endforeach ?>
					</tr>
	        </tbody>
	    </table>
	</div>
</div>
