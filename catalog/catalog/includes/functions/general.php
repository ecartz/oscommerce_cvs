<?php
/*
  $Id: general.php,v 1.100 2001/06/09 18:49:37 hpdl Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2000,2001 The Exchange Project

  Released under the GNU General Public License
*/

  function tep_exit() {
    if (EXIT_AFTER_REDIRECT == true) {
     tep_session_close();
     return exit();
    }
  }

////
// Error message wrapper
// When optional parameters are provided, it closes the application
// (ie, halts the current application execution task)
  function tep_error_message($error_message, $close_application = false, $close_application_error = '') {
    echo $error_message;

    if ($close_application) {
      die($close_application_error);
    }
  }

  function tep_random_select($db_query) {
    $random_product = '';
    $select_products = tep_db_query($db_query);
    srand((double)microtime()*1000000); // seed the random number generator
    $num_rows = tep_db_num_rows($select_products);
    if ($num_rows != 0) {
      $random_row = @rand(0, ($num_rows - 1));
      tep_db_data_seek($select_products, $random_row);
      $random_product = tep_db_fetch_array($select_products);
    }
    return $random_product;
  }

// Check  & Update Stock
// Check Stock function

 function check_stock ($ident, $qtd) {
  global $qtd_stock, $out_of_stock, $any_out_of_stock;

        $qtd_stock_query = tep_db_query("select products_quantity from " . TABLE_PRODUCTS . " where products_id like '$ident'");
        $stock = tep_db_fetch_array($qtd_stock_query);
        $qtd_stock = $stock['products_quantity'];
        $qtd_buy =  ($qtd);
        $qtd_left = ($qtd_stock -= $qtd_buy);

        if ($qtd_left <= '-1') {

        $qtd_stock_query = tep_db_query("select products_quantity from " . TABLE_PRODUCTS . " where products_id like '$ident'");
        $stock = tep_db_fetch_array($qtd_stock_query);
        $qtd_stock = $stock['products_quantity'];

        $out_of_stock = "<font size=1 color=crimson face=verdana><small>***</small></font>";
        $any_out_of_stock = "YES";

        } else {
        $out_of_stock = "";
        }

return $out_of_stock;
return $any_out_of_stock;

}
// End Check Stock

  function tep_break_string($string, $len) {
    $l = 0;
    $output = '';
    for ($i = 0; $i < strlen($string); $i++) {
      $char = substr($string, $i, 1);
      if ($char != ' ') {
        $l++;
      } else {
        $l = 0;
      }
      if ($l == $len) {
        $l = 0;
        $output .= '- ';
      }
      $output .= $char;
    }

    return $output;
  }

  function tep_in_array($lookup_value, $lookup_array) {
    if (function_exists('in_array')) {
      if (in_array($lookup_value, $lookup_array)) return true;
    } else {
      reset($lookup_array);
      while (list($key, $value) = each($lookup_array)) {
        if ($value == $lookup_value) return true;
      }
    }

    return false;
  }

  function tep_get_all_get_params($exclude_array = '') {
    global $HTTP_GET_VARS;

    if ($exclude_array == '') $exclude_array = array();

    $get_url = '';

    if (is_array($HTTP_GET_VARS)) {
      reset($HTTP_GET_VARS);
      while (list($key, $value) = each($HTTP_GET_VARS)) {
        if (($key != session_name()) && ($key != 'error') && (!tep_in_array($key, $exclude_array))) $get_url .= $key . '=' . rawurlencode(StripSlashes($value)) . '&';
      }
    }

    return $get_url;
  }

  function tep_get_countries($countries_id = '', $iso = '') {

    $list = array();
    if ($countries_id == '') {
      $countries = tep_db_query("select countries_id, countries_name from " . TABLE_COUNTRIES . " order by countries_name");
      while ($countries_values = tep_db_fetch_array($countries)) {
        $list[] = array('countries_id' => $countries_values['countries_id'], 'countries_name' => $countries_values['countries_name']);
      }
    } else {
      if ($iso = '1') {
        $countries = tep_db_query("select countries_name, countries_iso_code_2, countries_iso_code_3 from " . TABLE_COUNTRIES . " where countries_id = '" . $countries_id . "'");
        $countries_values = tep_db_fetch_array($countries);
        $list = array('countries_name' => $countries_values['countries_name'], 'countries_iso_code_2' => $countries_values['countries_iso_code_2'], 'countries_iso_code_3' => $countries_values['countries_iso_code_3']);
      } else {
        $countries = tep_db_query("select countries_name from " . TABLE_COUNTRIES . " where countries_id = '" . $countries_id . "'");
        $countries_values = tep_db_fetch_array($countries);
        $list = array('countries_name' => $countries_values['countries_name']);
      }
    }

    return $list;
  }

  function tep_get_countries_iso($countries_id) {
    return tep_get_countries($countries_id, '1');
  }

  function tep_get_path($current_category_id = '') {
    global $cPath_array;

    if ($current_category_id == '') {
      $cPath_new = implode('_', $cPath_array);
    } else {
      if (sizeof($cPath_array) == 0) {
        $cPath_new = $current_category_id;
      } else {
        $cPath_new = '';
        $last_category_query = tep_db_query("select parent_id from " . TABLE_CATEGORIES . " where categories_id = '" . $cPath_array[(sizeof($cPath_array)-1)] . "'");
        $last_category = tep_db_fetch_array($last_category_query);
        $current_category_query = tep_db_query("select parent_id from " . TABLE_CATEGORIES . " where categories_id = '" . $current_category_id . "'");
        $current_category = tep_db_fetch_array($current_category_query);
        if ($last_category['parent_id'] == $current_category['parent_id']) {
          for ($i=0; $i<(sizeof($cPath_array)-1); $i++) {
            $cPath_new .= '_' . $cPath_array[$i];
          }
        } else {
          for ($i=0; $i<sizeof($cPath_array); $i++) {
            $cPath_new .= '_' . $cPath_array[$i];
          }
        }
        $cPath_new .= '_' . $current_category_id;
        if (substr($cPath_new, 0, 1) == '_') {
          $cPath_new = substr($cPath_new, 1);
        }
      }
    }

    return 'cPath=' . $cPath_new;
  }

  function tep_array_reverse($array) {
    if (function_exists('array_reverse')) {
      $array_reversed = array_reverse($array);
    } else {
      for($i=0; $i<sizeof($array); $i++) $array_reversed[$i] = $array[(sizeof($array)-$i-1)];
    }
    return $array_reversed;
  }

  function tep_browser_detect($component) {
    global $HTTP_USER_AGENT;
    $result = stristr($HTTP_USER_AGENT,$component);
    return $result;
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : tep_get_country_name
  //
  // Arguments   : country        country code string
  //
  // Return      : none
  //
  // Description : Function to retrieve the country name
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function tep_get_country_name($country) {

    $country_query = tep_db_query("select countries_name from " . TABLE_COUNTRIES . " where countries_id = '" . $country . "'");

    if (!tep_db_num_rows($country_query)) {
      $country_name = $country;
    }
    else {
      $country_values = tep_db_fetch_array($country_query);
      $country_name = $country_values['countries_name'];
    }

    return $country_name;

  }

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : tep_get_zone_name
  //
  // Arguments   : country           country code string
  //               zone              state/province zone_id
  //               def_state         default string if zone==0
  //
  // Return      : state_prov_name   state/province name
  //
  // Description : Function to retrieve the state/province name
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function tep_get_zone_name($country, $zone, $def_state) {

    $state_prov_query = tep_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . $country . "' and zone_id = '" . $zone . "'");

    if (!tep_db_num_rows($state_prov_query)) {
      $state_prov_name = $def_state;
    }
    else {
      $state_prov_values = tep_db_fetch_array($state_prov_query);
      $state_prov_name = $state_prov_values['zone_name'];
    }

    return $state_prov_name;
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : tep_get_zone_code
  //
  // Arguments   : country           country code string
  //               zone              state/province zone_id
  //               def_state         default string if zone==0
  //
  // Return      : state_prov_code   state/province code
  //
  // Description : Function to retrieve the state/province code (as in FL for Florida etc)
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function tep_get_zone_code($country, $zone, $def_state) {

    $state_prov_query = tep_db_query("select zone_code from " . TABLE_ZONES . " where zone_country_id = '" . $country . "' and zone_id = '" . $zone . "'");

    if (!tep_db_num_rows($state_prov_query)) {
      $state_prov_code = $def_state;
    }
    else {
      $state_prov_values = tep_db_fetch_array($state_prov_query);
      $state_prov_code = $state_prov_values['zone_code'];
    }

    return $state_prov_code;
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : tep_get_tax_rate
  //
  // Arguments   : tax_zone_id, tax_class_id
  //
  // Return      : tax_rate DECIMAL
  //
  // Description : Function to retrieve the tax rate for a given zone/product_class
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function tep_get_tax_rate($zone, $class) {
    $tax_query = tep_db_query("select tax_rate from " . TABLE_TAX_RATES . " where tax_zone_id = '" . $zone . "' and tax_class_id = '" . $class . "'");

    $tax = TAX_VALUE;
    if (tep_db_num_rows($tax_query)) {
      $tax_values = tep_db_fetch_array($tax_query);
      $tax = $tax_values['tax_rate'];
    }
    return $tax;
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : tep_get_tax_description
  //
  // Arguments   : tax_zone_id, tax_class_id
  //
  // Return      : tax_description string
  //
  // Description : Function to retrieve the tax decription for a given zone/product_class
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function tep_get_tax_description($zone, $class) {
    $tax_query = tep_db_query("select tax_description from " . TABLE_TAX_RATES . " where tax_zone_id = '" . $zone . "' and tax_class_id = '" . $class . "'");

    $tax_des = "Unknown Tax Rate";
    if (tep_db_num_rows($tax_query)) {
      $tax_values = tep_db_fetch_array($tax_query);
      $tax_des = $tax_values['tax_description'];
    }
    return $tax_des;
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : tep_count_products_in_category
  //
  // Arguments   : catetories_id          catetories_id to count products for
  //               include_deactivated    1=includes deactivated products, 0=excludes (default)
  //
  // Return      : products count
  //
  // Description : Function to count products in a category including all child categories
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function tep_count_products_in_category($categories_id, $include_deactivated = false) {
    $products_count = 0;

    if ($include_deactivated) {
      $total_products = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = p2c.products_id and p2c.categories_id = '" . $categories_id . "'");
    } else {
      $total_products = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = p2c.products_id and p.products_status = 1 and p2c.categories_id = '" . $categories_id . "'");
    }

    $total_products_values = tep_db_fetch_array($total_products);

    $products_count += $total_products_values['total'];

    if (USE_RECURSIVE_COUNT) {
      $child_categories = tep_db_query("select categories_id from " . TABLE_CATEGORIES . " where parent_id = '" . $categories_id . "'");
      if (tep_db_num_rows($child_categories)) {
        while ($child_categories_values = tep_db_fetch_array($child_categories)) {
          $products_count += tep_count_products_in_category($child_categories_values['categories_id'], $include_deactivated);
        }
      }
    }

    return $products_count;
  }

// return true if the current category has subcategories
  function tep_has_category_subcategories($category_id) {
    $child_category_query = tep_db_query("select count(*) as count from " . TABLE_CATEGORIES . " where parent_id = '" . $category_id . "'");
    $child_category = tep_db_fetch_array($child_category_query);

    if ($child_category['count'] > 0) {
      return true;
    } else {
      return false;
    }
  }

//////////////////////////////////////////////////////////////////////////////////////////
//
// Function        : tep_get_address_format_id
//
// Arguments        : country_id
//
// Return        : address_format_id
//
// Description        : For a given Countries_id return the address_format_id for that country
//
//////////////////////////////////////////////////////////////////////////////////////////

function tep_get_address_format_id($country_id)
{
  $format = tep_db_query("select address_format_id as format_id from " . TABLE_COUNTRIES . " where countries_id = '" . $country_id . "'");
  $format_values = tep_db_fetch_array($format);
  $fmt_id = $format_values['format_id'];
  if (!$fmt_id) $fmt_id = '1';
  return $fmt_id;
}
//////////////////////////////////////////////////////////////////////////////////////////
//
// Function        : tep_format_address
//
// Arguments        : customers_id, address_id, html
//
// Return        : properly formatted address
//
// Description        : This function will lookup the Addres format from the countries database
//                  and properly format the address label.
//
//////////////////////////////////////////////////////////////////////////////////////////

function tep_address_format($format_id, $delivery_values, $html, $boln, $eoln) {
  $format = tep_db_query("select address_format as format from " . TABLE_ADDRESS_FORMAT . " where address_format_id = '" . $format_id . "'");
  $format_values = tep_db_fetch_array($format);
  $firstname = addslashes($delivery_values['firstname']);
  $lastname = addslashes($delivery_values['lastname']);
  $street = addslashes($delivery_values['street_address']);
  $suburb = addslashes($delivery_values['suburb']);
  $city = addslashes($delivery_values['city']);
  $state = addslashes($delivery_values['state']);
  $country_id = $delivery_values['country_id'];
  $zone_id = $delivery_values['zone_id'];
  $postcode = addslashes($delivery_values['postcode']);
  $zip = $postcode;
  $country = tep_get_country_name($country_id);
  $state = tep_get_zone_code($country_id, $zone_id, $state);

  if ($html == 0) { // Text Mode
    $CR = $eoln;
    $cr = $CR;
    $HR = '----------------------------------------';
    $hr = '----------------------------------------';
  } else {
    if ($html == 1) { // HTML Mode
      $HR = '<HR>';
      $hr = '<hr>';
      if ($boln == '' && $eoln == "\n") { // Valu not specified, use rational defaults
        $CR = '<BR>';
        $cr = '<br>';
        $eoln = $cr;
      } else { // Use values supplied
        $CR = $eoln . $boln;
        $cr = $CR;
      }
    }
  }

  $statecomma = '';
  $streets = $street;
  if ($suburb != '') $streets = $street . $cr . $suburb;
  if ($firstname == '') $firstname = addslashes($delivery_values['name']);
  if ($country == '') $country = addslashes($delivery_values['country']);
  if ($state != '') $statecomma = $state . ', ';

  $fmt = $format_values['format'];
  eval("\$address = \"$fmt\";");
  $address = stripslashes($address);
  return $boln . $address . $eoln;
}

function tep_address_label($customers_id, $address_id, $html=0, $boln='', $eoln="\n") {
  if ($address_id == 0) {
    $delivery = tep_db_query("select customers_firstname as firstname, customers_lastname as lastname, customers_street_address as street_address, customers_suburb as suburb, customers_city as city, customers_postcode as postcode, customers_state as state, customers_zone_id as zone_id, customers_country_id as country_id from " . TABLE_CUSTOMERS . " where customers_id = '" . $customers_id . "'");
  } else {
    $delivery = tep_db_query("select entry_firstname as firstname, entry_lastname as lastname, entry_street_address as street_address, entry_suburb as suburb, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where address_book_id = '" . $address_id . "'");
  }
  $delivery_values = tep_db_fetch_array($delivery);
  $format_id = tep_get_address_format_id($delivery_values['country_id']);
  return tep_address_format($format_id, $delivery_values, $html, $boln, $eoln);
}

//////////////////////////////////////////////////////////////////////////////////////////
//
// Function        : tep_address_summary
//
// Arguments        : customers_id, address_id
//
// Return        : properly formatted address summary
//
// Description        : This function will lookup the Addres format from the countries database
//                  and properly format the address summary.
//
//////////////////////////////////////////////////////////////////////////////////////////

function tep_address_summary($customers_id, $address_id) {
  if ($address_id == 0) {
    $delivery = tep_db_query("select customers_suburb as suburb, customers_city as city, customers_state as state, customers_zone_id as zone_id, customers_country_id as country_id from " . TABLE_CUSTOMERS . " where customers_id = '" . $customers_id . "'");
  } else {
    $delivery = tep_db_query("select entry_suburb as suburb, entry_city as city, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where address_book_id = '" . $address_id . "'");
  }
  $delivery_values = tep_db_fetch_array($delivery);
  $country_id = $delivery_values['country_id'];
  $format_id = tep_get_address_format_id($country_id);
  $format = tep_db_query("select address_summary as summary from " . TABLE_ADDRESS_FORMAT . " where address_format_id = '" . $format_id . "'");
  $format_values = tep_db_fetch_array($format);
  $suburb = addslashes($delivery_values['suburb']);
  $city = addslashes($delivery_values['city']);
  $state = addslashes($delivery_values['state']);
  $zone_id = $delivery_values['zone_id'];
  $country = tep_get_country_name($country_id);
  $state = tep_get_zone_code($country_id, $zone_id, $state);

  $fmt = $format_values['summary'];
  eval("\$address = \"$fmt\";");
  $address = stripslashes($address);
  return $address;
}

  function tep_row_number_format($number) {
    if ($number < 10) $number = '0' . $number;

    return $number . '.';
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : tep_display_cat_select
  //
  // Arguments   : select_name      value of the select's "name" attribute
  //               selected         array of categories_ids of category to be selected
  //                                (0=selects blank; when more than one ID is selected
  //                                 the "multiple" attribute will be included)
  //               size             value of the select's "size" attribute
  //               multiple         include/exclude select's "mutliple" attribute
  //                                (0=exclude; 1=include)
  //               blank_text       string for displaying in the first option
  //
  // Return      : products count
  //
  // Description : Function to builds html <select> box for selecting categories
  //
  // Sample call:  To display a drop-down with categories_id '5' selected:
  //                $selected[0] = 5;
  //                display_cat_select("category",$selected);
  //
  //               To display a list box with 10 rows with categories_id '5' and '11' selected:
  //                $selected[0] = 5;
  //                $selected[1] = 11;
  //                display_cat_select("category",$selected, 10);
  //
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function tep_display_cat_select($select_name, $selected, $size=1, $multiple=0, $blank_text="" ) {

    echo "<select name='$select_name' size='$size'";
    if ((sizeof($selected) > 1) || ($multiple == 1)) echo " multiple";
    echo "><option value=\"\"";
    if (tep_in_array(0, $selected)) echo " selected";
    echo ">$blank_text</option>\n";

    $output = '';
    tep_build_cat_options($output,$selected);
    echo $output;
    echo "</select>\n";

  }

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : tep_build_cat_options
  //
  // Arguments   : output       text string of <option>'s
  //               preselected  array of categories_ids that are selected
  //               parent_id    parent_id of current category
  //               indent       string for spaces categories into visual "nest"
  //
  // Return      : products count
  //
  // Description : recursively go through the category tree, starting at a parent, and
  //               drill down, printing options for a selection list box.  preselected
  //               items are marked as being selected
  //
  //               called by tep_display_cat_select()
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function tep_build_cat_options(&$output, $preselected, $parent_id=0, $indent="") {
    global $languages_id;
  
    $sql = tep_db_query("SELECT c.categories_id, cd.categories_name FROM " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd WHERE parent_id = $parent_id and c.categories_id = cd.categories_id and cd.language_id = '" . $languages_id . "' order by sort_order, cd.categories_name");
    while ($cat =  tep_db_fetch_array($sql)) {
      $selected = tep_in_array($cat[categories_id], $preselected) ? " selected"  :  "";
      $output .= "<option value=\"" . $cat['categories_id'] . "\"$selected>$indent" .  $cat['categories_name'] . "</option>\n";

      if ($cat['categories_id'] != $parent_id)
        tep_build_cat_options($output, $preselected, $cat['categories_id'], $indent."&nbsp;&nbsp;");
    }
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : tep_get_subcategories
  //
  // Arguments   : categories   array of categories_ids
  //               parent_id    parent_id of current category
  //
  // Return      : none
  //
  // Description : recursively go through the category tree to retrieve all subcategories' ids
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function tep_get_subcategories(&$categories, $parent_id=0) {

    $sql = tep_db_query("SELECT categories_id FROM " . TABLE_CATEGORIES . " WHERE parent_id = $parent_id");

    while ($cat = tep_db_fetch_array($sql)) {
      $categories[sizeof($categories)] = $cat['categories_id'];

      if ($cat['categories_id'] != $parent_id)
        tep_get_subcategories($categories, $cat['categories_id']);
    }
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : tep_reformat_date_to_yyyymmdd
  //
  // Arguments   : date_to_reformat   date to reformat
  //               format_string      original format string
  //
  // Return      : reformatted date
  //
  // Description : generic function to reformat date to tep date format YYYYMMDD
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function tep_reformat_date_to_yyyymmdd($date_to_reformat, $format_string) {
    $separator_idx = -1;
    $separators = array("-"," ","/",".");
    $month_abbr = array("jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec");
    $format_string = strtolower($format_string);

    for ($i=0; $i<sizeof($separators); $i++) {
      $pos_separator = strpos($format_string, $separators[$i]);
      if ($pos_separator != false) {
        $separator_idx = $i;
        break;
      }
    }

    if ($separator_idx != -1) {
      $format_string_array = explode( $separators[$separator_idx], $format_string );
      $date_to_reformat_array = explode( $separators[$separator_idx], $date_to_reformat );

      for ($i=0; $i<sizeof($format_string_array); $i++) {
        if ($format_string_array[$i] == 'mm' || $format_string_array[$i] == 'mmm')
          $month = $date_to_reformat_array[$i];
        if ($format_string_array[$i] == 'dd')
          $day = $date_to_reformat_array[$i];
        if ($format_string_array[$i] == 'yyyy')
          $year = $date_to_reformat_array[$i];
      }
    }
    else {
      $pos_month = strpos($format_string, 'mmm');
      if ($pos_month != false) {
        $month = substr( $date_to_reformat, $pos_month, 3 );
        for ($i=0; $i<sizeof($month_abbr); $i++) {
          if ($month == $month_abbr[$i]) {
            $month = $i;
            break;
          }
        }
      }
      else {
        $month = substr( $date_to_reformat, strpos($format_string, 'mm'), 2 );
      }

      $day = substr( $date_to_reformat, strpos($format_string, 'dd'), 2 );
      $year = substr( $date_to_reformat, strpos($format_string, 'yyyy'), 2 );
    }

    return sprintf ("%04d%02d%02d", $year, $month, $day);
  }

  function tep_date_long($raw_date) {
    $date_formated = strftime(DATE_FORMAT_LONG, mktime(0,0,0,substr($raw_date, 4, 2),substr($raw_date, 6, 2),substr($raw_date, 0, 4)));

    return $date_formated;
  }

  function tep_date_short($raw_date) {
    $date_formated = strftime(DATE_FORMAT_SHORT, mktime(0,0,0,substr($raw_date, 4, 2),substr($raw_date, 6, 2),substr($raw_date, 0, 4)));

    return $date_formated;
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : tep_parse_search_string
  //
  // Arguments   : search_str   search string to be parsed into individual objects
  //               objects      parsed objects
  //
  // Return      : true         valid search string
  //               false        invalid search string
  //
  // Description : Function to parse search string into individual objects
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function tep_parse_search_string( $search_str = "", &$objects ) {
    $search_str = strtolower($search_str);

    //--- Break up $search_str on whitespace; quoted string will be reconstructed later ---
    $pieces = split ( "[[:space:]]+", $search_str );

    $objects = array();
    $tmpstring="";
    $flag = "";

    for ( $k=0; $k<count($pieces); $k++ ) {

      while ( substr($pieces[$k], 0, 1) == '(' )  {
          $objects[] = '(';
          if (strlen( $pieces[$k] ) > 1)
            $pieces[$k] = substr( $pieces[$k], 1 );
          else
            $pieces[$k] = '';
      }

      $post_objects = array();

      while ( substr($pieces[$k], -1) == ')' )  {
          $post_objects[] = ')';
          if (strlen( $pieces[$k] ) > 1)
            $pieces[$k] = substr( $pieces[$k], 0, -1 );
          else
            $pieces[$k] = '';
      }

      //--- Check individual words ---

      if ( ( substr($pieces[$k], -1) != '"' ) && ( substr($pieces[$k], 0, 1) != '"' ) ) {
        $objects[] = trim($pieces[$k]);

        for ( $j=0; $j<count($post_objects); $j++ ) {
          $objects[] = $post_objects[$j];
        }
      }
      else {
        //----------------------------------------------------------------------------------
        // This means that the $piece is either the beginning or the end of a string.
        // So, we'll slurp up the $pieces and stick them together until we get to the
        // end of the string or run out of pieces.
        //----------------------------------------------------------------------------------

        //--- Make sure the $tmpstring is empty ---
        $tmpstring = "";

        //--- Add this word to the $tmpstring, starting the $tmpstring ---

        $tmpstring .= trim ( ereg_replace( '"', " ", $pieces[$k] ) );

        //- Check for one possible exception to the rule. That there is a single quoted word.
        if ( substr($pieces[$k], -1 ) == '"' ) {
          //--- Turn the flag off for future iterations ---
          $flag = "off";

          $objects[] = trim($pieces[$k]);

          for ( $j=0; $j<count($post_objects); $j++ ) {
            $objects[] = $post_objects[$j];
          }

          unset ( $tmpstring );

          //--- Stop looking for the end of the string and move onto the next word. ---
          continue;
        }

        //----------------------------------------------------------------------------------
        // Otherwise, turn on the flag to indicate no quotes have been found attached to
        // this word in the string.
        //----------------------------------------------------------------------------------
        $flag = "on";

        //--- Move on to the next word ---
        $k++;

        //--- Keep reading until the end of the string as long as the $flag is on ---

        while ( $flag == "on" && ( $k < count( $pieces ) ) ) {
          while ( substr($pieces[$k], -1) == ')' )  {
              $post_objects[] = ')';
              if (strlen( $pieces[$k] ) > 1)
                $pieces[$k] = substr( $pieces[$k], 0, -1 );
              else
                $pieces[$k] = '';
          }

          //--- If the word doesn't end in double quotes, append it to the $tmpstring. ---
          if ( substr($pieces[$k], -1) != '"' ) {
            //--- Tack this word onto the current string entity ---
            $tmpstring .= " $pieces[$k]";

            //--- Move on to the next word ---
            $k++;
            continue;
          }
          else {
            //------------------------------------------------------------------------------
            // If the $piece ends in double quotes, strip the double quotes, tack the
            // $piece onto the tail of the string, push the $tmpstring onto the $haves,
            // kill the $tmpstring, turn the $flag "off", and return.
            //------------------------------------------------------------------------------
            $tmpstring .= " ".trim ( ereg_replace( '"', " ", $pieces[$k] ) );

            //--- Push the $tmpstring onto the array of stuff to search for ---
            $objects[] = trim($tmpstring);

            for ( $j=0; $j<count($post_objects); $j++ ) {
              $objects[] = $post_objects[$j];
            }

            unset ( $tmpstring );

            //--- Turn off the flag to exit the loop ---
            $flag = "off";
          }
        }
      }
    }

    // add default logical operators if needed
    $temp = array();
    for($i=0; $i<(count($objects)-1); $i++) {
      $temp[sizeof($temp)] = $objects[$i];

      if ( $objects[$i] != 'and' &&
           $objects[$i] != 'or'  &&
           $objects[$i] != '('   &&
           $objects[$i] != ')'   &&
           $objects[$i+1] != 'and' &&
           $objects[$i+1] != 'or'  &&
           $objects[$i+1] != '('   &&
           $objects[$i+1] != ')' ) {
        $temp[sizeof($temp)] = ADVANCED_SEARCH_DEFAULT_OPERATOR;
      }
    }
    $temp[sizeof($temp)] = $objects[$i];
    $objects = $temp;

    // validate search string
    $test_str = "SELECT ";
    for($i=0; $i<count($objects); $i++) {
      switch ($objects[$i]) {
        case 'and':
          $test_str .= " && ";
          break;
        case 'or':
          $test_str .= " || ";
          break;
        case '(':
        case ')':
          $test_str .= $objects[$i];
          break;
        default:
          $test_str .= "1";
          break;
      }
    }

    if (tep_db_query($test_str))
      return true;
    else
      return false;
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : tep_checkdate
  //
  // Arguments   : date_to_check      date to be checked
  //               format_string      format string
  //
  // Return      : true               is a valid date
  //               false              not a valid date
  //
  // Description : generic function to check date
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function tep_checkdate($date_to_check, $format_string, &$date_array) {
    $separator_idx = -1;
    $separators = array("-"," ","/",".");
    $month_abbr = array("jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec");
    $no_of_days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

    $format_string = strtolower($format_string);

    if (strlen($date_to_check) != strlen($format_string)) {
      return false;
    }

    for ($i=0; $i<sizeof($separators); $i++) {
      $pos_separator = strpos($date_to_check, $separators[$i]);
      if ($pos_separator != false) {
        $date_separator_idx = $i;
        break;
      }
    }

    for ($i=0; $i<sizeof($separators); $i++) {
      $pos_separator = strpos($format_string, $separators[$i]);
      if ($pos_separator != false) {
        $format_separator_idx = $i;
        break;
      }
    }

    if ($date_separator_idx != $format_separator_idx) {
      return false;
    }


    if ($date_separator_idx != -1) {
      $format_string_array = explode( $separators[$date_separator_idx], $format_string );
      if (sizeof($format_string_array) != 3) {
        return false;
      }

      $date_to_check_array = explode( $separators[$date_separator_idx], $date_to_check );
      if (sizeof($date_to_check_array) != 3) {
        return false;
      }

      for ($i=0; $i<sizeof($format_string_array); $i++) {
        if ($format_string_array[$i] == 'mm' || $format_string_array[$i] == 'mmm')
          $month = $date_to_check_array[$i];
        if ($format_string_array[$i] == 'dd')
          $day = $date_to_check_array[$i];
        if ($format_string_array[$i] == 'yyyy')
          $year = $date_to_check_array[$i];
      }
    }
    else {
      if (strlen($format_string) == 8 || strlen($format_string) == 9) {
        $pos_month = strpos($format_string, 'mmm');
        if ($pos_month != false) {
          $month = substr( $date_to_check, $pos_month, 3 );
          for ($i=0; $i<sizeof($month_abbr); $i++) {
            if ($month == $month_abbr[$i]) {
              $month = $i;
              break;
            }
          }
        }
        else {
          $month = substr( $date_to_check, strpos($format_string, 'mm'), 2 );
        }
      }
      else {
        return false;
      }

      $day = substr( $date_to_check, strpos($format_string, 'dd'), 2 );
      $year = substr( $date_to_check, strpos($format_string, 'yyyy'), 4 );
    }

    if (strlen($year) != 4) {
      return false;
    }

    if (!settype($year, "integer") || !settype($month, "integer") || !settype($day, "integer")) {
      return false;
    }

    if ($month > 12 || $month < 1) {
      return false;
    }

    if ($day < 1) {
      return false;
    }

    if (tep_is_leap_year($year)) {
      $no_of_days[1] = 29;
    }

    if ($day > $no_of_days[$month - 1]) {
      return false;
    }

    $date_array = array($year, $month, $day);

    return true;
  }

  function tep_is_leap_year($year) {
    if ($year % 100 == 0) {
      if ($year % 400 == 0)
        return true;
    }
    else {
      if (($year % 4) == 0)
        return true;
    }

    return false;
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : tep_create_sort_heading
  //
  // Arguments   : sortby       current sort by flag
  //               colnum       current column number
  //               heading      heading to be display
  //
  // Return      : string for displaying in product listing heading
  //
  // Description : generic function to create heading with sorting capabilities
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function tep_create_sort_heading($sortby, $colnum, $heading) {
    global $PHP_SELF;
    $sort_prefix = "";
    $sort_suffix = "";

    if ($sortby) {
      $sort_prefix = '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('page', 'info', 'x', 'y', 'sort')) . 'page=1&sort=' . $colnum . ($sortby == $colnum . 'a' ? 'd' : 'a'), 'NONSSL') . '" title="' . TEXT_SORT_PRODUCTS . ($sortby == $colnum . 'd' || substr($sortby, 0, 1) != $colnum ? TEXT_ASCENDINGLY : TEXT_DESCENDINGLY) . TEXT_BY . $heading . '">' ;
      $sort_suffix = (substr($sortby, 0, 1) == $colnum ? (substr($sortby, 1, 1) == 'a' ? '+' : '-') : '') . '</a>';
    }

    return $sort_prefix . $heading . $sort_suffix;
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : tep_get_parent_categories
  //
  // Arguments   : categories       array of categories_ids
  //               categories_id    categories_id of current category
  //
  // Return      : none
  //
  // Description : recursively go through the category tree to retrieve all parent categories' ids
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function tep_get_parent_categories(&$categories, $categories_id) {
    $sql = tep_db_query("SELECT parent_id FROM " . TABLE_CATEGORIES . " WHERE categories_id = $categories_id");

    while ($cat = tep_db_fetch_array($sql)) {
      if ($cat['parent_id'] == 0)
        return;
      $categories[sizeof($categories)] = $cat['parent_id'];
      if ($cat['parent_id'] != $categories_id)
        tep_get_parent_categories($categories, $cat['parent_id']);
    }
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : tep_get_product_path
  //
  // Arguments   : products_id    id of the product
  //
  // Return      : cPath of the product
  //
  // Description : recursively go through the category tree to retrieve all parent
  //               categories' ids of the product and construct the cPath
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function tep_get_product_path($products_id) {
    $cPath = "";

    $cat_count_sql = tep_db_query("SELECT COUNT(*) as count FROM " . TABLE_PRODUCTS_TO_CATEGORIES . " WHERE products_id = $products_id");
    $cat_count_data = tep_db_fetch_array($cat_count_sql);

    if ($cat_count_data['count'] == 1) {
      $categories = array();

      $cat_id_sql = tep_db_query("SELECT categories_id FROM " . TABLE_PRODUCTS_TO_CATEGORIES . " WHERE products_id = $products_id");
      $cat_id_data = tep_db_fetch_array($cat_id_sql);
      tep_get_parent_categories($categories, $cat_id_data['categories_id']);

      for ($i=sizeof($categories)-1; $i>=0; $i--) {
        if ($cPath != "")
          $cPath .= "_";
        $cPath .= $categories[$i];
      }
      if ($cPath != "")
        $cPath .= "_";
      $cPath .= $cat_id_data['categories_id'];
    }

    return $cPath;
  }

  function tep_get_uprid($prid, $params) {
    $uprid = $prid;
    if ( (is_array($params)) && (!strstr($prid, '{')) ) {
      while (list($option, $value) = each($params)) {
        $uprid = $uprid . '{' . $option . '}' . $value;
      }
    }

    return $uprid;
  }

  function tep_get_prid($uprid) {
    $pieces = split('[{]', $uprid, 2);

    return $pieces[0];
  }

  function tep_customer_greeting() {
    global $HTTP_COOKIE_VARS, $customer_id, $customer_first_name;

    if ($HTTP_COOKIE_VARS['first_name']) {
      $first_name = $HTTP_COOKIE_VARS['first_name'];
    } elseif ($customer_first_name) {
      $first_name = $customer_first_name;
    }

    if ($first_name) {
      $greeting_string = sprintf(TEXT_GREETING_PERSONAL, $first_name);
      if (!$customer_id) {
        $greeting_string .= '<br>' . sprintf(TEXT_GREETING_PERSONAL_RELOGON, $first_name, tep_href_link(FILENAME_LOGIN, '', 'NONSSL'));
      }
    } else {
      $greeting_string = sprintf(TEXT_GREETING_GUEST, tep_href_link(FILENAME_LOGIN, '', 'NONSSL'), tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'NONSSL'));
    }

    return $greeting_string;
  }

////
// Send email
  function tep_mail($to, $subject, $message, $additional_headers = '') {
    if (mail($to, $subject, $message, $additional_headers)) {
      return true;
    } else {
      return tep_error_message(ERROR_TEP_MAIL);
    }
  }

////
// Check if product has attributes
  function tep_has_product_attributes($products_id) {
    $attributes_query = tep_db_query("select count(*) as count from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . $products_id . "'");
    $attributes = tep_db_fetch_array($attributes_query);

    if ($attributes['count'] > 0) {
      return true;
    } else {
      return false;
    }
  }
?>
