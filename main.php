<?php
/**
 * Doogies Dokuwiki Template
 *
 * You should leave the doctype at the very top - It should
 * always be the very first line of a document.
 *
 * @link   http://wiki.splitbrain.org/wiki:tpl:templates
 * @author Andreas Gohr <andi@splitbrain.org>
 * @author Robert Rackl
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

//get needed language array
include DOKU_TPLINC."lang/en/lang.php";
//overwrite English language values with available translations
if (!empty($conf["lang"]) &&
    $conf["lang"] != "en" &&
    file_exists(DOKU_TPLINC."/lang/".$conf["lang"]."/lang.php")){
    //get language file (partially translated language files are no problem
    //cause non translated stuff is still existing as English array value)
    include DOKU_TPLINC."/lang/".$conf["lang"]."/lang.php";
}

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

<?php
/**
 * prints a horizontal navigation bar (composed of <li> items and some CSS tricks)
 * with the current active item highlited
 */
function tpl_tabnavi(){
  global $ID;
  global $ACT;
  global $lang;

  // collect the five config vars into one array
  $navbar_tabs = array();
  for ($i = 1; $i <= 5; $i++) {
    $title  = tpl_getConf('navbar_tab'.$i.'_title');
    $target = tpl_getConf('navbar_tab'.$i.'_target');
    $navbar_tabs[$title] = $target;
  }

  echo("<ul>\n");
  foreach ($navbar_tabs as $title => $target) {
    // only add tab if title and target are filled.
    if (empty($title) || empty($target)) {
      continue;
    }

    //check is user has enough rights to view target page (taken from fulltext.php)
    $targetID = cleanID($target);
    if (isHiddenPage($targetID) || auth_quickaclcheck($targetID) < AUTH_READ) {
      continue;
    }

    echo '<li';
    if (strcasecmp($ID, $target) == 0 && $ACT == 'show') {  // if current page == this tab then show active style
      echo ' id="current"><div id="current_inner">'.$title.'</div>';
    } else {
      echo '>';
      tpl_link(wl($targetID), $title);
    }
    echo "</li>\n";
  }
  // add link to recent page, if template config variable 'navbar_recent' is true
  if (tpl_getConf('navbar_recent')) {
    if ($ACT == 'recent') {
      echo('<li id="current"><div id="current_inner">'.$lang['btn_recent'].'</div></li>');
    } else {
      echo('<li>'); tpl_actionlink('recent','','',$lang['btn_recent']); echo("</li>\n");
    }
  }
  echo("</ul>\n");
}
?>


<body>
<?php tpl_includeFile('topheader.html')?>
<?php html_msgarea() ?>
<div class="dokuwiki">

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

  <div class="stylehead">
    <div class="header">
      <div class="header_left"></div>
      <div class="logo">
        <?php tpl_link(wl(),$conf['title'],'name="dokuwiki__top" id="dokuwiki__top" accesskey="h" title="[ALT+H]"')?>
      </div>
      <div class="header_right"></div>
      <div class="pagename">
        [[<?php tpl_link(wl($ID,'do=backlink'),tpl_pagetitle($ID,true),'title="'.$lang['btn_backlink'].'"')?>]]
      </div>

      <div id="tabnavi" class="tabnavi">
        <?php tpl_tabnavi() ?>
      </div>

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

  <div class="clearer">&nbsp;</div>

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

      <!--  page actions -->
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
              tpl_actiondropdown($lang['more_actions']);
            }
          }
        ?>
      </div>

      <!--  search form -->
      <div class="bar-right" id="bar__bottomright" style="position:relative">
        <?php
          tpl_searchform();
        ?>
      </div>

      <div class="clearer"></div>

    </div>

  </div>

</div>

<?php tpl_includeFile('footer.html')?>

<div class="no">
    <?php /* provide DokuWiki housekeeping, required in all templates */ tpl_indexerWebBug()?>
</div>

</body>
</html>
