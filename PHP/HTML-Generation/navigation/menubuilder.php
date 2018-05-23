<?php

/**
 * Generate HTML for multi-dimensional menu from MySQL database
 * with ONE QUERY and WITHOUT RECURSION 
 * @author J. Bruni
 * http://stackoverflow.com/questions/2871861/how-to-build-unlimited-level-of-menu-through-php-and-mysql
 * http://pastebin.com/GAFvSew4
 */
class MenuBuilder
{
	/**
	 * MySQL connection
	 */
	var $conn;
	
	/**
	 * Menu items
	 */
	var $items = array();
	
	/**
	 * HTML contents
	 */
	var $html  = array();
	
	/**
	 * Create MySQL connection
	 */
	function MenuBuilder()
	{
		$this->conn = mysql_connect("localhost","root","cl119m1973460d");
		mysql_select_db( 'dev_clip_navigation', $this->conn );
	}
	
	/**
	 * Perform MySQL query and return all results
	 */
	function fetch_assoc_all( $sql )
	{
		$result = mysql_query( $sql, $this->conn );
		
		if ( !$result )
			return false;
		
		$assoc_all = array();
		
		while( $fetch = mysql_fetch_assoc( $result ) )
			$assoc_all[] = $fetch;
		
		mysql_free_result( $result );
		
		return $assoc_all;
	}
	
	/**
	 * Get all menu items from database
	 */
	function get_menu_items()
	{
		// Change the field names and the table name in the query below to match tour needs
		$sql = 'SELECT id, parent_id, title, handle, position FROM qserve_handle WHERE `company`=7 ORDER BY position, id, handle, parent_id;';
		return $this->fetch_assoc_all( $sql );
	}
	
	/**
	 * Build the HTML for the menu 
	 */
	function get_menu_html( $root_id = 0 )
	{
		$this->html  = array();
		$this->items = $this->get_menu_items();
		
		foreach ( $this->items as $item )
			$children[$item['parent_id']][] = $item;
		
		// loop will be false if the root has no children (i.e., an empty menu!)
		$loop = !empty( $children[$root_id] );
		
		// initializing $parent as the root
		$parent = $root_id;
		$parent_stack = array();
		
		// HTML wrapper for the menu (open)
		$this->html[] = '<ul id="sort" class="ui_tree">';
		
		while ( $loop && ( ( $option = each( $children[$parent] ) ) || ( $parent > $root_id ) ) )
		{
			if ( $option === false )
			{
				$parent = array_pop( $parent_stack );
				
				// HTML for menu item containing childrens (close)
				$this->html[] = str_repeat( "\t", ( count( $parent_stack ) + 1 ) * 2 ) . '</ul>';
				$this->html[] = str_repeat( "\t", ( count( $parent_stack ) + 1 ) * 2 - 1 ) . '</li>';
			}
			elseif ( !empty( $children[$option['value']['id']] ) )
			{
				$tab = str_repeat( "\t", ( count( $parent_stack ) + 1 ) * 2 - 1 );
				
				// HTML for menu item containing childrens (open)
				$this->html[] = sprintf(
					'%1$s<li id="id-%4$s"><a href="%2$s">%3$s</a>',
					$tab,   // %1$s = tabulation
					'/qserve/edit/domain.com/'.$option['value']['handle'],   // %2$s = handle (URL)
					$option['value']['title'],   // %3$s = title
					$option['value']['id']   // %4$s = id
				); 
				$this->html[] = $tab . "\t" . '<ul class="submenu">';
				
				array_push( $parent_stack, $option['value']['parent_id'] );
				$parent = $option['value']['id'];
			}
			else
				// HTML for menu item with no children (aka "leaf") 
				$this->html[] = sprintf(
					'%1$s<li id="id-%4$s"><a href="%2$s">%3$s</a></li>',
					str_repeat( "\t", ( count( $parent_stack ) + 1 ) * 2 - 1 ),   // %1$s = tabulation
					'/qserve/edit/domain.com/'.$option['value']['handle'],   // %2$s = handle (URL)
					$option['value']['title'],   // %3$s = title
					$option['value']['id']   // %4$s = id
				);
		}
		
		// HTML wrapper for the menu (close)
		$this->html[] = '</ul>';
		
		return implode( "\r\n", $this->html );
	}
}

$menu = new MenuBuilder();
//echo '<pre>' . htmlentities( $menu->get_menu_html() ) . '</p?e>';

echo $menu->get_menu_html(); //define param1 as root id.


?>
<script type='text/javascript' src='//code.jquery.com/jquery-1.9.1.js'></script>
  
  
  <style>
#sort {}
  #sort li {}
  html>body #sort li {}
  .ui-state-highlight {
/* 	  height: 1em; line-height: 1em; background: red; */
	border: 1px solid #cacaca;
	background: #e4e4e4;
	border-radius: 2px;	  
  }
  </style>
  <script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
  Query string: <span></span>
<script>
$(document).ready(function () {
    $('ul#sort,#sort ul').sortable({
        axis: 'y',
        placeholder: "ui-state-highlight",
        stop: function (event, ui) {
	        var data = $(this).sortable('serialize');
            $('span').text(data);
            $.ajax({
                    data: data,
                type: 'GET',
                url: 'resort.php'
            });
	}
    });
});
</script>