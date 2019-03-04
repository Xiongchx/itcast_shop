<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>传智商城</title>
	<link href="/shop/Public/css/home.css" rel="stylesheet" />
	<script src="/shop/Public/js/jquery.min.js"></script>
</head>
<body>
	<div id="top">
		<div class="top_nav">
		<ul><li>收藏本站</li><li>关注本站</li></ul>
		<ul class="right">
			<?php if(isset($mid)): ?><li><?php echo ($mname); ?>，欢迎来到传智商城！[<a href="/shop/Home/User/logout">退出</a>]<li>
			<?php else: ?>
			<li>您好，欢迎来到传智商城！[<a href="/shop/Home/User/login">登录</a>][<a href="/shop/Home/User/register">免费注册</a>]</li><?php endif; ?>
			<li class="line">|</li><li>我的订单</li>
			<li class="line">|</li><li><a href="/shop/Home/User/index">会员中心</a></li>
			<li class="line">|</li><li><a href="/shop/Home/Cart/index">我的购物车</a></li>
			<li class="line">|</li><li>联系客服</li>
		</ul>
		</div>
	</div>
	<div id="box">
		<div id="header">
			<a class="left" href="/shop/"><div id="logo"></div></a>
			<div id="search" class="left">
				<input type="text" class="left" />
				<input class="search_btn" type="button" value="搜索" />
				<p id="search_hot">热门搜索：PHP培训　大学教材　智能手机　平板电脑</p>
			</div>
			<div id="info" class="left">
				<input type="button" value="会员中心" />
				<input type="button" value="去购物车结算" />
			</div>
		</div>
		<div class="clear"></div>
		<div id="nav">
			<ul><li class="category"><a href="#">全部商品分类</a></li><li class="curr"><a href="/shop/">首页</a></li>
				<li><a href="#">PHP</a></li><li><a href="#">Java</a></li><li><a href="#">安卓</a></li>
				<li><a href="#">.Net</a></li><li><a href="#">C/C++</a></li><li><a href="#">IOS</a></li>
			</ul>
		</div>
<div class="usercenter">
<ul class="menu left">
	<li><a href="/shop/Home/User/index" id="User_index">个人信息</a></li>
	<li>我的订单</li>
	<li>我的关注</li>
	<li><a href="/shop/Home/User/addr" id="User_addr">收货地址</a></li>
	<li>消费记录</li>
	<li><a href="/shop/Home/Cart/index" id="Cart_index">购物车</a></li>
</ul>
<script>
$("#<?php echo (CONTROLLER_NAME); ?>_<?php echo (ACTION_NAME); ?>").addClass("curr");
</script>
	<div class="content left">管理收货地址
		<form method="post">
		<input id="address" type="hidden" value="" name="address" />
		<table border="1">
			<tr><th>收件人：</th><td><input type="text" value="<?php echo ($addr["consignee"]); ?>" name="consignee" /></td></tr>
			<tr><th>收件地区：</th><td>
				<select id="province" onchange="toCity()"><?php if(($addr["area"]["0"]) != ""): ?><option><?php echo ($addr["area"]["0"]); ?></option><?php endif; ?></select>
				<select id="city" onchange="toArea()"><option><?php echo ($addr["area"]["1"]); ?></option></select>
				<select id="area"><option><?php echo ($addr["area"]["2"]); ?></option></select>
				</td></tr>
			<tr><th>详细地址：</th><td><input id="addr" type="text" value="<?php echo ($addr["area"]["3"]); ?>" /></td></tr>
			<tr><th>手机：</th><td><input type="text" value="<?php echo ($addr["phone"]); ?>" name="phone" /></td></tr>
			<tr><th>邮箱：</th><td><input type="text" value="<?php echo ($addr["email"]); ?>" name="email" /></td></tr>
			<tr><td colspan="2" class="button center"><input type="submit" value="保存" /> <input type="reset" value="重置" /></td></tr>
		</table>
		</form>
	</div>
	<div class="clear"></div>
</div>
<script>
	//在加载事件中载入省份
	var xmldom = null;	//保存请求到的xml文档信息
	$(function () {
		$.ajax({ //利用ajax去服务器端请求xml信息
			url: '/shop/Public/js/ChinaArea.xml',
			dataType: 'xml',
			type: 'get',
			success: function (msg) {
				xmldom = msg;
				//msg会以xmldom文档节点对象返回
				var province = $(msg).find('province');
				$("#province").append("<option value=0>请选择</option>");
				province.each(function () {
					var name = $(this).attr('province');  //获得省份名称
					var id = $(this).attr('provinceID'); //省份id信息
					$("#province").append("<option value='" + id + "'>" + name + "</option>");
				});
			}
		});
	});
	//通过onchange内容改变事件达到“省份和城市”关联效果
	function toCity() {
		//获得被切换的省份id信息
		var pid = $("#province").val();
		pid = pid.substr(0, 2);//获得value的前两位信息
		//获得city信息，属性cityID的前两位是pid开始
		var city = $(xmldom).find("City[CityID^=" + pid + "]");
		$("#city").empty();
		$("#city").append("<option value=0>请选择</option>");
		$("#area").empty();
		$("#area").append("<option value=0>请选择</option>");
		//遍历city信息，赋值到select下拉列表中
		city.each(function () {
			var name = $(this).attr('City');
			var id = $(this).attr('CityID');
			$("#city").append("<option value='" + id + "'>" + name + "</option>");
		});
	}
	function toArea() {
		var pid = $("#city").val();
		pid = pid.substr(0, 2);
		//获得city信息，属性cityID的前两位是pid开始
		var area = $(xmldom).find("Piecearea[PieceareaID^=" + pid + "]");
		$("#area").empty();
		$("#area").append("<option value=0>请选择</option>");
		area.each(function () {
			var name = $(this).attr('Piecearea');
			var id = $(this).attr('PieceareaID');
			$("#area").append("<option value='" + id + "'>" + name + "</option>");
		});
	}
	//提交表单时检查并拼接完整地址
	$("form").submit(function(){
		var pro_val = $("#province").find("option:selected").text();
		var city_val = $("#city").find("option:selected").text();
		var area_val = $("#area").find("option:selected").text();
		var addr = $("#addr").val();
		if(pro_val === '请选择' || city_val === '请选择' || area_val === '请选择' || $.trim(addr)===''){
			alert('请输入正确的地址');
			return false;
		}
		$("#address").val(pro_val+','+city_val+','+area_val+','+addr);
	});
</script>

		<div id="service">
			<ul><li>购物指南</li><li>配送方式</li><li>支付方式</li>
				<li>售后服务</li><li>特色服务</li><li>网络服务</li>
			</ul>
			<div class="clear"></div>
		</div>
		<div id="footer">传智商城·本项目仅供学习使用</div>
	</div>
</body>
</html>