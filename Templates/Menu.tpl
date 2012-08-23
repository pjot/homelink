<div class="btn-group">
    {foreach $items as $item}
	<a class="btn btn-large{if $item.active} btn-primary{/if}" href="{$item.url}">
		<i class="{$item.icon}{if $item.active} icon-white{/if}"></i> {$item.name}
	</a>
    {/foreach}
</div>
