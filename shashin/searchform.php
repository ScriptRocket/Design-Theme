<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div><label class="screen-reader-text" for="s" >Search for:</label>
		<i class="fas fa-search"></i>
        <input class="col-md-11" type="text" value="" name="s" id="s" placeholder="<?php the_search_query(); ?>" />
        <i class="fas fa-times"></i>
        <input  class="col-md-1" type="submit" id="searchsubmit" value="Search" />
    </div>
</form>