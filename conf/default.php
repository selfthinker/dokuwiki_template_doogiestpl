<?php
/* configuration for navbar in Doogies Template
 * (This is a piece of PHP code so PHP syntax applies!)
 */

# list of tabs in the navigation bar (title of tab => name of linked wikipage)
$conf['navbar_tab1_title']   = 'Wiki';
$conf['navbar_tab1_target']  = 'Start';
$conf['navbar_tab2_title']   = 'Blog';
$conf['navbar_tab2_target']  = 'BlogPage';
$conf['navbar_tab3_title']   = 'Some title';
$conf['navbar_tab3_target']  = 'WikiPage';
$conf['navbar_tab4_title']   = 'Other title';
$conf['navbar_tab4_target']  = 'OtherPage';
$conf['navbar_tab5_title']   = '';  # tab will not be shown when title or
$conf['navbar_tab5_target']  = '';  # target is empty

/*
$conf['navbar_tab1'] = array(
  'Home'        => 'Start', 
  'Blog'        => 'YourBlogPage',
  'Some Title'  => 'WikiPage',
  'Other Title' => 'OtherWikiPage'
);
*/

# Add link to recent changes as last tab. Title will be the localized title from $lang
$conf['navbar_recent'] = 1;

?>