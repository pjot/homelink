<ul class="breadcrumb">
    {foreach $breadCrumbs as $breadcrumb}
        <li{if $breadcrumb->active} class="active"{/if}>
            <a href="{$breadcrumb->url}">{$breadcrumb->title}</a>
            {if ! $breadcrumb->active}<span class="divider">/</span>{/if}
        </li>
    {/foreach}
</ul>
