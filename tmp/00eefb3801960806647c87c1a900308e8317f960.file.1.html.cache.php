<?php /* Smarty version Smarty-3.0.6, created on 2016-06-14 12:13:44
         compiled from "./tpl\1.html" */ ?>
<?php /*%%SmartyHeaderCode:17750575ff4f87c3976-97229254%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '00eefb3801960806647c87c1a900308e8317f960' => 
    array (
      0 => './tpl\\1.html',
      1 => 1465906077,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17750575ff4f87c3976-97229254',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html>
<html>
    <head>
	<title>TODO supply a title</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
	<a href="index.php?action=add">添加</a>
	<table border="1">
	    <tr>
		<th>ID</th>
		<th>NAME</th>
		<th>OPTION</th>
	    </tr>
	    <?php  $_smarty_tpl->tpl_vars['tmp'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('rows')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['tmp']->key => $_smarty_tpl->tpl_vars['tmp']->value){
?>
	    <tr>
		<td><?php echo $_smarty_tpl->tpl_vars['tmp']->value['id'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['tmp']->value['name'];?>
</td>
		<td><a href=''>删除</a> <a href=''>修改</a></td>
	    </tr>
	    <?php }} ?>
	</table>
    </body>
</html>
