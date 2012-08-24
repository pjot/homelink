<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{$baseUrl}/bootstrap/css/bootstrap.min.css">
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
	<script type="text/javascript" src="{$baseUrl}/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$('.alert').alert();
	</script>
    </head>
    <body>
        <br />
        <div class="container">
            {$menu}
		<br />
            {$content}
        </div>
    </body>
</html>

