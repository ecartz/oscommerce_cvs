<?
/*
English Text for The Exchange Project Administration Tool Preview Release 1.1
Last Update: 12/06/2000
Author(s): Harald Ponce de Leon (hpdl@theexchangeproject.org)
*/

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..
setlocale('LC_TIME', 'en_US.ISO_8859-1');
define('DATE_FORMAT_SHORT', '%m/%d/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

// the CURRENCY_* constants will be used to format the currency to the selected locale.. this will be used with the 
// tep_number_format() function.. although the function is here, it is not in use yet..
define('CURRENCY_BEFORE', '$'); // currency character(s) before value
define('CURRENCY_AFTER', ''); // currency character(s) after value
define('CURRENCY_DECIMAL', '.'); // currency decimal point character
define('CURRENCY_THOUSANDS', ','); // currency thousands separator character
define('CURRENCY_VALUE', 0.9551); // currency value to whats stored in the database(products_price).. this will be set to Euro (not USD)..
// for example:
// products_price = 30.00 (in Euro)
// currency_value = 0.9551 (US to Euro)
// products price with locale currency = currency_value * products_price

// page title
define('TITLE', 'The Exchange Project');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administration');
define('HEADER_TITLE_SUPPORT_SITE', 'Support Site');
define('HEADER_TITLE_ONLINE_DEMO', 'Online Demo');
define('HEADER_TITLE_ADMINISTRATION', 'Administration');

// text for gender
define('MALE', 'Male');
define('FEMALE', 'Female');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/yyyy');

// categories box text in all boxes
define('BOX_HEADING_SEARCH', 'Quick Find');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Catalog');
define('BOX_CATALOG_CATEGORIES', 'Categories');
define('BOX_CATALOG_INDEXES', 'Indexes');
define('BOX_CATALOG_SUBCATEGORIES', 'Subcategories');
define('BOX_CATALOG_MANUFACTURERS', 'Manufacturers');
define('BOX_CATALOG_PRODUCTS', 'Products');
define('BOX_CATALOG_REVIEWS', 'Reviews');
define('BOX_CATALOG_SPECIALS', 'Specials');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Products Expected');

// categories box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Customers');
define('BOX_CUSTOMERS_CUSTOMERS', 'Customers');
define('BOX_CUSTOMERS_ORDERS', 'Orders');

// whats_new box text in includes/boxes/statistics.php
define('BOX_HEADING_STATISTICS', 'Statistics');
define('BOX_STATISTICS_PRODUCTS_VIEWED', 'Products Viewed');
define('BOX_STATISTICS_PRODUCTS_PURCHASED', 'Products Purchased');
define('BOX_STATISTICS_ORDERS_TOTAL', 'Customer Orders-Total');

// javascript messages
define('JS_ERROR', 'Errors have occured during the process of your form!\nPlease make the following corrections:\n\n');

define('JS_REVIEW_TEXT', '* The \'Review Text\' must have atleast ' . REVIEW_TEXT_MIN_LENGTH . ' characters.\n');
define('JS_REVIEW_RATING', '* You must rate the product for your review.\n');

define('JS_CATEGORIES_NAME', '* The new category needs a name\n');
define('JS_SORT_ORDER', '* A numeric sort order is needed for the new category\n');
define('JS_CATEGORIES_IMAGE', '* An image is required for the new category\n');
define('JS_CATEGORY_DELETE_CONFIRM', '*** WARNING ***\n\nDo you really want to remove this category AND all products linked to it?');

define('JS_SUBCATEGORIES_NAME', '* The new subcategory needs a name\n');
define('JS_SUBCATEGORIES_IMAGE', '* The new subcategory needs an image\n');
define('JS_SUBCATEGORIES_DELETE_CONFIRM', '*** WARNING ***\n\nDo you really want to remove this subcategory AND all products linked to it?');

define('JS_INDEX_NAME', '* The new index needs a name\n');
define('JS_INDEX_SORT_ORDER', '* The new index needs a sort order number\n');
define('JS_INDEX_SQL_SELECT', '* The new index needs a sql_select value\n');

define('JS_MANUFACTURERS_NAME', '* The new manufacturer needs a name\n');
define('JS_MANUFACTURERS_LOCATION', '* The new manufacturer needs a location value (0=left, 1=right)\n');
define('JS_MANUFACTURERS_IMAGE', '* The new manufacturer needs an image\n');
define('JS_MANUFACTURERS_DELETE_CONFIRM', '*** WARNING ***\n\nDo you really want to remove this manufacturer AND all products linked to it?');

define('JS_PRODUCTS_NAME', '* The new product needs a name\n');
define('JS_PRODUCTS_DESCRIPTION', '* The new product needs a description\n');
define('JS_PRODUCTS_PRICE', '* The new product needs a price value\n');
define('JS_PRODUCTS_WEIGHT', '* The new product needs a weight value\n');
define('JS_PRODUCTS_QUANTITY', '* The new product needs a quantity value\n');
define('JS_PRODUCTS_MODEL', '* The new product needs a model value\n');
define('JS_PRODUCTS_IMAGE', '* The new product needs an image value\n');

define('JS_PRODUCTS_EXPECTED_NAME', '* The \'Product\' entry must contain a value\n');
define('JS_PRODUCTS_EXPECTED_DATE', '* The date expected must be in this format: xx/xx/xxxx (date/month/year).\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* A new price for this product needs to be set\n');

define('JS_GENDER', '* The \'Gender\' value must be chosen.\n');
define('JS_FIRST_NAME', '* The \'First Name\' entry must have atleast ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' characters.\n');
define('JS_LAST_NAME', '* The \'Last Name\' entry must have atleast ' . ENTRY_LAST_NAME_MIN_LENGTH . ' characters.\n');
define('JS_DOB', '* The \'Date of Birth\' entry must be in the format: xx/xx/xxxx (date/month/year).\n');
define('JS_EMAIL_ADDRESS', '* The \'E-Mail Address\' entry must have atleast ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' characters.\n');
define('JS_ADDRESS', '* The \'Street Address\' entry must have atleast ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' characters.\n');
define('JS_POST_CODE', '* The \'Post Code\' entry must have atleast ' . ENTRY_POSTCODE_MIN_LENGTH . ' characters.\n');
define('JS_CITY', '* The \'City\' entry must have atleast ' . ENTRY_CITY_MIN_LENGTH . ' characters.\n');
define('JS_COUNTRY', '* The \'Country\' entry must have atleast ' . ENTRY_COUNTRY_MIN_LENGTH . ' characters.\n');
define('JS_TELEPHONE', '* The \'Telephone Number\' entry must have atleast ' . ENTRY_TELEPHONE_MIN_LENGTH . ' characters.\n');
define('JS_PASSWORD', '* The \'Password\' amd \'Confirmation\' entries must match amd have atleast ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.\n');

define('CATEGORY_PERSONAL', '<b>[ Personal ]</b>');
define('CATEGORY_ADDRESS', '<b>[ Address ]</b>');
define('CATEGORY_CONTACT', '<b>[ Contact ]</b>');
define('CATEGORY_PASSWORD', '<b>[ Password ]</b>');
define('ENTRY_GENDER', 'Gender:');
define('ENTRY_GENDER_ERROR', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_GENDER_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_FIRST_NAME', 'First Name:');
define('ENTRY_FIRST_NAME_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_LAST_NAME', 'Last Name:');
define('ENTRY_LAST_NAME_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_DATE_OF_BIRTH', 'Date of Birth:');
define('ENTRY_DATE_OF_BIRTH_TEXT', '&nbsp;<small>(eg. 21/05/1970) <font color="#AABBDD">required</font></small>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Address:');
define('ENTRY_EMAIL_ADDRESS_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_STREET_ADDRESS', 'Street Address:');
define('ENTRY_STREET_ADDRESS_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_SUBURB', 'Suburb:');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Post Code:');
define('ENTRY_POST_CODE_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_CITY', 'City:');
define('ENTRY_CITY_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_STATE', 'State:');
define('ENTRY_STATE_TEXT', '');
define('ENTRY_COUNTRY', 'Country:');
define('ENTRY_COUNTRY_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_TELEPHONE_NUMBER', 'Telephone Number:');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_FAX_NUMBER', 'Fax Number:');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_PASSWORD', 'Password:');
define('ENTRY_PASSWORD_CONFIRMATION', 'Password Confirmation:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_PASSWORD_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('PASSWORD_HIDDEN', '--HIDDEN--');

// images
define('IMAGE_BACK', 'Back');
define('IMAGE_CANCEL', 'Cancel');
define('IMAGE_CONFIRM', 'Confirm');
define('IMAGE_DELETE', 'Delete');
define('IMAGE_GREEN_DOT', 'Green Dot');
define('IMAGE_INSERT', 'Insert');
define('IMAGE_MODIFY', 'Modify');
define('IMAGE_RED_DOT', 'Red Dot');
define('IMAGE_UPDATE', 'Update');
?>
