<?php
/**
 *
 * @package Global Header and Footer ElkArte
 *
 * @author BurkeKnight
 * @copyright 2015 BurkeKnight Enterprises
 * @license BSD 3-clause
 * @version 2.0.1
 *
 */

if (!defined('ELK'))
	die('No access...');

function GHF_Main()
{
 // Globalize what you need
 global $context, $modSettings;
 
 // Load what you need
 // eg. loadLanguage('GHF');

 // Add things in header
 if (!empty($modSettings['global_head'])) {
 $context['html_headers'] .= $modSettings['global_head'];
 }
}

function GHF_Mid(&$buffer)
{
 // Globalize what you need
 global $modSettings, $context;

 if (isset($_REQUEST['xml']) || $context['current_action'] == 'printpage') return $buffer;

 $ghf = array();

 // Description
 if(!empty($modSettings['global_mid'])) {
 // Insert the global_mid
 $ghf_old1 = '<div id="main_content_section"><a id="skipnav"></a>';
 $ghf_new1 = '<br /><div>' . $modSettings['global_mid'] . '</div>
 <div id="main_content_section"><a id="skipnav"></a>';
 $gfh[$ghf_old1] = $ghf_new1;
 
 // Insert the global_foot
 $ghf_old2 = '<div id="footer_section"><a id="bot"></a>';
 $ghf_new2 = '<div id="footer_section"><a id="bot"></a>
 <div>' . $modSettings['global_foot'] . '</div>';
 $gfh[$ghf_old2] = $ghf_new2;
 
 // Insert the global_copy
 $ghf_old3 = '<li class="copyright">';
 $ghf_new3 = '<li class="copyright">' . $modSettings['global_copy'] . '<br />';
 $gfh[$ghf_old3] = $ghf_new3;
 }
 // Now let's change the title, if we're allowed to
 return str_replace(array_keys($gfh), array_values($gfh), $buffer);
}

function GHF_Settings(&$config_vars)
{
	// Load the language
	loadLanguage('GHF');

	// Add the settings
	$ghf = array(
			array('large_text', 'global_head', '4'),
			array('large_text', 'global_mid', '4'),
			array('large_text', 'global_foot', '4'),
			array('text', 'global_copy', '30'),
			'',
	);

	// Insert after all available slice.
	$first = array_slice($config_vars, 0);
	$config_vars = array_merge($first, $ghf);
}

?>
