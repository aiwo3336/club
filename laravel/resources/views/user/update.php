<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>修改</title>
</head>
<body>
<center>
<h1>用户修改</h1>
	<form action="modify" method="post">
	<input type="hidden" name='id' value="<?= $data->id?>">
		<table border="1">
			<tr>
				<td>姓名</td>
				<td><input type="text" name='name' value="<?= $data->name?>"></td>
			</tr>
			<tr>
				<td>性别</td>
				<td>
					<?php if($data->sex=='男'){ ?>
						<input type="radio" name='sex' value="男" checked>男
						<input type="radio" name='sex' value="女">女
					<?php }else{ ?>
						<input type="radio" name='sex' value="男">男
						<input type="radio" name='sex' value="女" checked>女
					<?php } ?>
					</td>
			</tr>
			<tr>
				<td>年龄</td>
				<td><input type="text" name='age' value="<?= $data->age?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value='修改'></td>
			</tr>
		</table>
	</form>
</center>
</body>
</html>