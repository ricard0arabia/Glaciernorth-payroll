<html>
<head>
<title>Administration</title>
<style>
body
{
font-family:Calibri;
}
</style>
</head>
<body>
<?php
if($level == "1")
{
?>
<h2>Hi <?php echo $user->name;?>, Welcome to Login you as a Administrator <?php echo anchor('logins/logout', 'Logout');?></h2>
<?php
}else
{
?>
<h2>Hi <?php echo $user->name;?>, Welcome to Login you as a Operator <?php echo anchor('logins/logout', 'Logout');?></h2>
<?php
}
?></body>
</html>
