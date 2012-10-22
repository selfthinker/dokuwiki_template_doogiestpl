<?php
/**
 * This is the template for the media manager popup
 *
 * @author Andreas Gohr <andi@splitbrain.org>
 */
if (!defined('DOKU_INC')) die(); // must be run from within DokuWiki
@require_once(dirname(__FILE__).'/tpl_functions.php'); /* include hook for template functions */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang']?>"
    lang="<?php echo $conf['lang']?>" dir="<?php echo $lang['direction']?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
        <?php echo hsc($lang['mediaselect'])?>
        [<?php echo strip_tags($conf['title'])?>]
    </title>
    <?php tpl_metaheaders()?>
    <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
</head>

<body>
<div id="media__manager" class="dokuwiki">
    <div id="mediamgr__aside"><div class="pad">
        <?php html_msgarea()?>
        <h1><?php echo hsc($lang['mediaselect'])?></h1>

        <?php /* keep the id! additional elements are inserted via JS here */?>
        <div id="media__opts"></div>

        <?php tpl_mediaTree() ?>
    </div></div>

    <div id="mediamgr__content"><div class="pad">
        <?php tpl_mediaContent() ?>
    </div></div>
</div>
</body>
</html>
