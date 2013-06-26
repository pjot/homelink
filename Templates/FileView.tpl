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
                    {if $row->type !== Entry::DIR && $row instanceof SeedEntry}
                        <a class="btn subtitles_button">
                            <i class="icon-comment"></i>
                        </a>
                    {/if}
                    {if $row->type == Entry::DIR}<strong>{/if}
                        {$row->name}
                    {if $row->type == Entry::DIR}</strong>{/if}
                    <div class="subtitles_form" style="display: none; margin-top: 25px;">
                        <form action="{$baseUrl}?action=worker" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="media_file" value="{$row->target}" />
                            <div class="control-group">
                                <label for="subtitles_file" class="control-label">Subtitles</label>
                                <div class="controls">
                                    <input type="file" name="subtitles_file" value="" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="out_file" class="control-label">Out file</label>
                                <div class="controls">
                                    <input type="text" name="out_file" value="{$row->suggested_out_file}" />
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <input type="submit" class="btn" value="Queue" />
                                </div>
                            </div>
                        </form>
                    </div>
                </td>
            </tr>
        {/foreach}
    </tbody>
</table>
