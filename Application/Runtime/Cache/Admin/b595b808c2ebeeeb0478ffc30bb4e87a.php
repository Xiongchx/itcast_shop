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
		<div class="item"><div class="title">后台首页</div>
<div class="data-list clear">欢迎进入传智商城后台！请从左侧选择一个操作。</div></div>
	</div>
</div>
<script>
	$("#<?php echo (CONTROLLER_NAME); ?>_<?php echo (ACTION_NAME); ?>").addClass("curr");
</script>
</body>
</html>