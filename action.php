<?php
/**
 * DokuWiki Plugin do (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Andreas Gohr <gohr@cosmocode.de>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

if (!defined('DOKU_LF')) define('DOKU_LF', "\n");
if (!defined('DOKU_TAB')) define('DOKU_TAB', "\t");
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');

require_once(DOKU_PLUGIN.'action.php');

class action_plugin_do extends DokuWiki_Action_Plugin {

    function getInfo() {
        return confToHash(dirname(__FILE__).'/plugin.info.txt');
    }

    function register(&$controller) {

       $controller->register_hook('DOKUWIKI_STARTED', 'FIXME', $this, 'handle_dokuwiki_started');

       $controller->register_hook('ACTION_ACT_PREPROCESS', 'BEFORE', $this, 'handle_act_preprocess');

    }

    function handle_dokuwiki_started(&$event, $param) { }


    function handle_act_preprocess(&$event, $param) {
        if($event->data != 'plugin_do') return true;

        $hlp = plugin_load('helper', 'do');
        $hlp->toggleTaskStatus(cleanID($_REQUEST['do_page']),$_REQUEST['do_md5']);

        global $ACT;
        $ACT = 'show';
        return true;
    }

}

// vim:ts=4:sw=4:et:enc=utf-8:
