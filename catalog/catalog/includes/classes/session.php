<?php
/*
  $Id: session.php,v 1.1 2003/11/17 16:55:21 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  class osC_Session {
    var $is_started,
        $save_path,
        $name,
        $id;

// class constructor
    function osC_Session() {
      global $cookie_path, $cookie_domain;

      $this->setName('osCsid');
      $this->setSavePath(SESSION_WRITE_DIRECTORY);

      session_set_cookie_params(0, $cookie_path, $cookie_domain);

      if (STORE_SESSIONS == 'mysql') {
        session_set_save_handler(array(&$this, '_open'),
                                 array(&$this, '_close'),
                                 array(&$this, '_read'),
                                 array(&$this, '_write'),
                                 array(&$this, '_destroy'),
                                 array(&$this, '_gc'));
      }

      $this->setStarted(false);
    }

// class methods
    function start() {
      if (session_start()) {
        $this->setStarted(true);

        $this->setID();

        return true;
      }

      return false;
    }

    function exists($variable) {
      if (isset($_SESSION[$variable])) {
        return true;
      }

      return false;
    }

    function set($variable, &$value) {
      if ($this->is_started == true) {
        $_SESSION[$variable] = $value;

        return true;
      }

      return false;
    }

    function remove($variable) {
      if ($this->exists($variable)) {
        unset($_SESSION[$variable]);

        return true;
      }

      return false;
    }

    function &value($variable) {
      if (isset($_SESSION[$variable])) {
        return $_SESSION[$variable];
      }

      return false;
    }

    function close() {
      if (function_exists('session_write_close')) {
        return session_write_close();
      }

      return true;
    }

    function destroy() {
      if (isset($_COOKIE[$this->name])) {
        unset($_COOKIE[$this->name]);
      }

      if (STORE_SESSIONS == '') {
        if (file_exists($this->save_path . '/' . $this->id)) {
          @unlink($this->save_path . '/' . $this->id);
        }
      }

      return session_destroy();
    }

    function recreate() {
      $session_backup = $_SESSION;

      $this->destroy();

      $this->osC_Session();

      $this->start();

      $_SESSION = $session_backup;

      unset($session_backup);
    }

    function setName($name) {
      session_name($name);

      $this->name = session_name();

      return true;
    }

    function setID() {
      $this->id = session_id();

      return true;
    }

    function setSavePath($path) {
      session_save_path($path);

      $this->save_path = session_save_path();

      return true;
    }

    function setStarted($state) {
      if ($state == true) {
        $this->is_started = true;
      } else {
        $this->is_started = false;
      }
    }

    function _open() {
      return true;
    }

    function _close() {
      return true;
    }

    function _read($key) {
      $value_query = tep_db_query("select value from " . TABLE_SESSIONS . " where sesskey = '" . tep_db_input($key) . "' and expiry > '" . time() . "'");
      if (tep_db_num_rows($value_query)) {
        $value = tep_db_fetch_array($value_query);

        return $value['value'];
      }

      return false;
    }

    function _write($key, $value) {
      if (!$SESS_LIFE = get_cfg_var('session.gc_maxlifetime')) {
        $SESS_LIFE = 1440;
      }

      $expiry = time() + $SESS_LIFE;

      $check_query = tep_db_query("select count(*) as total from " . TABLE_SESSIONS . " where sesskey = '" . tep_db_input($key) . "'");
      $check = tep_db_fetch_array($check_query);

      if ($check['total'] > 0) {
        return tep_db_query("update " . TABLE_SESSIONS . " set expiry = '" . tep_db_input($expiry) . "', value = '" . tep_db_input($value) . "' where sesskey = '" . tep_db_input($key) . "'");
      } else {
        return tep_db_query("insert into " . TABLE_SESSIONS . " values ('" . tep_db_input($key) . "', '" . tep_db_input($expiry) . "', '" . tep_db_input($value) . "')");
      }
    }

    function _destroy($key) {
      return tep_db_query("delete from " . TABLE_SESSIONS . " where sesskey = '" . tep_db_input($key) . "'");
    }

    function _gc($maxlifetime) {
      return tep_db_query("delete from " . TABLE_SESSIONS . " where expiry < '" . time() . "'");
    }
  }
?>