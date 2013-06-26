{if isset($banner)}
	<div class="fade in alert alert-{$banner.type}">
		{$banner.text}
		<a href="#" class="close" data-dismiss="alert">&times;</a>
	</div>
{/if}
<table class="table table-striped table-bordered">
    <tbody>
	{if count($rows) == 0}
		<tr><td>No subtitle workers at the moment.</td></tr>
	{else}
		{foreach $rows as $row}
		    <tr>
			<td>
                <div style="float: left">
                    <a class="btn btn-danger" href="{$baseUrl}?action=unqueue&id={$row->id}">
                        <i class="icon-trash icon-white"></i>
                    </a>
                </div>
                <div class="progress progress-striped progress-info span6" style="min-height: 18px; margin-top: 5px; margin-left: 14px;">
                    <div class="bar" style="width: {$row->progress}%;"></div>
                </div>
                <div style="margin-top: 5px;">
                    <i class="icon-file"></i> {$row->name}
                </div>
			</td>
		    </tr>
		{/foreach}
	{/if}
    </tbody>
</table>
