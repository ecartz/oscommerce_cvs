<? include('includes/application_top.php'); ?>
<? $include_file = DIR_LANGUAGES . $language . '/' . FILENAME_PRODUCTS_ATTRIBUTES; include(DIR_INCLUDES . 'include_once.php'); ?>
<?
  if ($HTTP_GET_VARS['action']) {
    if ($HTTP_GET_VARS['action'] == 'add_product_options') {
      tep_db_query("insert into products_options values ('', '" . $HTTP_POST_VARS['option_name'] . "')");
      $products_options_id = tep_db_insert_id();
      header('Location: ' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'option_page=' . $option_page . '&value_page=' . $value_page . '&attribute_page=' . $attribute_page, 'NONSSL')); tep_exit();
	} elseif ($HTTP_GET_VARS['action'] == 'add_product_option_values') {
      tep_db_query("insert into products_options_values values ('', '" . $HTTP_POST_VARS['value_name'] . "')");
      $products_options_values_id = tep_db_insert_id();
      tep_db_query("insert into products_options_values_to_products_options values ('', '" . $HTTP_POST_VARS['option_id'] . "', '" . $HTTP_POST_VARS['value_id'] . "')");
	  header('Location: ' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'option_page=' . $option_page . '&value_page=' . $value_page . '&attribute_page=' . $attribute_page, 'NONSSL')); tep_exit();  
	} elseif ($HTTP_GET_VARS['action'] == 'add_product_attributes') {
      tep_db_query("insert into products_attributes values ('', '" . $HTTP_POST_VARS['products_id'] . "', '" . $HTTP_POST_VARS['options_id'] . "', '" . $HTTP_POST_VARS['values_id'] . "', '" . $HTTP_POST_VARS['value_price'] . "', '" . $HTTP_POST_VARS['price_prefix'] . "')");
      $products_attributes_id = tep_db_insert_id();
      header('Location: ' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'option_page=' . $option_page . '&value_page=' . $value_page . '&attribute_page=' . $attribute_page, 'NONSSL')); tep_exit(); 
    } elseif ($HTTP_GET_VARS['action'] == 'update_option_name') {
      tep_db_query("update products_options set products_options_name = '" . $HTTP_POST_VARS['option_name'] . "' where products_options_id = '" . $HTTP_POST_VARS['option_id'] . "'");
      header('Location: ' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'option_page=' . $option_page . '&value_page=' . $value_page . '&attribute_page=' . $attribute_page, 'NONSSL')); tep_exit();
    } elseif ($HTTP_GET_VARS['action'] == 'update_value') {
      tep_db_query("update products_options_values_to_products_options set products_options_id = '" . $HTTP_POST_VARS['option_id'] . "', products_options_values_id = '" . $HTTP_POST_VARS['value_id'] . "'  where products_options_values_to_products_options_id = '" . $HTTP_POST_VARS['value_id'] . "'");
	  tep_db_query("update products_options_values set products_options_values_name = '" . $HTTP_POST_VARS['value_name'] . "' where products_options_values_id = '" . $HTTP_POST_VARS['value_id'] . "'");
      header('Location: ' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'option_page=' . $option_page . '&value_page=' . $value_page . '&attribute_page=' . $attribute_page, 'NONSSL')); tep_exit();
    } elseif ($HTTP_GET_VARS['action'] == 'update_product_attribute') {
      tep_db_query("update products_attributes set products_id = '" . $HTTP_POST_VARS['products_id'] . "', options_id = '" . $HTTP_POST_VARS['options_id'] . "', options_values_id = '" . $HTTP_POST_VARS['values_id'] . "', options_values_price = '" . $HTTP_POST_VARS['value_price'] . "', price_prefix = '" . $HTTP_POST_VARS['price_prefix'] . "' where products_attributes_id = '" . $HTTP_POST_VARS['attribute_id'] . "'");
      header('Location: ' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'option_page=' . $option_page . '&value_page=' . $value_page . '&attribute_page=' . $attribute_page, 'NONSSL')); tep_exit();
    } elseif ($HTTP_GET_VARS['action'] == 'delete_option') {
      tep_db_query("delete from products_options where products_options_id = '" . $HTTP_GET_VARS['option_id'] . "'");
      header('Location: ' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, '', 'NONSSL')); tep_exit();
	} elseif ($HTTP_GET_VARS['action'] == 'delete_value') {
      tep_db_query("delete from products_options_values where products_options_values_id = '" . $HTTP_GET_VARS['value_id'] . "'");
      tep_db_query("delete from products_options_values_to_products_options where products_options_values_to_products_options_id = '" . $HTTP_GET_VARS['value_id'] . "'");
	  header('Location: ' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, '', 'NONSSL')); tep_exit();  
	} elseif ($HTTP_GET_VARS['action'] == 'delete_attribute') {
      tep_db_query("delete from products_attributes where products_attributes_id = '" . $HTTP_GET_VARS['attribute_id'] . "'");
      header('Location: ' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'option_page=' . $option_page . '&value_page=' . $value_page, 'NONSSL')); tep_exit(); 
    }
  }
?>
<html>
<head>
<title><?=TITLE;?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript"><!--
function checkFormOpt() {
  var error_message = "<?=JS_ERROR;?>";
  var error = 0;
  var option_name = document.options.option_name.value;
  
  if (option_name.length < 1) {
    error_message = error_message + "<?=JS_OPTIONS_OPTION_NAME;?>";
    error = 1;
  }
  
  if (error == 1) {
    alert(error_message);
    return false;
  } else {
    return true;
  }
}

function checkFormVal() {
  var error_message = "<?=JS_ERROR;?>";
  var error = 0;
  var value_name = document.values.value_name.value;
  
  if (value_name.length < 1) {
    error_message = error_message + "<?=JS_OPTIONS_VALUE_NAME;?>";
    error = 1;
  }
  
  if (error == 1) {
    alert(error_message);
    return false;
  } else {
    return true;
  }
}

function go_option() {
  if (document.option_order_by.selected.options[document.option_order_by.selected.selectedIndex].value != "none") {
    location = "<?=FILENAME_PRODUCTS_ATTRIBUTES . '?option_page=';
	if (!$HTTP_GET_VARS['option_page']) {
	$option_page = 1;
	} else {
	$option_page = $HTTP_GET_VARS['option_page'];
	}
	echo $option_page;?>&option_order_by="+document.option_order_by.selected.options[document.option_order_by.selected.selectedIndex].value;
  }
}

function checkFormAtrib() {
  var error_message = "<?=JS_ERROR;?>";
  var error = 0;
  var price = document.attributes.value_price.value;
  var price_prefix = document.attributes.price_prefix.value;
  
  if (price.length < 1) {
    error_message = error_message + "<?=JS_OPTIONS_VALUE_PRICE;?>";
    error = 1;
  }
  if (price_prefix.length < 1) {
    error_message = error_message + "<?=JS_OPTIONS_VALUE_PRICE_PREFIX;?>";
    error = 1;
  }
  
  if (error == 1) {
    alert(error_message);
    return false;
  } else {
    return true;
  }
}

//--></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<? $include_file = DIR_INCLUDES . 'header.php';  include(DIR_INCLUDES . 'include_once.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="5" cellpadding="5">
  <tr>
    <td width="<?=BOX_WIDTH;?>" valign="top"><table border="0" width="<?=BOX_WIDTH;?>" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<!-- left_navigation //-->
<? $include_file = DIR_INCLUDES . 'column_left.php'; include(DIR_INCLUDES . 'include_once.php'); ?>
<!-- left_navigation_eof //-->
        </table></td>
      </tr>
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="boxborder">
          <tr>
            <td bgcolor="<?=TOP_BAR_BACKGROUND_COLOR;?>" width="100%" nowrap><font face="<?=TOP_BAR_FONT_FACE;?>" size="<?=TOP_BAR_FONT_SIZE;?>" color="<?=TOP_BAR_FONT_COLOR;?>">&nbsp;<?=TOP_BAR_TITLE;?>&nbsp;</font></td>
          </tr>
        </table></td>
      </tr>
<!-- options and values//-->
      <tr>
        <td width="100%"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="top" width="50%">
<!-- options //-->
<table width="100%" border="0" cellspacing="0" cellpadding="2">

<?
  if ($HTTP_GET_VARS['action'] == 'delete_product_option') { // delete product option
    $options = tep_db_query("select products_options_id, products_options_name from products_options where products_options_id = '" . $HTTP_GET_VARS['option_id'] . "'");
    $options_values = tep_db_fetch_array($options);
?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td nowrap><font face="<?=HEADING_FONT_FACE;?>" size="<?=HEADING_FONT_SIZE;?>" color="<?=HEADING_FONT_COLOR;?>">&nbsp;<?=$options_values['products_options_name'];?>&nbsp;</font></td>
            <td align="right" nowrap>&nbsp;<?=tep_image(DIR_IMAGES . 'pixel_trans.gif', '1', '70', '0', '');?>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan="3"><?=tep_black_line();?></td>
          </tr>
<?
    $products = tep_db_query("select products.products_id, products.products_name, products_options_values.products_options_values_name from products, products_options_values, products_attributes where products_attributes.products_id = products.products_id and products_attributes.options_id='" . $HTTP_GET_VARS['option_id'] . "' and products_options_values.products_options_values_id = products_attributes.options_values_id order by products.products_name");
    if (tep_db_num_rows($products)) {
?>
          <tr>
            <td align="center" nowrap><font face="<?=TABLE_HEADING_FONT_FACE;?>" size="<?=TABLE_HEADING_FONT_SIZE;?>" color="<?=TABLE_HEADING_FONT_COLOR;?>"><b>&nbsp;<?=TABLE_HEADING_ID;?>&nbsp;</b></font></td>
            <td><font face="<?=TABLE_HEADING_FONT_FACE;?>" size="<?=TABLE_HEADING_FONT_SIZE;?>" color="<?=TABLE_HEADING_FONT_COLOR;?>"><b>&nbsp;<?=TABLE_HEADING_PRODUCT;?>&nbsp;</b></font></td>
            <td><font face="<?=TABLE_HEADING_FONT_FACE;?>" size="<?=TABLE_HEADING_FONT_SIZE;?>" color="<?=TABLE_HEADING_FONT_COLOR;?>"><b>&nbsp;<?=TABLE_HEADING_OPT_VALUE;?>&nbsp;</b></font></td>
          </tr>
          <tr>
            <td colspan="3"><?=tep_black_line();?></td>
          </tr>
<?
      while ($products_values = tep_db_fetch_array($products)) {
        $rows++;
        if (floor($rows/2) == ($rows/2)) {
          echo '          <tr bgcolor="#ffffff">' . "\n";
        } else {
          echo '          <tr bgcolor="#f4f7fd">' . "\n";
        }
?>
            <td align="center" nowrap><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=$products_values['products_id'];?>&nbsp;</font></td>
            <td><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=$products_values['products_name'];?>&nbsp;</font></td>
            <td><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=$products_values['products_options_values_name'];?>&nbsp;</font></td>
          </tr>
<?
      }
?>
          <tr>
            <td colspan="3"><?=tep_black_line();?></td>
          </tr>
          <tr>
            <td colspan="3"><br><font face="<?=TEXT_FONT_FACE;?>" size="<?=TEXT_FONT_SIZE;?>" color="<?=TEXT_FONT_COLOR;?>"><?=TEXT_WARNING_OF_DELETE;?></font></td>
          </tr>
          <tr>
            <td align="right" colspan="3"><br><font face="<?=TEXT_FONT_FACE;?>" size="<?=TEXT_FONT_SIZE;?>" color="<?=TEXT_FONT_COLOR;?>"><?='<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, '&value_page=' . $value_page . '&attribute_page=' . $attribute_page, 'NONSSL') . '">';?><?=tep_image(DIR_IMAGES . 'button_cancel.gif', '50', '14', '0', ' cancel ');?></a>&nbsp;&nbsp;</font></td>
          </tr>
<?
    } else {
?>
          <tr>
            <td colspan="3"><br><font face="<?=TEXT_FONT_FACE;?>" size="<?=TEXT_FONT_SIZE;?>" color="<?=TEXT_FONT_COLOR;?>"><?=TEXT_OK_TO_DELETE;?></font></td>
          </tr>
          <tr>
            <td align="right" colspan="3"><br><font face="<?=TEXT_FONT_FACE;?>" size="<?=TEXT_FONT_SIZE;?>" color="<?=TEXT_FONT_COLOR;?>"><?='<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_option&option_id=' . $HTTP_GET_VARS['option_id'], 'NONSSL') . '">';?><?=tep_image(DIR_IMAGES . 'button_delete.gif', '50', '14', '0', 'Delete');?></a>&nbsp;&nbsp;&nbsp;<?='<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, '&order_by=' . $order_by . '&page=' . $page, 'NONSSL') . '">';?><?=tep_image(DIR_IMAGES . 'button_cancel.gif', '50', '14', '0', 'Cancel');?></a>&nbsp;&nbsp;</font></td>
          </tr>
    
<?
    }
?>
  	</td></tr></table>
<?
	} else {
	if ($HTTP_GET_VARS['option_order_by']) {
      $option_order_by = $HTTP_GET_VARS['option_order_by'];
    } else {
      $option_order_by = 'products_options_id';
    }
?>
      <tr>
        <td colspan="2"><font face="<?=HEADING_FONT_FACE;?>" size="<?=HEADING_FONT_SIZE;?>" color="<?=HEADING_FONT_COLOR;?>">&nbsp;<?=HEADING_TITLE_OPT;?>&nbsp;</font></td>
        <td align="center"><br><form name="option_order_by"><select name="selected" onChange="go_option()"><option value="products_options_id"<? if ($option_order_by == 'products_options_id') { echo ' SELECTED'; } ?>>Option ID</option><option value="products_options_name"<? if ($option_order_by == 'products_options_name') { echo ' SELECTED'; } ?>>Option Name</option></select></form></td>
      </tr>
      <tr>
        <td colspan=3><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">
<? 
   $per_page = MAX_ROW_LISTS_OPTIONS; 
   $options = ("select * from products_options order by '" . $option_order_by . "'"); 
   if (!$option_page) 
    { 
      $option_page = 1; 
    } 
   $prev_option_page = $option_page - 1; 
   $next_option_page = $option_page + 1; 
    
   $option_query = tep_db_query($options); 
    
   $option_page_start = ($per_page * $option_page) - $per_page; 
   $num_rows = tep_db_num_rows($option_query); 
    
   if ($num_rows <= $per_page) { 
      $num_pages = 1; 
   } else if (($num_rows % $per_page) == 0) { 
      $num_pages = ($num_rows / $per_page); 
   } else { 
      $num_pages = ($num_rows / $per_page) + 1; 
   } 
   $num_pages = (int) $num_pages; 
    
   if (($option_page > $num_pages) || ($option_page < 0)) { 
      die("You have specified an invalid page number"); 
   } 
    
   $options = $options . " LIMIT $option_page_start, $per_page"; 
    
   // Previous 
   if ($prev_option_page)  { 
      echo "<a href=\"$PHP_SELF?page=$prev_option_page\"><< </a> | "; 
   } 
    
   for ($i = 1; $i <= $num_pages; $i++) { 
      if ($i != $option_page) { 
         echo " <a href=\"$PHP_SELF?option_page=$i\">$i</a> | "; 
      } else { 
         echo " <b><font color=red>$i</font><font color=black></b> |"; 
      } 
   } 
    
   // Next 
   if ($option_page != $num_pages) { 
      echo " <a href=\"$PHP_SELF?option_page=$next_option_page\"> >></a>"; 
   } 
   echo '</td>'; 
    
?> 		
          </tr>
	  <tr>
            <td colspan="3"><?=tep_black_line();?></td>
          </tr>
          <tr>
            <td><font face="<?=TABLE_HEADING_FONT_FACE;?>" size="<?=TABLE_HEADING_FONT_SIZE;?>" color="<?=TABLE_HEADING_FONT_COLOR;?>"><b>&nbsp;<?=TABLE_HEADING_ID;?>&nbsp;</b></font></td>
            <td><font face="<?=TABLE_HEADING_FONT_FACE;?>" size="<?=TABLE_HEADING_FONT_SIZE;?>" color="<?=TABLE_HEADING_FONT_COLOR;?>"><b>&nbsp;<?=TABLE_HEADING_OPT_NAME;?>&nbsp;</b></font></td>
            <td align="center"><font face="<?=TABLE_HEADING_FONT_FACE;?>" size="<?=TABLE_HEADING_FONT_SIZE;?>" color="<?=TABLE_HEADING_FONT_COLOR;?>"><b>&nbsp;<?=TABLE_HEADING_ACTION;?>&nbsp;</b></font></td>
          </tr>
          <tr>
            <td colspan="3"><?=tep_black_line();?></td>
          </tr>
<?
  $options = tep_db_query("$options");
  while ($options_values = tep_db_fetch_array($options)) {
    $rows++;
    if (floor($rows/2) == ($rows/2)) {
      echo '          <tr bgcolor="#ffffff">' . "\n";
    } else {
      echo '          <tr bgcolor="#f4f7fd">' . "\n";
    }
    if (($HTTP_GET_VARS['action'] == 'update_option') && ($HTTP_GET_VARS['option_id'] == $options_values['products_options_id'])) {
      echo '<form name="option" action="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=update_option_name', 'NONSSL') . '" method="post" onSubmit="return checkFormOption();">';
?>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=$options_values['products_options_id'];?><input type="hidden" name="option_id" value="<?=$options_values['products_options_id'];?>">&nbsp;</font></td>
	    <td><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<input type="text" name="option_name" value="<?=$options_values['products_options_name'];?>" size="20">&nbsp;</font></td>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=tep_image_submit(DIR_IMAGES . 'button_update_red.gif', '50', '14', '0', IMAGE_UPDATE);?>&nbsp;<?='<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, '', 'NONSSL') . '">';?><?=tep_image(DIR_IMAGES . 'button_cancel.gif', '50', '14', '0', IMAGE_CANCEL);?></a>&nbsp;</font></td>
<?
      echo '</form>' . "\n";
?>
          </tr>
<?
    } else {
?>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=$options_values["products_options_id"];?>&nbsp;</font></td>
            <td><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=$options_values["products_options_name"];?>&nbsp;</font></td>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?='<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=update_option&option_id=' . $options_values['products_options_id'] . '&option_order_by=' . $option_order_by . '&option_page=' . $option_page, 'NONSSL') . '">';?><?=tep_image(DIR_IMAGES . 'button_modify.gif', '50', '14', '0', IMAGE_MODIFY);?></a>&nbsp;&nbsp;<?='<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_product_option&option_id=' . $options_values['products_options_id'], 'NONSSL') , '">';?><?=tep_image(DIR_IMAGES . 'button_delete.gif', '50', '14', '0', IMAGE_DELETE);?></a>&nbsp;</font></td>
          </tr>
<?
    }
        $max_options_id_query = tep_db_query("select max(products_options_id) + 1 as next_id from products_options");
        $max_options_id_values = tep_db_fetch_array($max_options_id_query);
        $next_id = $max_options_id_values['next_id'];
  }
?>
          <tr>
            <td colspan="3"><?=tep_black_line();?></td>
          </tr>
<?
  if (!$HTTP_GET_VARS['action'] == 'update_option') {
    if (floor($rows/2) == ($rows/2)) {
      echo '          <tr bgcolor="#f4f7fd">' . "\n";
    } else {
      echo '          <tr bgcolor="#ffffff">' . "\n";
    }
    echo '<form name="options" action="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=add_product_options', 'NONSSL') . '" method="post" onSubmit="return checkFormOpt();">';
?>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=$next_id;?>&nbsp;</font></td>
            <td><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<input type="text" name="option_name" size="20">&nbsp;</font></td>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=tep_image_submit(DIR_IMAGES . 'button_insert.gif', '50', '14', '0', IMAGE_INSERT);?>&nbsp;</font></td>
</form>
          </tr>
          <tr>
            <td colspan="3"><?=tep_black_line();?></td>
          </tr>
<?
  }
  }
?>	  
</table>	  
<!-- options eof //-->
</td><td valign="top" width="50%">
<!-- value //-->
<table width="100%" border="0" cellspacing="0" cellpadding="2">
<?
  if ($HTTP_GET_VARS['action'] == 'delete_option_value') { // delete product option value
    $values = tep_db_query("select products_options_values_id, products_options_values_name from products_options_values where products_options_values_id = '" . $HTTP_GET_VARS['value_id'] . "'");
    $values_values = tep_db_fetch_array($values);
?>
      <tr>
        <td colspan="3"><font face="<?=HEADING_FONT_FACE;?>" size="<?=HEADING_FONT_SIZE;?>" color="<?=HEADING_FONT_COLOR;?>">&nbsp;<?=$values_values['products_options_values_name'];?>&nbsp;</font></td>
        <td>&nbsp;<?=tep_image(DIR_IMAGES . 'pixel_trans.gif', '1', '70', '0', '');?>&nbsp;</td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan="3"><?=tep_black_line();?></td>
          </tr>
<?
    $products = tep_db_query("select products.products_id, products.products_name, products_options.products_options_name from products, products_attributes, products_options where products_attributes.products_id = products.products_id and products_attributes.options_values_id='" . $HTTP_GET_VARS['value_id'] . "' and products_options.products_options_id = products_attributes.options_id order by products.products_name");
    if (tep_db_num_rows($products)) {
?>
          <tr>
            <td align="center" nowrap><font face="<?=TABLE_HEADING_FONT_FACE;?>" size="<?=TABLE_HEADING_FONT_SIZE;?>" color="<?=TABLE_HEADING_FONT_COLOR;?>"><b>&nbsp;<?=TABLE_HEADING_ID;?>&nbsp;</b></font></td>
            <td><font face="<?=TABLE_HEADING_FONT_FACE;?>" size="<?=TABLE_HEADING_FONT_SIZE;?>" color="<?=TABLE_HEADING_FONT_COLOR;?>"><b>&nbsp;<?=TABLE_HEADING_PRODUCT;?>&nbsp;</b></font></td>
            <td><font face="<?=TABLE_HEADING_FONT_FACE;?>" size="<?=TABLE_HEADING_FONT_SIZE;?>" color="<?=TABLE_HEADING_FONT_COLOR;?>"><b>&nbsp;<?=TABLE_HEADING_OPT_NAME;?>&nbsp;</b></font></td>
          </tr>
          <tr>
            <td colspan="3"><?=tep_black_line();?></td>
          </tr>
<?
      while ($products_values = tep_db_fetch_array($products)) {
        $rows++;
        if (floor($rows/2) == ($rows/2)) {
          echo '          <tr bgcolor="#ffffff">' . "\n";
        } else {
          echo '          <tr bgcolor="#f4f7fd">' . "\n";
        }
?>
            <td align="center" nowrap><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=$products_values['products_id'];?>&nbsp;</font></td>
            <td><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=$products_values['products_name'];?>&nbsp;</font></td>
            <td><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=$products_values['products_options_name'];?>&nbsp;</font></td>
          </tr>
<?
      }
?>
          <tr>
            <td colspan="3"><?=tep_black_line();?></td>
          </tr>
          <tr>
            <td colspan="3"><br><font face="<?=TEXT_FONT_FACE;?>" size="<?=TEXT_FONT_SIZE;?>" color="<?=TEXT_FONT_COLOR;?>"><?=TEXT_WARNING_OF_DELETE;?></font></td>
          </tr>
          <tr>
            <td align="right" colspan="3"><br><font face="<?=TEXT_FONT_FACE;?>" size="<?=TEXT_FONT_SIZE;?>" color="<?=TEXT_FONT_COLOR;?>"><?='<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, '&value_page=' . $value_page . '&attribute_page=' . $attribute_page, 'NONSSL') . '">';?><?=tep_image(DIR_IMAGES . 'button_cancel.gif', '50', '14', '0', ' cancel ');?></a>&nbsp;&nbsp;</font></td>
          </tr>
<?
    } else {
?>
          <tr>
            <td colspan="3"><br><font face="<?=TEXT_FONT_FACE;?>" size="<?=TEXT_FONT_SIZE;?>" color="<?=TEXT_FONT_COLOR;?>"><?=TEXT_OK_TO_DELETE;?></font></td>
          </tr>
          <tr>
            <td align="right" colspan="3"><br><font face="<?=TEXT_FONT_FACE;?>" size="<?=TEXT_FONT_SIZE;?>" color="<?=TEXT_FONT_COLOR;?>"><?='<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_value&value_id=' . $HTTP_GET_VARS['value_id'], 'NONSSL') . '">';?><?=tep_image(DIR_IMAGES . 'button_delete.gif', '50', '14', '0', 'Delete');?></a>&nbsp;&nbsp;&nbsp;<?='<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, '&option_page=' . $option_page . '&value_page=' . $value_page . '&attribute_page=' . $attribute_page, 'NONSSL') . '">';?><?=tep_image(DIR_IMAGES . 'button_cancel.gif', '50', '14', '0', 'Cancel');?></a>&nbsp;&nbsp;</font></td>
          </tr>
    
<?
    }
?>
  	</td></tr></table>
<? 
   } else {
?>
      <tr>
        <td colspan="3"><font face="<?=HEADING_FONT_FACE;?>" size="<?=HEADING_FONT_SIZE;?>" color="<?=HEADING_FONT_COLOR;?>">&nbsp;<?=HEADING_TITLE_VAL;?>&nbsp;</font></td>
        <td>&nbsp;<?=tep_image(DIR_IMAGES . 'pixel_trans.gif', '1', '56', '0', '');?>&nbsp;</td>
      </tr>
      <tr>
        <td colspan=4><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">
<? 
   $per_page = MAX_ROW_LISTS_OPTIONS; 
   $values = ("select * from products_options_values_to_products_options"); 
   if (!$value_page) 
    { 
      $value_page = 1; 
    } 
   $prev_value_page = $value_page - 1; 
   $next_value_page = $value_page + 1; 
    
   $value_query = tep_db_query($values); 
    
   $value_page_start = ($per_page * $value_page) - $per_page; 
   $num_rows = tep_db_num_rows($value_query); 
    
   if ($num_rows <= $per_page) { 
      $num_pages = 1; 
   } else if (($num_rows % $per_page) == 0) { 
      $num_pages = ($num_rows / $per_page); 
   } else { 
      $num_pages = ($num_rows / $per_page) + 1; 
   } 
   $num_pages = (int) $num_pages; 
    
   if (($value_page > $num_pages) || ($value_page < 0)) { 
      die("You have specified an invalid page number"); 
   } 
    
   $values = $values . " LIMIT $value_page_start, $per_page"; 
    
   // Previous 
   if ($prev_value_page)  { 
      echo "<a href=\"$PHP_SELF?option_order_by=$option_order_by&value_page=$prev_value_page\"><< </a> | "; 
   } 
    
   for ($i = 1; $i <= $num_pages; $i++) { 
      if ($i != $value_page) { 
         echo " <a href=\"$PHP_SELF?option_order_by=$option_order_by&value_page=$i\">$i</a> | "; 
      } else { 
         echo " <b><font color=red>$i</font><font color=black></b> |"; 
      } 
   } 
    
   // Next 
   if ($value_page != $num_pages) { 
      echo " <a href=\"$PHP_SELF?option_order_by=$option_order_by&value_page=$next_value_page\"> >></a>"; 
   } 
   echo '</td>'; 
    
?> 		
          </tr>
	  <tr>
            <td colspan="4"><?=tep_black_line();?></td>
          </tr>
          <tr>
            <td><font face="<?=TABLE_HEADING_FONT_FACE;?>" size="<?=TABLE_HEADING_FONT_SIZE;?>" color="<?=TABLE_HEADING_FONT_COLOR;?>"><b>&nbsp;<?=TABLE_HEADING_ID;?>&nbsp;</b></font></td>
            <td><font face="<?=TABLE_HEADING_FONT_FACE;?>" size="<?=TABLE_HEADING_FONT_SIZE;?>" color="<?=TABLE_HEADING_FONT_COLOR;?>"><b>&nbsp;<?=TABLE_HEADING_OPT_NAME;?>&nbsp;</b></font></td>
			<td><font face="<?=TABLE_HEADING_FONT_FACE;?>" size="<?=TABLE_HEADING_FONT_SIZE;?>" color="<?=TABLE_HEADING_FONT_COLOR;?>"><b>&nbsp;<?=TABLE_HEADING_OPT_VALUE;?>&nbsp;</b></font></td>
            <td align="center"><font face="<?=TABLE_HEADING_FONT_FACE;?>" size="<?=TABLE_HEADING_FONT_SIZE;?>" color="<?=TABLE_HEADING_FONT_COLOR;?>"><b>&nbsp;<?=TABLE_HEADING_ACTION;?>&nbsp;</b></font></td>
          </tr>
          <tr>
            <td colspan="4"><?=tep_black_line();?></td>
          </tr>
<?
  $values = tep_db_query("$values");
  while ($values_values = tep_db_fetch_array($values)) {
  $options_name = tep_options_name($values_values['products_options_id']);
  $values_name = tep_values_name($values_values['products_options_values_id']);
    $rows++;
    if (floor($rows/2) == ($rows/2)) {
      echo '          <tr bgcolor="#ffffff">' . "\n";
    } else {
      echo '          <tr bgcolor="#f4f7fd">' . "\n";
    }
    if (($HTTP_GET_VARS['action'] == 'update_option_value') && ($HTTP_GET_VARS['value_id'] == $values_values['products_options_values_id'])) {
      echo '<form name="values" action="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=update_value', 'NONSSL') . '" method="post" onSubmit="return checkFormValue();">';
?>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=$values_values['products_options_values_id'];?><input type="hidden" name="value_id" value="<?=$values_values['products_options_values_id'];?>">&nbsp;</font></td>
			<td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?="\n";?><select name="option_id"><?
    $options = tep_db_query("select products_options_id, products_options_name from products_options order by products_options_name");
    while ($options_values = tep_db_fetch_array($options)) {
      echo "\n" . '<option name="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '"';
	  if ($values_values['products_options_id'] == $options_values['products_options_id']) { echo ' selected';};
	  echo '>' . $options_values['products_options_name'] . '</option>';
    } ?></select>&nbsp;</font></td>
			<td><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<input type="text" name="value_name" value="<?=$values_name;?>" size="15">&nbsp;</font></td>
            <td align="center" nowrap><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=tep_image_submit(DIR_IMAGES . 'button_update_red.gif', '50', '14', '0', IMAGE_UPDATE);?>&nbsp;<?='<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, '', 'NONSSL') . '">';?><?=tep_image(DIR_IMAGES . 'button_cancel.gif', '50', '14', '0', IMAGE_CANCEL);?></a>&nbsp;</font></td>
<?
      echo '</form>' . "\n";
?>
          </tr>
<?
    } elseif (($HTTP_GET_VARS['action'] == 'delete_city') && ($HTTP_GET_VARS['index_id'] == $cities_values['cities_id'])) {
?>
            <td><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<b><?=$cities_values["cities_id"];?></b>&nbsp;</font></td>
            <td></td>
			<td><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<b><?=$cities_values["cities_name"];?></b>&nbsp;</font></td>
            <td align="center" nowrap><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<b><?='<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_city_name&index_id=' . $HTTP_GET_VARS['index_id'], 'NONSSL') . '">';?><?=tep_image(DIR_IMAGES . 'button_confirm_red.gif', '50', '14', '0', IMAGE_CONFIRM);?></a>&nbsp;&nbsp;<?='<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, '', 'NONSSL') . '">';?><?=tep_image(DIR_IMAGES . 'button_cancel.gif', '50', '14', '0', IMAGE_CANCEL);?></a>&nbsp;</b></font></td>
          </tr>
<?
    } else {
?>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=$values_values["products_options_values_to_products_options_id"];?>&nbsp;</font></td>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=$options_name;?>&nbsp;</font></td>
	    	<td><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=$values_name;?>&nbsp;</font></td>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?='<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=update_option_value&value_id=' . $values_values['products_options_values_id'], 'NONSSL') . '">';?><?=tep_image(DIR_IMAGES . 'button_modify.gif', '50', '14', '0', IMAGE_MODIFY);?></a>&nbsp;&nbsp;<?='<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_option_value&value_id=' . $values_values['products_options_values_id'], 'NONSSL') , '">';?><?=tep_image(DIR_IMAGES . 'button_delete.gif', '50', '14', '0', IMAGE_DELETE);?></a>&nbsp;</font></td>
          </tr>
<?
    }
        $max_values_id_query = tep_db_query("select max(products_options_values_id) + 1 as next_id from products_options_values");
        $max_values_id_values = tep_db_fetch_array($max_values_id_query);
        $next_id = $max_values_id_values['next_id'];
  }
?>
          <tr>
            <td colspan="4"><?=tep_black_line();?></td>
          </tr>
<?
  if (!$HTTP_GET_VARS['action'] == 'update_value') {
    if (floor($rows/2) == ($rows/2)) {
      echo '          <tr bgcolor="#f4f7fd">' . "\n";
    } else {
      echo '          <tr bgcolor="#ffffff">' . "\n";
    }
    echo '<form name="values" action="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=add_product_option_values', 'NONSSL') . '" method="post" onSubmit="return checkFormVal();">';
?>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=$next_id;?>&nbsp;</font></td>
			<td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<select name="option_id"><?
    $options = tep_db_query("select products_options_id, products_options_name from products_options order by products_options_name");
    while ($options_values = tep_db_fetch_array($options)) {
      echo '<option name="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '">' . $options_values['products_options_name'] . '</option>';
    } ?></select>&nbsp;</font></td>
            <td><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<input type="hidden" name="value_id" value="<?=$next_id;?>"><input type="text" name="value_name" size="15">&nbsp;</font></td>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=tep_image_submit(DIR_IMAGES . 'button_insert.gif', '50', '14', '0', IMAGE_INSERT);?>&nbsp;</font></td>
</form>
          </tr>
          <tr>
            <td colspan="4"><?=tep_black_line();?></td>
          </tr>
<?
  }
  }
?>	  
</table></td></tr></table>
<!-- option value eof //-->
</td></tr> 
<!-- products_attributes //-->  
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td><font face="<?=HEADING_FONT_FACE;?>" size="<?=HEADING_FONT_SIZE;?>" color="<?=HEADING_FONT_COLOR;?>">&nbsp;<?=HEADING_TITLE_ATRIB;?>&nbsp;</font></td>
            <td>&nbsp;<?=tep_image(DIR_IMAGES . 'pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT, '0', '');?>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
		<tr><td colspan=7><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">
<? 
   $per_page = MAX_ROW_LISTS_OPTIONS; 
   $attributes = ("select * from products_attributes order by products_attributes_id"); 
//   $attributes = ("select products_attributes_id, products_name, products_id, products_options_name, products_options_id, products_options_values_name, products_options_values_id, products_options_values_price from products, products_options, products_options_values, products_attributes where products_attributes.products_id = products.products_id and products_attributes.products_options_id = products_options.products_options_id and products_attributes.products_options_values_id = products_options_values.products_options_values_id order by products_attributes_id");
   if (!$attribute_page) 
    { 
      $attribute_page = 1; 
    } 
   $prev_attribute_page = $attribute_page - 1; 
   $next_attribute_page = $attribute_page + 1; 
    
   $attribute_query = tep_db_query($attributes); 
    
   $attribute_page_start = ($per_page * $attribute_page) - $per_page; 
   $num_rows = tep_db_num_rows($attribute_query); 
    
   if ($num_rows <= $per_page) { 
      $num_pages = 1; 
   } else if (($num_rows % $per_page) == 0) { 
      $num_pages = ($num_rows / $per_page); 
   } else { 
      $num_pages = ($num_rows / $per_page) + 1; 
   } 
   $num_pages = (int) $num_pages; 
    
   if (($attribute_page > $num_pages) || ($attribute_page < 0)) { 
      die("You have specified an invalid page number");
   } 
    
   $attributes = $attributes . " LIMIT $attribute_page_start, $per_page"; 
    
   // Previous 
   if ($prev_attribute_page)  { 
      echo "<a href=\"$PHP_SELF?attribute_page=$prev_attribute_page\"><< </a> | "; 
   } 
    
   for ($i = 1; $i <= $num_pages; $i++) { 
      if ($i != $attribute_page) { 
         echo " <a href=\"$PHP_SELF?attribute_page=$i\">$i</a> | "; 
      } else { 
         echo " <b><font color=red>$i</font><font color=black></b> |"; 
      } 
   } 
    
   // Next 
   if ($attribute_page != $num_pages) { 
      echo " <a href=\"$PHP_SELF?attribute_page=$next_attribute_page\"> >></a>"; 
   } 
   echo '</td></tr>'; 
    
?> 		
          <tr>
            <td colspan="7"><?=tep_black_line();?></td>
          </tr>
          <tr>
            <td><font face="<?=TABLE_HEADING_FONT_FACE;?>" size="<?=TABLE_HEADING_FONT_SIZE;?>" color="<?=TABLE_HEADING_FONT_COLOR;?>"><b>&nbsp;<?=TABLE_HEADING_ID;?>&nbsp;</b></font></td>
            <td align="center"><font face="<?=TABLE_HEADING_FONT_FACE;?>" size="<?=TABLE_HEADING_FONT_SIZE;?>" color="<?=TABLE_HEADING_FONT_COLOR;?>"><b>&nbsp;<?=TABLE_HEADING_PRODUCT;?>&nbsp;</b></font></td>
            <td align="center"><font face="<?=TABLE_HEADING_FONT_FACE;?>" size="<?=TABLE_HEADING_FONT_SIZE;?>" color="<?=TABLE_HEADING_FONT_COLOR;?>"><b>&nbsp;<?=TABLE_HEADING_OPT_NAME;?>&nbsp;</b></font></td>
            <td align="center"><font face="<?=TABLE_HEADING_FONT_FACE;?>" size="<?=TABLE_HEADING_FONT_SIZE;?>" color="<?=TABLE_HEADING_FONT_COLOR;?>"><b>&nbsp;<?=TABLE_HEADING_OPT_VALUE;?>&nbsp;</b></font></td>
	        <td align="right"><font face="<?=TABLE_HEADING_FONT_FACE;?>" size="<?=TABLE_HEADING_FONT_SIZE;?>" color="<?=TABLE_HEADING_FONT_COLOR;?>"><b>&nbsp;<?=TABLE_HEADING_OPT_PRICE;?>&nbsp;</b></font></td>
            <td align="center"><font face="<?=TABLE_HEADING_FONT_FACE;?>" size="<?=TABLE_HEADING_FONT_SIZE;?>" color="<?=TABLE_HEADING_FONT_COLOR;?>"><b>&nbsp;<?=TABLE_HEADING_OPT_PRICE_PREFIX;?>&nbsp;</b></font></td>
	    <td align="center"><font face="<?=TABLE_HEADING_FONT_FACE;?>" size="<?=TABLE_HEADING_FONT_SIZE;?>" color="<?=TABLE_HEADING_FONT_COLOR;?>"><b>&nbsp;<?=TABLE_HEADING_ACTION;?>&nbsp;</b></font></td>
          </tr>
          <tr>
            <td colspan="7"><?=tep_black_line();?></td>
          </tr>
<?
  $attributes = tep_db_query("$attributes");
  while ($attributes_values = tep_db_fetch_array($attributes)) {
  $products_name_only = tep_products_name_only($attributes_values['products_id']);
  $options_name = tep_options_name($attributes_values['options_id']);
  $values_name = tep_values_name($attributes_values['options_values_id']);
    $rows++;
    if (floor($rows/2) == ($rows/2)) {
      echo '          <tr bgcolor="#ffffff">' . "\n";
    } else {
      echo '          <tr bgcolor="#f4f7fd">' . "\n";
    }
    if (($HTTP_GET_VARS['action'] == 'update_attribute') && ($HTTP_GET_VARS['attribute_id'] == $attributes_values['products_attributes_id'])) {
      echo '<form name="attributes" action="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=update_product_attribute' . '&option_page=' . $option_page . '&value_page=' . $value_page . '&attribute_page=' . $attribute_page, 'NONSSL') . '" method="post" onSubmit="return checkFormAtrib();">';
?>
        <td nowrap><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=$attributes_values['products_attributes_id'];?><input type="hidden" name="attribute_id" value="<?=$attributes_values['products_attributes_id'];?>">&nbsp;</font></td>
	<td align="center" nowrap><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?="\n";?><select name="products_id"><?
      $products = tep_db_query("select products_id, products_name from products order by products_name");
      while($products_values = tep_db_fetch_array($products)) {
        if ($attributes_values['products_id'] == $products_values['products_id']) {
          echo "\n" . '<option name="' . $products_values['products_name'] . '" value="' . $products_values['products_id'] . '" SELECTED>' . $products_values['products_name'] . '</option>';
        } else {
          echo "\n" . '<option name="' . $products_values['products_name'] . '" value="' . $products_values['products_id'] . '">' . $products_values['products_name'] . '</option>';
        }
      } ?></select>&nbsp;</font></td>
	<td align="center" nowrap><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?="\n";?><select name="options_id"><?
      $options = tep_db_query("select * from products_options order by products_options_name");
      while($options_values = tep_db_fetch_array($options)) {
        if ($attributes_values['options_id'] == $options_values['products_options_id']) {
          echo "\n" . '<option name="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '" SELECTED>' . $options_values['products_options_name'] . '</option>';
        } else {
          echo "\n" . '<option name="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '">' . $options_values['products_options_name'] . '</option>';
        }
      } ?></select>&nbsp;</font></td>
        <td align="center" nowrap><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?="\n";?><select name="values_id"><?
      $values = tep_db_query("select * from products_options_values order by products_options_values_name");
      while($values_values = tep_db_fetch_array($values)) {
        if ($attributes_values['options_values_id'] == $values_values['products_options_values_id']) {
          echo "\n" . '<option name="' . $values_values['products_options_values_name'] . '" value="' . $values_values['products_options_values_id'] . '" SELECTED>' . $values_values['products_options_values_name'] . '</option>';
        } else {
          echo "\n" . '<option name="' . $values_values['products_options_values_name'] . '" value="' . $values_values['products_options_values_id'] . '">' . $values_values['products_options_values_name'] . '</option>';
        }
      } ?></select>&nbsp;</font></td>
            <td align="right"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<input type="text" name="value_price" value="<?=$attributes_values['options_values_price'];?>" size="6">&nbsp;</font></td>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<input type="text" name="price_prefix" value="<?=$attributes_values['price_prefix'];?>" size="2">&nbsp;</font></td>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=tep_image_submit(DIR_IMAGES . 'button_update_red.gif', '50', '14', '0', IMAGE_UPDATE);?>&nbsp;<?='<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, '&attribute_page=' . $attribute_page, 'NONSSL') . '">';?><?=tep_image(DIR_IMAGES . 'button_cancel.gif', '50', '14', '0', IMAGE_CANCEL);?></a>&nbsp;</font></td>
<?
      echo '</form>' . "\n";
?>
          </tr>
<?
    } elseif (($HTTP_GET_VARS['action'] == 'delete_product_attribute') && ($HTTP_GET_VARS['attribute_id'] == $attributes_values['products_attributes_id'])) {
?>
            <td nowrap><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<b><?=$attributes_values["products_attributes_id"];?></b>&nbsp;</font></td>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<b><?=$products_name_only;?></b>&nbsp;</font></td>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<b><?=$options_name;?></b>&nbsp;</font></td>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<b><?=$values_name;?></b>&nbsp;</font></td>
            <td align="right"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<b><?=$attributes_values["options_values_price"];?></b>&nbsp;</font></td>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<b><?=$attributes_values["price_prefix"];?></b>&nbsp;</font></td>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<b><?='<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_attribute&attribute_id=' . $HTTP_GET_VARS['attribute_id'], 'NONSSL') . '">';?><?=tep_image(DIR_IMAGES . 'button_confirm_red.gif', '50', '14', '0', IMAGE_CONFIRM);?></a>&nbsp;&nbsp;<?='<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, '&option_page=' . $option_page . '&value_page=' . $value_page . '&attribute_page=' . $attribute_page, 'NONSSL') . '">';?><?=tep_image(DIR_IMAGES . 'button_cancel.gif', '50', '14', '0', IMAGE_CANCEL);?></a>&nbsp;</b></font></td>
          </tr>
<?
    } else {
?>
            <td nowrap><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=$attributes_values["products_attributes_id"];?>&nbsp;</font></td>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=$products_name_only;?>&nbsp;</font></td>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=$options_name;?>&nbsp;</font></td>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=$values_name;?>&nbsp;</font></td>
            <td align="right"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=$attributes_values["options_values_price"];?>&nbsp;</font></td>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=$attributes_values["price_prefix"];?>&nbsp;</font></td>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?='<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=update_attribute&attribute_id=' . $attributes_values['products_attributes_id'] . '&attribute_page=' . $attribute_page, 'NONSSL') . '">';?><?=tep_image(DIR_IMAGES . 'button_modify.gif', '50', '14', '0', IMAGE_MODIFY);?></a>&nbsp;&nbsp;<?='<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_product_attribute&attribute_id=' . $attributes_values['products_attributes_id'] . '&attribute_page=' . $attribute_page, 'NONSSL') , '">';?><?=tep_image(DIR_IMAGES . 'button_delete.gif', '50', '14', '0', IMAGE_DELETE);?></a>&nbsp;</font></td>
          </tr>
<?
    }
        $max_attributes_id_query = tep_db_query("select max(products_attributes_id) + 1 as next_id from products_attributes");
        $max_attributes_id_values = tep_db_fetch_array($max_attributes_id_query);
        $next_id = $max_attributes_id_values['next_id'];
  }
?>
          <tr>
            <td colspan="7"><?=tep_black_line();?></td>
          </tr>
<?
  if (!$HTTP_GET_VARS['action'] == 'update_attribute') {
    if (floor($rows/2) == ($rows/2)) {
      echo '          <tr bgcolor="#f4f7fd">' . "\n";
    } else {
      echo '          <tr bgcolor="#ffffff">' . "\n";
    }
    echo '<form name="attributes" action="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=add_product_attributes', 'NONSSL') . '" method="post" onSubmit="return checkFormAtrib();">';
?>
            <td nowrap><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=$next_id;?>&nbsp;</font></td>
	    <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<select name="products_id"><?
    $products = tep_db_query("select products_id, products_name from products order by products_name");
    while ($products_values = tep_db_fetch_array($products)) {
      echo '<option name="' . $products_values['products_name'] . '" value="' . $products_values['products_id'] . '">' . $products_values['products_name'] . '</option>';
    } ?></select>&nbsp;</font></td>
	        <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<select name="options_id"><?
    $options = tep_db_query("select * from products_options order by products_options_name");
    while ($options_values = tep_db_fetch_array($options)) {
      echo '<option name="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '">' . $options_values['products_options_name'] . '</option>';
    } ?></select>&nbsp;</font></td>
	        <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<select name="values_id"><?
    $values = tep_db_query("select * from products_options_values order by products_options_values_name");
    while ($values_values = tep_db_fetch_array($values)) {
      echo '<option name="' . $values_values['products_options_values_name'] . '" value="' . $values_values['products_options_values_id'] . '">' . $values_values['products_options_values_name'] . '</option>';
    } ?></select>&nbsp;</font></td>
            <td align="right"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<input type="text" name="value_price" size="6">&nbsp;</font></td>
            <td align="right"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<input type="text" name="price_prefix" size="2" value="+">&nbsp;</font></td>
            <td align="center"><font face="<?=SMALL_TEXT_FONT_FACE;?>" size="<?=SMALL_TEXT_FONT_SIZE;?>" color="<?=SMALL_TEXT_FONT_COLOR;?>">&nbsp;<?=tep_image_submit(DIR_IMAGES . 'button_insert.gif', '50', '14', '0', IMAGE_INSERT);?>&nbsp;</font></td>
</form>
          </tr>
          <tr>
            <td colspan="7"><?=tep_black_line();?></td>
          </tr>
<?
  }
?>
        </table></td>
      </tr>
    </table></td>
<!-- products_attributes_eof //-->	
<!-- body_text_eof //-->

<!-- footer //-->
<? $include_file = DIR_INCLUDES . 'footer.php';  include(DIR_INCLUDES . 'include_once.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<? $include_file = DIR_INCLUDES . 'application_bottom.php'; include(DIR_INCLUDES . 'include_once.php'); ?>
