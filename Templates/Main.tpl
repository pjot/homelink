<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="static/pjotpi.css" />
        <link rel="stylesheet" href="static/icons.css" />
        <link rel="icon" href="static/favicon.ico" />
        <style>
            td {
                vertical-align: baseline!important;
            }
		.progress {
			float: left!important;
			margin-right: 10px;
			margin-bottom: 0;
		}
        </style>
	<script type="text/javascript" src="{$baseUrl}/js/jquery.min.js"></script>
	<script type="text/javascript">
        $(document).ready(function () {
            $('.subtitles_button').click(function () {
                $(this).parent().find('.subtitles_form').toggle();
                return false;
            });
            $('.banner .close').click(function () {
                $(this).parent().hide();
                return false;
            });
        });
	</script>
    </head>
    <body>
        {$menu}
        <div class="clearfix"></div>
        {$content}
    </body>
</html>

