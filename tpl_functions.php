<?php
/**
 * Template Functions
 *
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

/**
 * simplified tpl_includeFile() for older DokuWiki versions
 */
if (!function_exists('tpl_includeFile')) {
    function tpl_includeFile($file) {
        @include(dirname(__FILE__).'/'.$file);

    }
}
