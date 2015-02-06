<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-01-22 09:35:54
         compiled from "/var/www/html/new/templates/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:174531972254c07722254627-59121902%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c962a3c17c43b5dd7b67674c6d0f56f6d8826021' => 
    array (
      0 => '/var/www/html/new/templates/menu.tpl',
      1 => 1421139452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '174531972254c07722254627-59121902',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_domain' => 0,
    'authentication_has_role' => 0,
    'PALANG' => 0,
    'boolconf_alias_domain' => 0,
    'CONF' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54c077222f6f74_19614896',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54c077222f6f74_19614896')) {function content_54c077222f6f74_19614896($_smarty_tpl) {?><!-- <?php echo basename($_smarty_tpl->source->filepath);?>
 -->
<?php if (!empty($_GET)&&!empty($_GET['domain'])) {
$_smarty_tpl->tpl_vars["url_domain"] = new Smarty_variable($_GET['domain'], null, 0);
ob_start();
echo rawurlencode($_smarty_tpl->tpl_vars['url_domain']->value);
$_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["url_domain"] = new Smarty_variable("&amp;domain=".$_tmp1, null, 0);
}?>
<div id="menu">
<ul>

<?php if ($_smarty_tpl->tpl_vars['authentication_has_role']->value['global_admin']) {?>
<li><a target="_top" href="<?php echo $_smarty_tpl->getConfigVariable('url_list_admin');?>
"><?php echo $_smarty_tpl->tpl_vars['PALANG']->value['pAdminMenu_list_admin'];?>
</a><ul><li><a target="_top" href="<?php echo $_smarty_tpl->getConfigVariable('url_list_admin');?>
"><?php echo $_smarty_tpl->tpl_vars['PALANG']->value['pAdminMenu_list_admin'];?>
</a></li><li><a target="_top" href="<?php echo $_smarty_tpl->getConfigVariable('url_create_admin');?>
"><?php echo $_smarty_tpl->tpl_vars['PALANG']->value['pAdminMenu_create_admin'];?>
</a></li></ul></li>
<?php } else { ?>
	<li><a target="_top" href="<?php echo $_smarty_tpl->getConfigVariable('url_main');?>
"><?php echo $_smarty_tpl->tpl_vars['PALANG']->value['pMenu_main'];?>
</a></li>
<?php }?>

<li><a target="_top" href="<?php echo $_smarty_tpl->getConfigVariable('url_list_domain');?>
"><?php echo $_smarty_tpl->tpl_vars['PALANG']->value['pAdminMenu_list_domain'];?>
</a><ul><li><a target="_top" href="<?php echo $_smarty_tpl->getConfigVariable('url_list_domain');?>
"><?php echo $_smarty_tpl->tpl_vars['PALANG']->value['pAdminMenu_list_domain'];?>
</a></li><?php if ($_smarty_tpl->tpl_vars['authentication_has_role']->value['global_admin']) {?><li><a target="_top" href="<?php echo $_smarty_tpl->getConfigVariable('url_edit_domain');?>
"><?php echo $_smarty_tpl->tpl_vars['PALANG']->value['pAdminMenu_create_domain'];?>
</a></li><?php }?></ul></li>

<li><a target="_top" href="<?php echo $_smarty_tpl->getConfigVariable('url_list_virtual');?>
"><?php echo $_smarty_tpl->tpl_vars['PALANG']->value['pAdminMenu_list_virtual'];?>
</a><ul><li><a target="_top" href="<?php echo $_smarty_tpl->getConfigVariable('url_list_virtual');?>
"><?php echo $_smarty_tpl->tpl_vars['PALANG']->value['pAdminMenu_list_virtual'];?>
</a></li><li><a target="_top" href="<?php echo $_smarty_tpl->getConfigVariable('url_create_mailbox');
echo $_smarty_tpl->tpl_vars['url_domain']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['PALANG']->value['add_mailbox'];?>
</a></li><li><a target="_top" href="<?php echo $_smarty_tpl->getConfigVariable('url_create_alias');
echo $_smarty_tpl->tpl_vars['url_domain']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['PALANG']->value['add_alias'];?>
</a></li><?php if ($_smarty_tpl->tpl_vars['boolconf_alias_domain']->value) {?><li><a target="_top" href="<?php echo $_smarty_tpl->getConfigVariable('url_create_alias_domain');
echo $_smarty_tpl->tpl_vars['url_domain']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['PALANG']->value['add_alias_domain'];?>
</a></li><?php }?></ul></li>

<?php if ($_smarty_tpl->tpl_vars['CONF']->value['fetchmail']==='YES') {?>
<li><a target="_top" href="<?php echo $_smarty_tpl->getConfigVariable('url_fetchmail');?>
"><?php echo $_smarty_tpl->tpl_vars['PALANG']->value['pMenu_fetchmail'];?>
</a><ul><li><a target="_top" href="<?php echo $_smarty_tpl->getConfigVariable('url_fetchmail');?>
"><?php echo $_smarty_tpl->tpl_vars['PALANG']->value['pMenu_fetchmail'];?>
</a></li><li><a target="_top" href="<?php echo $_smarty_tpl->getConfigVariable('url_fetchmail_new_entry');?>
"><?php echo $_smarty_tpl->tpl_vars['PALANG']->value['pFetchmail_new_entry'];?>
</a></li></ul></li>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['CONF']->value['sendmail']==='YES') {?>
<li><a target="_top" href="<?php echo $_smarty_tpl->getConfigVariable('url_sendmail');?>
"><?php echo $_smarty_tpl->tpl_vars['PALANG']->value['pMenu_sendmail'];?>
</a><ul><li><a target="_top" href="<?php echo $_smarty_tpl->getConfigVariable('url_sendmail');?>
"><?php echo $_smarty_tpl->tpl_vars['PALANG']->value['pMenu_sendmail'];?>
</a></li><?php if ($_smarty_tpl->tpl_vars['authentication_has_role']->value['global_admin']) {?><li><a target="_top" href="<?php echo $_smarty_tpl->getConfigVariable('url_broadcast_message');?>
"><?php echo $_smarty_tpl->tpl_vars['PALANG']->value['pAdminMenu_broadcast_message'];?>
</a></li><?php }?></ul></li>
<?php }?>

	<li><a target="_top" href="<?php echo $_smarty_tpl->getConfigVariable('url_password');?>
"><?php echo $_smarty_tpl->tpl_vars['PALANG']->value['pMenu_password'];?>
</a></li>

<?php if ($_smarty_tpl->tpl_vars['authentication_has_role']->value['global_admin']&&$_smarty_tpl->tpl_vars['CONF']->value['database_type']!=='pgsql'&&$_smarty_tpl->tpl_vars['CONF']->value['backup']==='YES') {?>
	<li><a target="_top" href="<?php echo $_smarty_tpl->getConfigVariable('url_backup');?>
"><?php echo $_smarty_tpl->tpl_vars['PALANG']->value['pAdminMenu_backup'];?>
</a></li>
<?php }?>

	<li><a target="_top" href="<?php echo $_smarty_tpl->getConfigVariable('url_viewlog');?>
"><?php echo $_smarty_tpl->tpl_vars['PALANG']->value['pMenu_viewlog'];?>
</a></li>

	<li class="logout"><a target="_top" href="<?php echo $_smarty_tpl->getConfigVariable('url_logout');?>
"><?php echo $_smarty_tpl->tpl_vars['PALANG']->value['pMenu_logout'];?>
</a></li>
</ul>
</div>

<?php echo '<script'; ?>
 type='text/javascript'>
// <![CDATA[
sfHover = function()
{
	var sfEls = document.getElementById("menu").getElementsByTagName("LI");
	for (var i=0; i<sfEls.length; i++)
	{
		sfEls[i].onmouseover=function()
		{
			this.className+=" sfhover";
		}
		sfEls[i].onmouseout=function()
		{
			this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
		}
	}
}
if (window.attachEvent)
	window.attachEvent("onload", sfHover);
// ]]>
<?php echo '</script'; ?>
>

<?php }} ?>
