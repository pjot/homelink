{if isset($banner)}
	<div class="banner banner-{$banner.type}">
		{$banner.text}
		<a href="#" class="close">&times;</a>
	</div>
{/if}

<table class="list" cellspacing="0" border="0">
    <tbody>
	{if isset($useBack) && $useBack}
		<tr>
			<td>
				<a class="button button-primary" href="{$baseUrl}?action=seed&folder={$basePath}&goto=up">
					<i class="icon-chevron-up icon-white"></i>
				</a>
			</td>
		</tr>
	{/if}
        {foreach $rows as $row}
            <tr>
                <td>
                {if $row->type == Entry::DIR}
                    <a class="button button-primary" href="{$baseUrl}?action=seed&folder={if isset($useBack) && $useBack}{$basePath}/{/if}{$row->name}">
                {else}
                    <a class="button {$row->btn_class}" href="{$baseUrl}?action=toggle&target={$row->target}">
                {/if}
                        <i class="{$row->icon} icon-white"></i>
                    </a>
                    {if $row->type !== Entry::DIR && $row instanceof SeedEntry}
                        <a class="button subtitles_button">
                            <i class="icon-comment icon-white"></i>
                        </a>
                    {/if}
                    {$row->name}
                    <div class="subtitles_form" style="display: none; margin-top: 25px;">
                        <form action="{$baseUrl}?action=worker" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="media_file" value="{$row->target}" />

                            <label for="subtitles_file" class="control-label">Subtitles</label>
                            <input type="file" name="subtitles_file" value="" />
                            <div class="clearfix"></div>

                            <label for="out_file" class="control-label">Out file</label>
                            <input type="text" name="out_file" value="{$row->suggested_out_file}" />
                            <div class="clearfix"></div>
                                    
                            <input type="submit" class="button" value="Queue" />
                        </form>
                    </div>
                </td>
            </tr>
        {/foreach}
    </tbody>
</table>
