<form action="<?php echo site_url(); ?>" method="get">
		<input type="text" name="s" id="search" placeholder="Search..." value="<?php the_search_query(); ?>" />
		<input id="formbutton" type="submit" value="Search" />
</form>
