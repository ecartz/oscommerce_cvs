<?php
/*
  $Id: create_account_process.php,v 1.6 2001/05/26 16:49:31 hpdl Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2000,2001 The Exchange Project

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Zugang erstellen');
define('NAVBAR_TITLE_2', 'Bearbeitung');
define('TOP_BAR_TITLE', 'Zugang erstellen');
define('HEADING_TITLE', 'Meine Zugangsinformation');
define('TEXT_ORIGIN_LOGIN', '<font color="#FF0000"><small><b>ACHTUNG:</b></font></small> Wenn Sie schon einen Zugang bei uns besitzen, dann klicken Sie bitte zu der <a href="' . tep_href_link(FILENAME_LOGIN, 'origin=checkout_address', 'NONSSL') . '"><u>Anmeldeseite</u></a>.');
define('PLEASE_SELECT', 'Bitte w&auml;hlen');

define('EMAIL_WELCOME', '*** Achtung: Diese E-Mail-Adresse wurde uns von einem Kunden gegeben. Falls Sie sich nicht angemeldet haben, senden Sie bitte ein E-Mail an ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n" . 'Sehr geehrte %s %s,' . "\n\n" . 'Willkommen zu ' . STORE_NAME . '! Sie k�nnen jetzt unser Mitglieder-Service nutzen. Der Service bietet unter anderem:' . "\n\n" . '* Kundeneinkaufswagen - Jeder Artikel bleibt registriert bis Sie zur Kasse gehen, oder die Produkte l�schen.' . "\n" . '* Adressbuch - Wir k�nnen jetzt die Produkte zu der von Ihnen ausgesuchten Adresse senden. Der perfekte Weg ein Geburtstagsgeschenk zu versenden.' . "\n" . '* Vorherige Bestellung - Sie k�nnen Ihre vorherigen Bestellungen �berpr�fen.' . "\n" . '* Meinungen �ber Produkte - Teilen Sie Ihre Meinung mit anderen Kunden.' . "\n\n" . 'Falls Sie Fragen �ber unseren Mitglieder-Service haben, wenden Sie sich bitte an den Vertrieb: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WELCOME_SUBJECT', 'Willkommen zu ' . STORE_NAME . '!');
?>
