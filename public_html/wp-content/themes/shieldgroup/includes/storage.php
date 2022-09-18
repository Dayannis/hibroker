<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('shieldgroup_storage_get')) {
	function shieldgroup_storage_get($var_name, $default='') {
		global $SHIELDGROUP_STORAGE;
		return isset($SHIELDGROUP_STORAGE[$var_name]) ? $SHIELDGROUP_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('shieldgroup_storage_set')) {
	function shieldgroup_storage_set($var_name, $value) {
		global $SHIELDGROUP_STORAGE;
		$SHIELDGROUP_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('shieldgroup_storage_empty')) {
	function shieldgroup_storage_empty($var_name, $key='', $key2='') {
		global $SHIELDGROUP_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($SHIELDGROUP_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($SHIELDGROUP_STORAGE[$var_name][$key]);
		else
			return empty($SHIELDGROUP_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('shieldgroup_storage_isset')) {
	function shieldgroup_storage_isset($var_name, $key='', $key2='') {
		global $SHIELDGROUP_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($SHIELDGROUP_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($SHIELDGROUP_STORAGE[$var_name][$key]);
		else
			return isset($SHIELDGROUP_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('shieldgroup_storage_inc')) {
	function shieldgroup_storage_inc($var_name, $value=1) {
		global $SHIELDGROUP_STORAGE;
		if (empty($SHIELDGROUP_STORAGE[$var_name])) $SHIELDGROUP_STORAGE[$var_name] = 0;
		$SHIELDGROUP_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('shieldgroup_storage_concat')) {
	function shieldgroup_storage_concat($var_name, $value) {
		global $SHIELDGROUP_STORAGE;
		if (empty($SHIELDGROUP_STORAGE[$var_name])) $SHIELDGROUP_STORAGE[$var_name] = '';
		$SHIELDGROUP_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('shieldgroup_storage_get_array')) {
	function shieldgroup_storage_get_array($var_name, $key, $key2='', $default='') {
		global $SHIELDGROUP_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($SHIELDGROUP_STORAGE[$var_name][$key]) ? $SHIELDGROUP_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($SHIELDGROUP_STORAGE[$var_name][$key][$key2]) ? $SHIELDGROUP_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('shieldgroup_storage_set_array')) {
	function shieldgroup_storage_set_array($var_name, $key, $value) {
		global $SHIELDGROUP_STORAGE;
		if (!isset($SHIELDGROUP_STORAGE[$var_name])) $SHIELDGROUP_STORAGE[$var_name] = array();
		if ($key==='')
			$SHIELDGROUP_STORAGE[$var_name][] = $value;
		else
			$SHIELDGROUP_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('shieldgroup_storage_set_array2')) {
	function shieldgroup_storage_set_array2($var_name, $key, $key2, $value) {
		global $SHIELDGROUP_STORAGE;
		if (!isset($SHIELDGROUP_STORAGE[$var_name])) $SHIELDGROUP_STORAGE[$var_name] = array();
		if (!isset($SHIELDGROUP_STORAGE[$var_name][$key])) $SHIELDGROUP_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$SHIELDGROUP_STORAGE[$var_name][$key][] = $value;
		else
			$SHIELDGROUP_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('shieldgroup_storage_merge_array')) {
	function shieldgroup_storage_merge_array($var_name, $key, $value) {
		global $SHIELDGROUP_STORAGE;
		if (!isset($SHIELDGROUP_STORAGE[$var_name])) $SHIELDGROUP_STORAGE[$var_name] = array();
		if ($key==='')
			$SHIELDGROUP_STORAGE[$var_name] = array_merge($SHIELDGROUP_STORAGE[$var_name], $value);
		else
			$SHIELDGROUP_STORAGE[$var_name][$key] = array_merge($SHIELDGROUP_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('shieldgroup_storage_set_array_after')) {
	function shieldgroup_storage_set_array_after($var_name, $after, $key, $value='') {
		global $SHIELDGROUP_STORAGE;
		if (!isset($SHIELDGROUP_STORAGE[$var_name])) $SHIELDGROUP_STORAGE[$var_name] = array();
		if (is_array($key))
			shieldgroup_array_insert_after($SHIELDGROUP_STORAGE[$var_name], $after, $key);
		else
			shieldgroup_array_insert_after($SHIELDGROUP_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('shieldgroup_storage_set_array_before')) {
	function shieldgroup_storage_set_array_before($var_name, $before, $key, $value='') {
		global $SHIELDGROUP_STORAGE;
		if (!isset($SHIELDGROUP_STORAGE[$var_name])) $SHIELDGROUP_STORAGE[$var_name] = array();
		if (is_array($key))
			shieldgroup_array_insert_before($SHIELDGROUP_STORAGE[$var_name], $before, $key);
		else
			shieldgroup_array_insert_before($SHIELDGROUP_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('shieldgroup_storage_push_array')) {
	function shieldgroup_storage_push_array($var_name, $key, $value) {
		global $SHIELDGROUP_STORAGE;
		if (!isset($SHIELDGROUP_STORAGE[$var_name])) $SHIELDGROUP_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($SHIELDGROUP_STORAGE[$var_name], $value);
		else {
			if (!isset($SHIELDGROUP_STORAGE[$var_name][$key])) $SHIELDGROUP_STORAGE[$var_name][$key] = array();
			array_push($SHIELDGROUP_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('shieldgroup_storage_pop_array')) {
	function shieldgroup_storage_pop_array($var_name, $key='', $defa='') {
		global $SHIELDGROUP_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($SHIELDGROUP_STORAGE[$var_name]) && is_array($SHIELDGROUP_STORAGE[$var_name]) && count($SHIELDGROUP_STORAGE[$var_name]) > 0) 
				$rez = array_pop($SHIELDGROUP_STORAGE[$var_name]);
		} else {
			if (isset($SHIELDGROUP_STORAGE[$var_name][$key]) && is_array($SHIELDGROUP_STORAGE[$var_name][$key]) && count($SHIELDGROUP_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($SHIELDGROUP_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('shieldgroup_storage_inc_array')) {
	function shieldgroup_storage_inc_array($var_name, $key, $value=1) {
		global $SHIELDGROUP_STORAGE;
		if (!isset($SHIELDGROUP_STORAGE[$var_name])) $SHIELDGROUP_STORAGE[$var_name] = array();
		if (empty($SHIELDGROUP_STORAGE[$var_name][$key])) $SHIELDGROUP_STORAGE[$var_name][$key] = 0;
		$SHIELDGROUP_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('shieldgroup_storage_concat_array')) {
	function shieldgroup_storage_concat_array($var_name, $key, $value) {
		global $SHIELDGROUP_STORAGE;
		if (!isset($SHIELDGROUP_STORAGE[$var_name])) $SHIELDGROUP_STORAGE[$var_name] = array();
		if (empty($SHIELDGROUP_STORAGE[$var_name][$key])) $SHIELDGROUP_STORAGE[$var_name][$key] = '';
		$SHIELDGROUP_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('shieldgroup_storage_call_obj_method')) {
	function shieldgroup_storage_call_obj_method($var_name, $method, $param=null) {
		global $SHIELDGROUP_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($SHIELDGROUP_STORAGE[$var_name]) ? $SHIELDGROUP_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($SHIELDGROUP_STORAGE[$var_name]) ? $SHIELDGROUP_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('shieldgroup_storage_get_obj_property')) {
	function shieldgroup_storage_get_obj_property($var_name, $prop, $default='') {
		global $SHIELDGROUP_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($SHIELDGROUP_STORAGE[$var_name]->$prop) ? $SHIELDGROUP_STORAGE[$var_name]->$prop : $default;
	}
}
?>