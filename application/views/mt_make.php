	<div class="container top">
		<table class="table table-striped table-hover">
		<thead>
			<tr>
	        	<th style="color: #ff5f83">标签</th>
	          	<th style="color: #ff5f83">数量</th>
	          	<th style="color: #ff5f83"></th>
				<th></th>
	        </tr>
		</thead>
	        <tbody>
	          	<?php foreach ($make as $key => $value): ?>
				<?php if( $key % 5 == 0 ): ?>
					<tr>
						<?php endif ?>
							<td>
								<label class="icon-tag" style="color: #ff5f83">
									<?php $url = base_url('tag/' . $value['tag_name']); ?>
									<a title="标签名" href="<?php echo $url ?>">
										<?php echo $value['tag_name'] ?>
									</a>
								</label>
							</td>
							<td>
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
