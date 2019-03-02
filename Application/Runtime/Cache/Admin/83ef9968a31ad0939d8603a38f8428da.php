<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>传智商城后台</title>
	<link href="/shop/Public/css/admin.css" rel="stylesheet" />
	<script src="/shop/Public/js/jquery.min.js"></script>
</head>
<body>
<div id="top">
	<h1 class="left">传智商城 后台管理系统</h1>
	<ul class="right">
		<li>欢迎您：<?php echo (session('admin_name')); ?></li>
		<li>|</li><li><a href="/shop/" target="_blank">前台首页</a></li>
		<li>|</li><li><a href="/shop/Admin/Login/logout">退出登录</a></li>
	</ul>
</div>
<div id="main">
	<div id="menu" class="left">
		<ul><li><a href="/shop/Admin/Index/index" id="Index_index">后台首页</a></li>
			<li><a href="/shop/Admin/Goods/add" id="Goods_add">商品添加</a></li>
			<li><a href="/shop/Admin/Goods/index" id="Goods_index">商品列表</a></li>
			<li><a href="/shop/Admin/Attribute/index" id="Attribute_index">商品属性</a></li>
			<li><a href="/shop/Admin/Category/index" id="Category_index">商品分类</a></li>
			<li><a href="/shop/Admin/Recycle/index" id="Recycle_index">回收站</a></li>
			<li><a href="/shop/Admin/Member/index" id="Member_index">会员管理</a></li>
		</ul>
	</div>
	<div id="content">
		<div class="item"><div class="title">属性添加页面</div>
<div class="data-edit clear">
	<form method="post">
	<input type="hidden" value="<?php echo ($cid); ?>" name="cid" />
	<table>
		<tr><td>属性名</td><td>属性默认值</td></tr>
		<tr>
			<td><input type="text" name="aname" /></td>
			<td><input type="text" name="a_def_val" /></td>
		</tr>
		<tr class="tr_btn center">
			<td colspan="2"><input type="submit" value="确定" /><input type="reset" 
value="重置" /></td>
		</tr>
	</table>
	</form>
</div>
</div>
	</div>
</div>
<script>
	$("#<?php echo (CONTROLLER_NAME); ?>_<?php echo (ACTION_NAME); ?>").addClass("curr");
</script>
</body>
</html>