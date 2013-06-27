<div id="menu">
    {foreach $items as $item}
	<a class="item{if $item.active} active{/if}" href="{$item.url}">
		<i class="{$item.icon}{if $item.active} icon-white{/if}"></i> {$item.name}
	</a>
    {/foreach}
</div>
