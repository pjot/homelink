<table class="table table-striped table-bordered">
    <tbody>
        {foreach $rows as $row}
            <tr>
                <td>
                {if $row->type !== 'dir'}
                    <a class="btn {$row->btn_class}" href="{$baseUrl}?mode={$mode}&action=toggle&target={$row->target}">
                {else}
                    <a class="btn btn-primary" href="{$baseUrl}?mode={$mode}&path={$row->target}">
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
