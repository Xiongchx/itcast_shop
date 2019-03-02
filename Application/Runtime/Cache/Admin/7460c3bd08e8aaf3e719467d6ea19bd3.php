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
		<div class="item"><div class="title">商品列表</div>
<div class="title-btn left"><a href="/shop/Admin/Goods/add/cid/<?php echo ($cid); ?>">添加商品</a></div>
<div class="data-list clear">请选择商品分类：
	<select name="cid">
		<option value="0">全部</option>
		<?php if(is_array($category)): foreach($category as $key=>$v): ?><option value="<?php echo ($v["cid"]); ?>" <?php if(($v["cid"]) == $cid): ?>selected<?php endif; ?> ><?php echo str_repeat('--',$v['deep']).$v['cname'];?></option><?php endforeach; endif; ?>
	</select>
	<table border="1">
		<tr><th width="80">商品编号</th><th>商品名</th><th width="80">上架</th><th width="80">推荐</th><th width="120">操作</th></tr>
		<?php if(is_array($goods["list"])): foreach($goods["list"] as $key=>$v): ?><tr><td><?php echo ($v["identifier"]); ?></td>
			<td><?php echo ($v["gname"]); ?></td>
			<td class="center"><a href="/shop/Admin/Goods/change/status/<?php echo ($v["status"]); ?>/gid/<?php echo ($v["gid"]); ?>/cid/<?php echo ($cid); ?>"><?php if(($v["status"]) == "yes"): ?>是<?php else: ?>否<?php endif; ?></a></td>
			<td class="center"><a href="/shop/Admin/Goods/change/is_best/<?php echo ($v["is_best"]); ?>/gid/<?php echo ($v["gid"]); ?>/cid/<?php echo ($cid); ?>"><?php if(($v["is_best"]) == "yes"): ?>是<?php else: ?>否<?php endif; ?></a></td>
			<td class="center"><a href="/shop/Admin/Goods/revise/gid/<?php echo ($v["gid"]); ?>/cid/<?php echo ($cid); ?>">修改</a> <a href="/shop/Admin/Goods/del/gid/<?php echo ($v["gid"]); ?>/cid/<?php echo ($cid); ?>">删除</a></td></tr><?php endforeach; endif; ?>
	</table>
	<div class="pagelist"><?php echo ($goods["page"]); ?></div>
</div>
<script>
	$("select").change(function(){
		window.location.href = "/shop/Admin/Goods/index/cid/" + $(this).val();
	});
	$("tr:odd").addClass("odd");
</script></div>
	</div>
</div>
<script>
	$("#<?php echo (CONTROLLER_NAME); ?>_<?php echo (ACTION_NAME); ?>").addClass("curr");
</script>
</body>
</html>