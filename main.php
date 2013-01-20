<?php
/**
 * Doogies Dokuwiki Template
 *
 * @link   http://dokuwiki.org/template:doogiestpl
 * @author Andreas Gohr <andi@splitbrain.org>
 * @author Robert Rackl
 * @author Anika Henke <anika@selfthinker.org>
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
        <?php echo strip_tags($conf['title'])?>
        [<?php tpl_pagetitle()?>]
    </title>

    <?php tpl_metaheaders()?>
    <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
    <?php tpl_includeFile('meta.html')?>
</head>

<body>
<?php tpl_includeFile('topheader.html')?>
<?php html_msgarea() ?>
<div class="dokuwiki <?php if (tpl_getConf('hasLongTitles')) echo 'hasLongTitles' ?>">

    <!-- login state -->
    <div class="user">
        <?php tpl_userinfo()?>
    </div>

    <!--  breadcrumbs -->
    <?php if($conf['breadcrumbs']){?>
        <div class="breadcrumbs">
            <?php tpl_breadcrumbs()?>
        </div>
    <?php }?>

    <?php if($conf['youarehere']){?>
        <div class="breadcrumbs">
            <?php tpl_youarehere() ?>
        </div>
    <?php }?>

    <div class="clearer"></div>

    <?php if (tpl_getConf('actionsToTop')): ?>
        <div class="actions">
            <!-- page actions -->
            <div class="bar-left" id="bar__bottomleft">
                <?php
                    global $conf;
                    global $auth;
                    global $lang;

                    tpl_button('login');
                    if($conf['useacl'] && $auth){
                        if($_SERVER['REMOTE_USER']){   // show only if user is logged in
                            tpl_button('revert');
                            tpl_button('edit');
                            tpl_actiondropdown(tpl_getLang('more_actions'));
                        }
                    }
                ?>
            </div>

            <!-- search form -->
            <div class="bar-right" id="bar__bottomright">
                <div class="searchbox">
                    <?php tpl_searchform(); ?>
                </div>
            </div>

            <div class="clearer"></div>
        </div>
    <?php endif; ?>

    <div class="stylehead">
        <div class="header">
            <div class="logo">
                <?php tpl_link(wl(),$conf['title'],'name="dokuwiki__top" id="dokuwiki__top" accesskey="h" title="[ALT+H]"')?>
            </div>
            <div class="tools">
                <div class="pagename">
                    [[<?php tpl_link(wl($ID,'do=backlink'),tpl_pagetitle($ID,true),'title="'.$lang['btn_backlink'].'"')?>]]
                </div>
            </div>

            <?php if (tpl_getConf('tabsPage')): ?>
                <div class="clearer"></div>
                <div class="tabnav" id="tab__nav">
                    <?php tpl_include_page(tpl_getConf('tabsPage'), 1, 1) ?>
                </div>
            <?php endif; ?>

            <div class="clearer"></div>
            <?php tpl_includeFile('header.html')?>
        </div>
    </div>
    <?php flush()?>

    <?php tpl_includeFile('pageheader.html')?>

    <div class="page">
        <!-- ......... wikipage start ......... -->
        <?php tpl_content()?>
        <!-- ......... wikipage stop  ......... -->
    </div>

    <div class="clearer"></div>

    <?php flush()?>


    <!-- footer -->
    <div class="stylefoot">

        <?php tpl_includeFile('pagefooter.html')?>

        <div class="bar" id="bar__bottom">
            <!-- page metadata -->
            <div class="meta">
                <div class="doc">
                    <?php tpl_pageinfo()?>
                </div>
            </div>

            <?php if (!tpl_getConf('actionsToTop') || (tpl_getConf('actionsToTop') == 2)): ?>
                <!-- page actions -->
                <div class="bar-left" id="bar__bottomleft">
                    <?php
                        global $conf;
                        global $auth;
                        global $lang;

                        tpl_button('login');
                        if($conf['useacl'] && $auth){
                            if($_SERVER['REMOTE_USER']){   // show only if user is logged in
                                tpl_button('revert');
                                tpl_button('edit');
                                tpl_actiondropdown(tpl_getLang('more_actions'));
                            }
                        }
                    ?>
                </div>

                <!-- search form -->
                <div class="bar-right" id="bar__bottomright">
                    <div class="searchbox">
                        <?php tpl_searchform(); ?>
                    </div>
                </div>

                <div class="clearer"></div>
            <?php endif; ?>

        </div>

    </div>

</div>

<?php tpl_includeFile('footer.html')?>

<div class="no">
    <?php /* provide DokuWiki housekeeping, required in all templates */ tpl_indexerWebBug()?>
</div>

</body>
</html>
