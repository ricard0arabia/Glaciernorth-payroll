<html>
<head>
<title>Upload Form</title>
</head>
<body>
 
<h3>Your file was successfully uploaded!</h3>
 
<p>The uploaded Image:</p>
 
<img alt="uploaded image" src="<?=base_url(). 'uploads/3.jpg';?>">
 
<p>The Thumbnail Image:</p>
 
<img alt="Thumbnail image" src="<?=base_url(). 'uploads/' . $upload_data['raw_name'].'_thumb'.$upload_data['file_ext'];?>">
<p><?php echo anchor('upload', 'Upload Another File!'); ?></p>
 
</body>
</html>