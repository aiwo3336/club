<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加</title>
</head>
<body>
<center>
<h1>用户添加</h1>
	<form action="adds" method="post">
		<table border="1">
			<tr>
				<td>姓名</td>
				<td><input type="text" name='name'></td>
			</tr>
			<tr>
				<td>性别</td>
				<td>
					<input type="radio" name='sex' value="男">男
					<input type="radio" name='sex' value="女">女
					</td>
			</tr>
			<tr>
				<td>年龄</td>
				<td><input type="text" name='age'></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value='添加'></td>
			</tr>
		</table>
	</form>
</center>
</body>
</html>