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

// If we have found SSI.php and we are outside of ELK, then we are running standalone.
if (file_exists(dirname(__FILE__) . '/SSI.php') && !defined('ELK'))
	require_once(dirname(__FILE__) . '/SSI.php');

// If we are outside ELK and can't find SSI.php, then throw an error
elseif (!defined('ELK'))
	die('<b>Error:</b> Cannot install - please verify you put this file in the same place as Elkarte\'s SSI.php.');

if (ELK == 'SSI')
	db_extend('packages');
	
// Define the hooks
$hook_functions = array(
	'integrate_buffer' => 'GHF_Mid|SOURCEDIR/addons/GHF.subs.php',
	'integrate_load_theme' => 'GHF_Main|SOURCEDIR/addons/GHF.subs.php',
	'integrate_general_mod_settings' => 'GHF_Settings|SOURCEDIR/addons/GHF.subs.php',
);

// Adding or removing them?
if (!empty($context['uninstalling']))
	$call = 'remove_integration_function';
else
	$call = 'add_integration_function';

// Do the deed
foreach ($hook_functions as $hook => $function)
	$call($hook, $function);

if (ELK == 'SSI')
   echo 'Congratulations! You have successfully installed this mod!';
?>
