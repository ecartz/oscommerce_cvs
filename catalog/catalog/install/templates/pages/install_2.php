<?php
/*
  $Id: install_2.php,v 1.2 2002/01/04 01:38:09 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/
?>
<p><span class="pageHeading">osCommerce</span><br><font color="#9a9a9a">Open Source E-Commerce Solutions</font></p>

<p class="pageTitle">New Install</p>

<p><b>Step 1: Database Import</b></p>

<?php
  if (osc_in_array('database', $HTTP_POST_VARS['install'])) {
    $db = array();
    $db['DB_SERVER'] = trim(stripslashes($HTTP_POST_VARS['DB_SERVER']));
    $db['DB_SERVER_USERNAME'] = trim(stripslashes($HTTP_POST_VARS['DB_SERVER_USERNAME']));
    $db['DB_SERVER_PASSWORD'] = trim(stripslashes($HTTP_POST_VARS['DB_SERVER_PASSWORD']));
    $db['DB_DATABASE'] = trim(stripslashes($HTTP_POST_VARS['DB_DATABASE']));

    $db_error = false;
    osc_db_connect($db['DB_SERVER'], $db['DB_SERVER_USERNAME'], $db['DB_SERVER_PASSWORD']);

    if (!$db_error) {
      osc_db_test_create_db_permission($db['DB_DATABASE']);
    }

    if ($db_error) {
?>

<p>A test connection made to the database was NOT successful.</p>

<p>The error message returned is:</p>

<p class="boxme"><?php echo $db_error; ?></p>

<p>Please click on the <i>Back</i> graphic to review your database server settings.</p>

<p>If you require help with your database server settings, please consult your hosting company.</p>

<form name="install" action="install.php" method="post">

<?php
      reset($HTTP_POST_VARS);
      while (list($key, $value) = each($HTTP_POST_VARS)) {
        if ($key != 'x' && $key != 'y') {
          if (is_array($value)) {
            for ($i=0; $i<sizeof($value); $i++) {
              echo osc_draw_hidden_field($key . '[]', $value[$i]);
            }
          } else {
            echo osc_draw_hidden_field($key, $value);
          }
        }
      }
?>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><a href="index.php"><img src="images/button_cancel.gif" border="0" alt="Cancel"></a></td>
    <td align="center"><input type="image" src="images/button_back.gif" border="0" alt="Back"></td>
  </tr>
</table>

</form>
<?php
    } else {
?>

<p>A test connection made to the database was successful.</p>

<p>Please continue the installation process to execute the database import procedure.</p>

<p>It is important this procedure is not interrupted, otherwise the database may end up corrupt.</p>

<p>The file to import must be located and named at: <b><?php echo $HTTP_POST_VARS['DIR_FS_DOCUMENT_ROOT'] . $HTTP_POST_VARS['DIR_WS_CATALOG'] . 'install/oscommerce.sql'; ?></b>.</p>

<form name="install" action="install.php?step=3" method="post">

<?php
      reset($HTTP_POST_VARS);
      while (list($key, $value) = each($HTTP_POST_VARS)) {
        if ($key != 'x' && $key != 'y') {
          if (is_array($value)) {
            for ($i=0; $i<sizeof($value); $i++) {
              echo osc_draw_hidden_field($key . '[]', $value[$i]);
            }
          } else {
            echo osc_draw_hidden_field($key, $value);
          }
        }
      }
?>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><a href="index.php"><img src="images/button_cancel.gif" border="0" alt="Cancel"></a></td>
    <td align="center"><input type="image" src="images/button_continue.gif" border="0" alt="Continue"></td>
  </tr>
</table>

</form>


<?php
    }
  }
?>