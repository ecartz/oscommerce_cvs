<? include('includes/application_top.php'); ?>
<?
  if ($HTTP_GET_VARS['action']) {
    if ($HTTP_GET_VARS['action'] == 'save') {
      if (EXPERT_MODE) {
        $update_query .= "manufacturers_id = '" . $HTTP_POST_VARS['manufacturers_id'] . "', manufacturers_name = '" . $HTTP_POST_VARS['manufacturers_name'] . "'";
        $new_manufacturers_id = $HTTP_POST_VARS['manufacturers_id'];
      } else {
        $update_query .= "manufacturers_name = '" . $HTTP_POST_VARS['manufacturers_name'] . "'";
        $new_manufacturers_id = $HTTP_POST_VARS['original_manufacturers_id'];
      }
      $error = 0;
      if (tep_db_query("update " . TABLE_MANUFACTURERS . " set " . $update_query . " where manufacturers_id = '" . $HTTP_POST_VARS['original_manufacturers_id'] . "'")) {
        if ($manufacturers_image != 'none') {
          if (tep_db_query("update " . TABLE_MANUFACTURERS . " set manufacturers_image = 'images/" . $manufacturers_image_name . "' where manufacturers_id = '" . $HTTP_POST_VARS['original_manufacturers_id'] . "'")) {
            $image_location = DIR_FS_DOCUMENT_ROOT . DIR_WS_CATALOG_IMAGES . $manufacturers_image_name;
            if (file_exists($image_location)) @unlink($image_location);
            copy($manufacturers_image, $image_location);
          } else {
            $error = 1;
          }
        }
      } else {
        $error = 1;
      }
      if ($error == 0) {
        header('Location: ' . tep_href_link(FILENAME_MANUFACTURERS, tep_get_all_get_params(array('action', 'info')) . 'info=' . $new_manufacturers_id, 'NONSSL'));
        tep_exit();
      } else {
        header('Location: ' . tep_href_link(FILENAME_MANUFACTURERS, tep_get_all_get_params(array('action', 'info')) . 'error=SAVE', 'NONSSL'));
        tep_exit();
      }
    } elseif ($HTTP_GET_VARS['action'] == 'deleteconfirm') {
      if (tep_db_query("delete from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . $HTTP_POST_VARS['manufacturers_id'] . "'")) {
        header('Location: ' . tep_href_link(FILENAME_MANUFACTURERS, tep_get_all_get_params(array('action', 'info')), 'NONSSL'));
        tep_exit();
      } else {
        header('Location: ' . tep_href_link(FILENAME_MANUFACTURERS, tep_get_all_get_params(array('action', 'info')) . 'error=DELETE', 'NONSSL'));
        tep_exit();
      }
    } elseif ($HTTP_GET_VARS['action'] == 'insert') {
      $error = 0;
      if (tep_db_query("insert into " . TABLE_MANUFACTURERS . " (manufacturers_name) values ('" . $HTTP_POST_VARS['manufacturers_name'] . "')")) {
        $manufacturers_id = tep_db_insert_id();
        if ($manufacturers_image != 'none') {
          if (tep_db_query("update " . TABLE_MANUFACTURERS . " set manufacturers_image = 'images/" . $manufacturers_image_name . "' where manufacturers_id = '" . $manufacturers_id . "'")) {
            $image_location = DIR_FS_DOCUMENT_ROOT . DIR_WS_CATALOG_IMAGES . $manufacturers_image_name;
            if (file_exists($image_location)) @unlink($image_location);
            copy($manufacturers_image, $image_location);
          } else {
            $error = 1;
          }
        }
      } else {
        $error = 1;
      }
      if ($error == 0) {
        header('Location: ' . tep_href_link(FILENAME_MANUFACTURERS, tep_get_all_get_params(array('action', 'info')) . 'info=' . $manufacturers_id, 'NONSSL'));
        tep_exit();
      } else {
        header('Location: ' . tep_href_link(FILENAME_MANUFACTURERS, tep_get_all_get_params(array('action', 'info')) . 'error=INSERT', 'NONSSL'));
        tep_exit();
      }
    }
  }
?>
<html>
<head>
<title><? echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
</head>
<body onload="SetFocus();" marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<? $include_file = DIR_WS_INCLUDES . 'header.php';  include(DIR_WS_INCLUDES . 'include_once.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="5" cellpadding="5">
  <tr>
    <td width="<? echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<? echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<!-- left_navigation //-->
<? $include_file = DIR_WS_INCLUDES . 'column_left.php'; include(DIR_WS_INCLUDES . 'include_once.php'); ?>
<!-- left_navigation_eof //-->
        </table></td>
      </tr>
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="boxborder">
          <tr>
            <td bgcolor="<? echo TOP_BAR_BACKGROUND_COLOR; ?>" width="100%" nowrap><font face="<? echo TOP_BAR_FONT_FACE; ?>" size="<? echo TOP_BAR_FONT_SIZE; ?>" color="<? echo TOP_BAR_FONT_COLOR; ?>">&nbsp;<? echo TOP_BAR_TITLE; ?>&nbsp;</font></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td nowrap><font face="<? echo HEADING_FONT_FACE; ?>" size="<? echo HEADING_FONT_SIZE; ?>" color="<? echo HEADING_FONT_COLOR; ?>">&nbsp;<? echo HEADING_TITLE; ?>&nbsp;</font></td>
            <td align="right" nowrap>&nbsp;<? echo tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT, '0', ''); ?>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="2"><? echo tep_black_line(); ?></td>
          </tr>
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td align="center" nowrap><font face="<? echo TABLE_HEADING_FONT_FACE; ?>" size="<? echo TABLE_HEADING_FONT_SIZE; ?>" color="<? echo TABLE_HEADING_FONT_COLOR; ?>"><b>&nbsp;<? echo TABLE_HEADING_ID; ?>&nbsp;</b></font></td>
                <td nowrap><font face="<? echo TABLE_HEADING_FONT_FACE; ?>" size="<? echo TABLE_HEADING_FONT_SIZE; ?>" color="<? echo TABLE_HEADING_FONT_COLOR; ?>"><b>&nbsp;<? echo TABLE_HEADING_MANUFACTURERS; ?>&nbsp;</b></font></td>
                <td align="center" nowrap><font face="<? echo TABLE_HEADING_FONT_FACE; ?>" size="<? echo TABLE_HEADING_FONT_SIZE; ?>" color="<? echo TABLE_HEADING_FONT_COLOR; ?>"><b>&nbsp;<? echo TABLE_HEADING_ACTION; ?>&nbsp;</b></font></td>
              </tr>
              <tr>
                <td colspan="3"><? echo tep_black_line(); ?></td>
              </tr>
<?
  $rows = 0;
  $manufacturers_query_raw = "select manufacturers_id, manufacturers_name, manufacturers_image from " . TABLE_MANUFACTURERS . " order by manufacturers_name";
  $manufacturers_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $manufacturers_query_raw, $manufacturers_query_numrows);
  $manufacturers_query = tep_db_query($manufacturers_query_raw);
  while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
    $rows++;

    if (((!$HTTP_GET_VARS['info']) || (@$HTTP_GET_VARS['info'] == $manufacturers['manufacturers_id'])) && (!$mInfo) && ($HTTP_GET_VARS['action'] != 'new')) {
      $manufacturer_products_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " where manufacturers_id = '" . $manufacturers['manufacturers_id'] . "'");
      $manufacturer_products = tep_db_fetch_array($manufacturer_products_query);

      $mInfo_array = tep_array_merge($manufacturers, $manufacturer_products);
      $mInfo = new manufacturerInfo($mInfo_array);
    }

    if ($manufacturers['manufacturers_id'] == @$mInfo->id) {
      echo '              <tr bgcolor="#b0c8df">' . "\n";
    } else {
      echo '              <tr bgcolor="#d8e1eb" onmouseover="this.style.background=\'#cc9999\';this.style.cursor=\'hand\'" onmouseout="this.style.background=\'#d8e1eb\'" onclick="document.location.href=\'' . tep_href_link(FILENAME_MANUFACTURERS, tep_get_all_get_params(array('info', 'action')) . 'info=' . $manufacturers['manufacturers_id'], 'NONSSL') . '\'">' . "\n";
    }
?>
                <td align="center" nowrap><font face="<? echo SMALL_TEXT_FONT_FACE; ?>" size="<? echo SMALL_TEXT_FONT_SIZE; ?>" color="<? echo SMALL_TEXT_FONT_COLOR; ?>">&nbsp;<? echo $manufacturers['manufacturers_id']; ?>&nbsp;</font></td>
                <td nowrap><font face="<? echo SMALL_TEXT_FONT_FACE; ?>" size="<? echo SMALL_TEXT_FONT_SIZE; ?>" color="<? echo SMALL_TEXT_FONT_COLOR; ?>">&nbsp;<? echo $manufacturers['manufacturers_name']; ?>&nbsp;</font></td>
<?
    if ($manufacturers['manufacturers_id'] == @$mInfo->id) {
?>
                <td align="center" nowrap><font face="<? echo SMALL_TEXT_FONT_FACE; ?>" size="<? echo SMALL_TEXT_FONT_SIZE; ?>" color="<? echo SMALL_TEXT_FONT_COLOR; ?>">&nbsp;<? echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', 13, 13, 0, ''); ?>&nbsp;</font></td>
<?
    } else {
?>
                <td align="center" nowrap><font face="<? echo SMALL_TEXT_FONT_FACE; ?>" size="<? echo SMALL_TEXT_FONT_SIZE; ?>" color="<? echo SMALL_TEXT_FONT_COLOR; ?>">&nbsp;<? echo '<a href="' . tep_href_link(FILENAME_MANUFACTURERS, tep_get_all_get_params(array('info', 'action')) . 'info=' . $manufacturers['manufacturers_id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', '13', '13', '0', IMAGE_ICON_INFO) . '</a>'; ?>&nbsp;</font></td>
<?
    }
?>
              </tr>
<?
  }
?>
              <tr>
                <td colspan="3"><? echo tep_black_line(); ?></td>
              </tr>
              <tr>
                <td colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td nowrap><font face="<? echo SMALL_TEXT_FONT_FACE; ?>" size="<? echo SMALL_TEXT_FONT_SIZE; ?>" color="<? echo SMALL_TEXT_FONT_COLOR; ?>">&nbsp;<? echo $manufacturers_split->display_count($manufacturers_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS); ?>&nbsp;</font></td>
                    <td align="right" nowrap><font face="<? echo SMALL_TEXT_FONT_FACE; ?>" size="<? echo SMALL_TEXT_FONT_SIZE; ?>" color="<? echo SMALL_TEXT_FONT_COLOR; ?>">&nbsp;<? echo TEXT_RESULT_PAGE; ?> <? echo $manufacturers_split->display_links($manufacturers_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page']); ?>&nbsp;</font></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="3"><? echo tep_black_line(); ?></td>
              </tr>
              <tr>
                <td align="right" colspan="3"><font face="<? echo SMALL_TEXT_FONT_FACE; ?>" size="<? echo SMALL_TEXT_FONT_SIZE; ?>" color="<? echo SMALL_TEXT_FONT_COLOR; ?>"><a href="<? echo tep_href_link(FILENAME_MANUFACTURERS, tep_get_all_get_params(array('action')) . 'action=new', 'NONSSL'); ?>"><? echo tep_image(DIR_WS_IMAGES . 'button_insert.gif', '66', '20', '0', IMAGE_INSERT); ?></a>&nbsp;</font></td>
              </tr>
<?
  if ($HTTP_GET_VARS['error']) {
?>
              <tr>
                <td colspan="3"><font face="<? echo SMALL_TEXT_FONT_FACE; ?>" size="<? echo SMALL_TEXT_FONT_SIZE; ?>" color="#ff0000">&nbsp;<? echo ERROR_ACTION; ?>&nbsp;</font></td>
              </tr>
<?
  }
?>
            </table></td>
            <td width="25%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?
  $info_box_contents = array();
  $info_box_contents[] = array('align' => 'left', 'text' => '&nbsp;<b>' . $mInfo->name . '</b>&nbsp;');
?>
              <tr bgcolor="#81a2b6">
                <td>
                  <? new infoBoxHeading($info_box_contents); ?>
                </td>
              </tr>
              <tr bgcolor="#81a2b6">
                <td><? echo tep_black_line(); ?></td>
              </tr>
<?
  if ($HTTP_GET_VARS['action'] == 'new') {
    $form = '<form name="manufacturers" enctype="multipart/form-data" action="' . tep_href_link(FILENAME_MANUFACTURERS, tep_get_all_get_params(array('action')) . 'action=insert', 'NONSSL') . '" method="post">' . "\n";

    $info_box_contents = array();
    $info_box_contents[] = array('align' => 'left', 'text' => TEXT_NEW_INTRO . '<br>&nbsp;');
    $info_box_contents[] = array('align' => 'left', 'text' => '&nbsp;' . TEXT_EDIT_MANUFACTURERS_NAME . '<br>&nbsp;<input type="text" name="manufacturers_name"><br>&nbsp;<br>&nbsp;' . TEXT_EDIT_MANUFACTURERS_IMAGE . '<br>&nbsp;<input type="file" name="manufacturers_image" size="20" style="font-size:10px"><br>&nbsp;<br>&nbsp;');
    $info_box_contents[] = array('align' => 'center', 'text' => tep_image_submit(DIR_WS_IMAGES . 'button_save.gif', '66', '20', '0', IMAGE_SAVE) . '<a href="' . tep_href_link(FILENAME_MANUFACTURERS, tep_get_all_get_params(array('action')), 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'button_cancel.gif', '66', '20', '0', IMAGE_CANCEL) . '</a>');
  } elseif ($HTTP_GET_VARS['action'] == 'edit') {
    $form = '<form name="manufacturers" enctype="multipart/form-data" action="' . tep_href_link(FILENAME_MANUFACTURERS, tep_get_all_get_params(array('action')) . 'action=save', 'NONSSL') . '" method="post"><input type="hidden" name="original_manufacturers_id" value="' . $mInfo->id . '">'  ."\n";

    $info_box_contents = array();
    $info_box_contents[] = array('align' => 'left', 'text' => TEXT_EDIT_INTRO . '<br>&nbsp;');
    if (EXPERT_MODE) $info_box_contents[] = array('align' => 'left', 'text' => '&nbsp;' . TEXT_EDIT_MANUFACTURERS_ID . '<br>&nbsp;<input type="text" name="manufacturers_id" value="' . $mInfo->id . '" size="2"><br>&nbsp;');
    $info_box_contents[] = array('align' => 'left', 'text' => '&nbsp;' . TEXT_EDIT_MANUFACTURERS_NAME . '<br>&nbsp;<input type="text" name="manufacturers_name" value="' . $mInfo->name . '"><br>&nbsp;<br>&nbsp;' . TEXT_EDIT_MANUFACTURERS_IMAGE . '<br>&nbsp;<input type="file" name="manufacturers_image" size="20" style="font-size:10px"><br>' . $mInfo->image . '<br>&nbsp;<br>&nbsp;');
    $info_box_contents[] = array('align' => 'center', 'text' => tep_image_submit(DIR_WS_IMAGES . 'button_save.gif', '66', '20', '0', IMAGE_SAVE) . '<a href="' . tep_href_link(FILENAME_MANUFACTURERS, tep_get_all_get_params(array('action')), 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'button_cancel.gif', '66', '20', '0', IMAGE_CANCEL) . '</a>');
  } elseif ($HTTP_GET_VARS['action'] == 'delete') {
    $form = '<form name="manufacturers" action="' . tep_href_link(FILENAME_MANUFACTURERS, tep_get_all_get_params(array('action')) . 'action=deleteconfirm', 'NONSSL') . '" method="post"><input type="hidden" name="manufacturers_id" value="' . $mInfo->id . '">' . "\n";

    $info_box_contents = array();
    $info_box_contents[] = array('align' => 'left', 'text' => TEXT_DELETE_INTRO . '<br>&nbsp;');
    $info_box_contents[] = array('align' => 'left', 'text' => '&nbsp;<b>' . $mInfo->name . '</b>');
    if ($mInfo->products_count > 0) $info_box_contents[] = array('align' => 'left', 'text' => '<br>' . sprintf(TEXT_DELETE_WARNING_PRODUCTS, $mInfo->products_count));
    $info_box_contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit(DIR_WS_IMAGES . 'button_delete.gif', '66', '20', '0', IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_MANUFACTURERS, tep_get_all_get_params(array('action')), 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'button_cancel.gif', '66', '20', '0', IMAGE_CANCEL) . '</a>');
  } else {
    $info_box_contents = array();
    $info_box_contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_MANUFACTURERS, tep_get_all_get_params(array('action')) . 'action=edit', 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'button_edit.gif', '66', '20', '0', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_MANUFACTURERS, tep_get_all_get_params(array('action')) . 'action=delete', 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'button_delete.gif', '66', '20', '0', IMAGE_DELETE) . '</a>');
    $info_box_contents[] = array('align' => 'left', 'text' => '<br>&nbsp;' . TEXT_DATE_ADDED . '&nbsp;<br>&nbsp;' . TEXT_LAST_MODIFIED);
    $info_box_contents[] = array('align' => 'left', 'text' => '<br>' . tep_info_image($mInfo->image, $mInfo->name));
    $info_box_contents[] = array('align' => 'left', 'text' => '<br>&nbsp;' . TEXT_PRODUCTS . ' ' . $mInfo->products_count);
  }
?>
              <tr bgcolor="#b0c8df"><? echo $form; ?>
                <td>
                  <? new infoBox($info_box_contents); ?>
                </td>
              <? if ($form) echo '</form>'; ?></tr>
              <tr bgcolor="#b0c8df">
                <td><? echo tep_black_line(); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<? $include_file = DIR_WS_INCLUDES . 'footer.php';  include(DIR_WS_INCLUDES . 'include_once.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<? $include_file = DIR_WS_INCLUDES . 'application_bottom.php'; include(DIR_WS_INCLUDES . 'include_once.php'); ?>