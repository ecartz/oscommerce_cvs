<?
  $include_file = DIR_BOXES . 'shopping_cart.php'; include(DIR_INCLUDES . 'include_once.php');
  $include_file = DIR_BOXES . 'best_sellers.php'; include(DIR_INCLUDES . 'include_once.php');
  $include_file = DIR_BOXES . 'specials.php'; include(DIR_INCLUDES . 'include_once.php');
  $include_file = DIR_BOXES . 'reviews.php'; include(DIR_INCLUDES . 'include_once.php');

  if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
    $include_file = DIR_BOXES . 'languages.php'; include(DIR_INCLUDES . 'include_once.php');
  }

  if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
    $include_file = DIR_BOXES . 'currencies.php'; include(DIR_INCLUDES . 'include_once.php');
  }
?>
