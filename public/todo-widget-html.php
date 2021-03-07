<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if ( !function_exists( 'ardtdw_widget_html' ) ) {
function ardtdw_widget_html() {
$TextArea = stripslashes(get_option('text'));

echo '<div id="ardtdw-sitewidget" class="ardtdw-sitewidget ardtdw-'.$Posicio.'">';
echo '<div class="ardtdw-sitewidget-inner">';
echo '<div class="ardtdw-sitewidget-head">';
echo '<p>'. __('Llista Tasques','dashboard-to-do-list') . '</p>';
echo '<a href="' . site_url() . '/wp-admin" target="_blank" title="'. __('Afegir Tasca','dashboard-to-do-list') . '">+</a>';
echo '</div>';
echo '<div class="ardtdw-sitewidget-list">';
echo '<ul><li>' . str_replace(PHP_EOL,"</li><li>", stripslashes($TextArea)) . '</li></ul>';
echo '</div>';
echo '</div>';
echo '</div>';
}
}
?>
