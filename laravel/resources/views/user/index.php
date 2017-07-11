<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<center>
<h1>用户列表</h1>
	<table border="1" width="400">
		<tr align="center">
			<td>编号</td>
			<td>姓名</td>
			<td>性别</td>
			<td>年龄</td>
			<td>操作</td>
		</tr>
		<?php foreach($data as $k=>$v){ ?>
		<tr align="center">
			<td><?= $v->id?></td>
			<td><?= $v->name?></td>
			<td><?= $v->sex?></td>
			<td><?= $v->age?></td>
			<td>
				<a href="user/del?id=<?= $v->id?>">删除</a>||
				<a href="user/update?id=<?= $v->id?>">修改</a>
			</td>
		</tr>
		<?php } ?>
	</table>
</center>
</body>
</html>