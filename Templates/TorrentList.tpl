{if isset($banner)}
	<div class="fade in alert alert-{$banner.type}">
		{$banner.text}
		<a href="#" class="close" data-dismiss="alert">&times;</a>
	</div>
{/if}
<table class="table table-striped table-bordered">
    <tbody>
	{if count($rows) == 0}
		<tr><td>No downloads at the moment.</td></tr>
	{else}
		{foreach $rows as $row}
		    <tr>
			<td>
				<div class="clearfix">
					<div class="progress progress-striped progress-info span6">
						<div class="bar" style="width: {$row->progress}%;"></div>
					</div>
				</div>
				<div class="clearfix">
					<i class="icon-time"></i> {$row->eta}
				</div>
				<div class="clearfix">
					<i class="icon-file"></i> {$row->name}
				</div>
			</td>
		    </tr>
		{/foreach}
	{/if}
    </tbody>
</table>
