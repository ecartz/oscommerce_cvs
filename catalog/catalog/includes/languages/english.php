<?
/*
English Text for The Exchange Project Preview Release 1.1
Last Update: 13/05/2000
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
// tep_currency_format() function.. although the function is here, it is not in use yet..
define('CURRENCY_BEFORE', '$'); // currency character(s) before value
define('CURRENCY_AFTER', ''); // currency character(s) after value
define('CURRENCY_DECIMAL', '.'); // currency decimal point character
define('CURRENCY_THOUSANDS', ','); // currency thousands separator character
define('CURRENCY_VALUE', 1); // currency value to whats stored in the database(products_price).. this will be set to Euro (not USD)..
// for example:
// products_price = 30.00 (in Euro)
// currency_value = 0.9551 (US to Euro)
// products price with locale currency = currency_value * products_price

// page title
define('TITLE', 'The Exchange Project');

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Create an Account');
define('HEADER_TITLE_MY_ACCOUNT', 'My Account');
define('HEADER_TITLE_CART_CONTENTS', 'Cart Contents');
define('HEADER_TITLE_CHECKOUT', 'Checkout');
define('HEADER_TITLE_TOP', 'Top');
define('HEADER_TITLE_CATALOG', 'Catalog');
define('HEADER_TITLE_LOGOFF', 'Log Off');
define('HEADER_TITLE_LOGIN', 'Log In');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'requests since');

// text for gender
define('MALE', 'Male');
define('FEMALE', 'Female');
define('MALE_ADDRESS', 'Mr.');
define('FEMALE_ADDRESS', 'Ms.');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/yyyy');

// categories box text in includes/boxes/categories.php
define('BOX_HEADING_CATEGORIES', 'Categories');

// whats_new box text in includes/boxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'Whats New?');

// quick_find box text in includes/boxes/quick_find.php
define('BOX_HEADING_SEARCH', 'Quick Find');
define('BOX_SEARCH_TEXT', 'Use keywords to find the product your looking for.');

// add_a_quickie box text in includes/boxes/add_a_quickie.php
define('BOX_HEADING_ADD_PRODUCT_ID', 'Add a Quickie!');
define('BOX_ADD_PRODUCT_ID_TEXT', 'Enter the ID of the product you wish to add to your shopping cart.');

// specials box text in includes/boxes/specials.php
define('BOX_HEADING_SPECIALS', 'Specials');
define('BOX_SPECIALS_MORE', 'More Specials..');

// reviews box text in includes/boxes/reviews.php
define('BOX_HEADING_REVIEWS', 'Reviews');
define('BOX_REVIEWS_MORE', 'More Reviews..');

// shopping_cart box text in includes/boxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'Shopping Cart');
define('BOX_SHOPPING_CART_EMPTY', '..is empty!');
define('BOX_SHOPPING_CART_SUBTOTAL', 'Subtotal:');
define('BOX_SHOPPING_CART_VIEW_CONTENTS', 'View All Contents');

// best_sellers box text in includes/boxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'Bestsellers');
define('BOX_HEADING_BESTSELLERS_IN', 'Bestsellers in<br>&nbsp;&nbsp;');

// checkout procedure text
define('CHECKOUT_BAR_CART_CONTENTS', 'cart contents');
define('CHECKOUT_BAR_DELIVERY_ADDRESS', 'delivery address');
define('CHECKOUT_BAR_PAYMENT_METHOD', 'payment method');
define('CHECKOUT_BAR_CONFIRMATION', 'confirmation');
define('CHECKOUT_BAR_FINISHED', 'finished!');

// javascript messages
define('JS_ERROR', 'Errors have occured during the process of your form!\nPlease make the following corrections:\n\n');

define('JS_CC_OWNER', '* The owner\'s name of the credit card must be atleast ' . CC_OWNER_MIN_LENGTH . ' characters.\n');
define('JS_CC_NUMBER', '* The credit card number must be atleast ' . CC_NUMBER_MIN_LENGTH . ' characters.\n');
define('JS_CC_EXPIRES', '* The credit card expiry date must be atleast ' . CC_EXPIRY_MIN_LENGTH . ' characters.\n');

define('JS_REVIEW_TEXT', '* The \'Review Text\' must have atleast ' . REVIEW_TEXT_MIN_LENGTH . ' characters.\n');
define('JS_REVIEW_RATING', '* You must rate the product for your review.\n');

define('JS_GENDER', '* The \'Gender\' value must be chosen.\n');
define('JS_FIRST_NAME', '* The \'First Name\' entry must have atleast ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' characters.\n');
define('JS_LAST_NAME', '* The \'Last Name\' entry must have atleast ' . ENTRY_LAST_NAME_MIN_LENGTH . ' characters.\n');
define('JS_DOB', '* The \'Date of Birth\' entry must be in the format: xx/xx/xxxx (date/month/year).\n');
define('JS_EMAIL_ADDRESS', '* The \'E-Mail Address\' entry must have atleast ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' characters.\n');
define('JS_ADDRESS', '* The \'Street Address\' entry must have atleast ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' characters.\n');
define('JS_POST_CODE', '* The \'Post Code\' entry must have atleast ' . ENTRY_POSTCODE_MIN_LENGTH . ' characters.\n');
define('JS_CITY', '* The \'City\' entry must have atleast ' . ENTRY_CITY_MIN_LENGTH . ' characters.\n');
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
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_FIRST_NAME_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_LAST_NAME', 'Last Name:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_LAST_NAME_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_DATE_OF_BIRTH', 'Date of Birth:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<small><font color="#FF0000">(eg. 21/05/1970)</font></small>');
define('ENTRY_DATE_OF_BIRTH_TEXT', '&nbsp;<small>(eg. 21/05/1970) <font color="#AABBDD">required</font></small>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Address:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<small><font color="#FF0000">email address already exists!</font></small>');
define('ENTRY_EMAIL_ADDRESS_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_STREET_ADDRESS', 'Street Address:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_STREET_ADDRESS_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_SUBURB', 'Suburb:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Post Code:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_POST_CODE_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_CITY', 'City:');
define('ENTRY_CITY_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_CITY_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_CITY_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_STATE', 'State:');
define('ENTRY_STATE_ERROR', '');
define('ENTRY_STATE_TEXT', '');
define('ENTRY_COUNTRY', 'Country:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_COUNTRY_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_TELEPHONE_NUMBER', 'Telephone Number:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_FAX_NUMBER', 'Fax Number:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_PASSWORD', 'Password:');
define('ENTRY_PASSWORD_CONFIRMATION', 'Password Confirmation:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_PASSWORD_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_PASSWORD_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_PASSWORD_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('PASSWORD_HIDDEN', '--HIDDEN--');
?>
