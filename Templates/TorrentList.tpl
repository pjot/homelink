{if isset($banner)}
	<div class="banner banner-{$banner.type}">
		{$banner.text}
		<a href="#" class="close">&times;</a>
	</div>
{/if}
<table class="list" border="0" cellspacing="0">
    <tbody>
	{if count($rows) == 0}
		<tr><td>No downloads at the moment.</td></tr>
	{else}
		{foreach $rows as $row}
		    <tr>
			<td>
				<div class="clearfix">
					<div class="progress progress-striped progress-info span6" style="min-height: 18px;">
						<div class="bar" style="width: {$row->progress};"></div>
					</div>
				</div>
				<div class="clearfix">
					<i class="icon-time"></i> {$row->eta}
				</div>
				<div class="clearfix">
					<i class="icon-file"></i> {$row->name}
				</div>
                <div class="clearfix">
                    {$row->status}
                </div>
                <div class="clearfix">
                    {$row->speed}kB/s
                </div>
			</td>
		    </tr>
		{/foreach}
	{/if}
    </tbody>
</table>
