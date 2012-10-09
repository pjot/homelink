{if isset($banner)}
	<div class="fade in alert alert-{$banner.type}">
		{$banner.text}
		<a href="#" class="close" data-dismiss="alert">&times;</a>
	</div>
{/if}
<table class="table table-striped table-bordered">
    <tbody>
	{if isset($useBack) && $useBack}
		<tr>
			<td>
				<a class="btn btn-primary" href="{$baseUrl}?action=seed&folder={$basePath}&goto=up">
					<i class="icon-chevron-up icon-white"></i>
				</a>
				<strong>Up one level</strong>
			</td>
		</tr>
	{/if}
        {foreach $rows as $row}
            <tr>
                <td>
                    {if $row->type == Entry::DIR}
			<a class="btn btn-primary" href="{$baseUrl}?action=seed&folder={if isset($useBack) && $useBack}{$basePath}/{/if}{$row->name}">
     		    {else}
                        <a class="btn {$row->btn_class}" href="{$baseUrl}?action=toggle&target={$row->target}">
                    {/if}
                    <i class="{$row->icon}"></i>
                    </a>
                    {if $row->type == 'dir'}<strong>{/if}
			{$row->name}
		    {if $row->type == 'dir'}</strong>{/if}
                </td>
            </tr>
        {/foreach}
    </tbody>
</table>
