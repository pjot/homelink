{if isset($banner)}
	<div class="banner banner-{$banner.type}">
		{$banner.text}
        <a href="#" class="close">&times;</a>
	</div>
{/if}

<table class="list" border="0" cellspacing="0">
    <tbody>
	{if count($rows) == 0}
		<tr><td>No subtitle workers at the moment.</td></tr>
	{else}
		{foreach $rows as $row}
		    <tr>
			<td>
                <a class="button button-danger" href="{$baseUrl}?action=unqueue&id={$row->id}">
                    <i class="icon-trash icon-white"></i>
                </a>
                {*<div class="progress progress-striped progress-info span6" style="min-height: 18px; margin-top: 5px; margin-left: 14px;">
                    <div class="bar" style="width: {$row->progress}%;"></div>
                </div>*}
                {$row->file_name}
                <span class="meter">
                    <span class="bar" style="width: {$row->progress}%"></span>
                </span>
			</td>
		    </tr>
		{/foreach}
	{/if}
    </tbody>
</table>
