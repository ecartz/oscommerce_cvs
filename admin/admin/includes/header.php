<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr class="header">
    <td valign="middle"><? echo tep_image(DIR_WS_IMAGES . 'header_exchange_logo.gif', STORE_NAME, '57', '50') . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '6', '1') . tep_image(DIR_WS_IMAGES . 'header_exchange.gif', STORE_NAME, '351', '50'); ?></td>
    <td align="right"><? echo '<a href="http://theexchangeproject.org">' . tep_image(DIR_WS_IMAGES . 'header_support.gif', HEADER_TITLE_SUPPORT_SITE, '50', '50') . '</a>'; ?>&nbsp;&nbsp;<? echo '<a href="' . DIR_WS_CATALOG . FILENAME_DEFAULT . '">' . tep_image(DIR_WS_IMAGES . 'header_checkout.gif', HEADER_TITLE_ONLINE_CATALOG, '53', '50') . '</a>'; ?>&nbsp;&nbsp;<? echo '<a href="' . tep_href_link(FILENAME_DEFAULT, '', 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'header_administration.gif', HEADER_TITLE_ADMINISTRATION, '50', '50') . '</a>'; ?>&nbsp;&nbsp;</td>
  </tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr class="headerNavigation">
    <td class="headerNavigation"><b>&nbsp;&nbsp;<? echo '<a href="' . tep_href_link(FILENAME_DEFAULT, '', 'NONSSL') . '" class="whitelink">' . HEADER_TITLE_TOP . '</a>'; ?></b></td>
    <td class="headerNavigation" align="right"><b><? echo '<a href="http://theexchangeproject.org" class="whitelink">' . HEADER_TITLE_SUPPORT_SITE . '</a>'; ?> &nbsp;|&nbsp; <? echo '<a href="' . DIR_WS_CATALOG . FILENAME_DEFAULT . '" class="whitelink">' . HEADER_TITLE_ONLINE_CATALOG . '</a>'; ?> &nbsp;|&nbsp; <? echo '<a href="' . tep_href_link(FILENAME_DEFAULT, '" class="whitelink"', 'NONSSL') . '">' . HEADER_TITLE_ADMINISTRATION . '</a>'; ?>&nbsp;&nbsp;</b></td>
  </tr>
</table>
