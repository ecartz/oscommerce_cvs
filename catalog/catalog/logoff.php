<? include('includes/application_top.php'); ?>
<?
  tep_session_unregister('customer_id');
  $cart->reset(FALSE);
  include('includes/counter.php');
  tep_redirect(tep_href_link(FILENAME_DEFAULT, '', 'NONSSL'));
?>
<? $include_file = DIR_WS_INCLUDES . 'application_bottom.php'; include(DIR_WS_INCLUDES . 'include_once.php'); ?>