<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-01-22 09:30:41
         compiled from "/var/www/html/new/templates/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:84559549254c075e9d09ac4-78997270%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e92cae661e46861524c4ceb9c23bb8b301d7a72e' => 
    array (
      0 => '/var/www/html/new/templates/footer.tpl',
      1 => 1421139452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '84559549254c075e9d09ac4-78997270',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'version' => 0,
    'PALANG' => 0,
    'CONF' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54c075e9d2a665_09839079',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54c075e9d2a665_09839079')) {function content_54c075e9d2a665_09839079($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include '/var/www/html/new/smarty/libs/plugins/modifier.replace.php';
?><!-- <?php echo basename($_smarty_tpl->source->filepath);?>
 -->
<div id="footer">
	<a target="_blank" href="http://postfixadmin.sf.net/">Postfix Admin <?php echo $_smarty_tpl->tpl_vars['version']->value;?>
</a>
	&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
	<a target="_blank" href="http://postfixadmin.sf.net/update-check.php?version=<?php echo rawurlencode($_smarty_tpl->tpl_vars['version']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['PALANG']->value['check_update'];?>
</a>
    <?php if (isset($_SESSION['sessid'])) {?>
        <?php if ($_SESSION['sessid']['username']) {?>
            &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;	
            <?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['PALANG']->value['pFooter_logged_as'],"%s",$_SESSION['sessid']['username']);?>

        <?php }?>
    <?php }?>
	<?php if ($_smarty_tpl->tpl_vars['CONF']->value['show_footer_text']=='YES'&&$_smarty_tpl->tpl_vars['CONF']->value['footer_link']) {?>
		&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
		<a href="<?php echo $_smarty_tpl->tpl_vars['CONF']->value['footer_link'];?>
"><?php echo $_smarty_tpl->tpl_vars['CONF']->value['footer_text'];?>
</a>
	<?php }?>
</div>
</div>
</body>
</html>
<?php }} ?>
