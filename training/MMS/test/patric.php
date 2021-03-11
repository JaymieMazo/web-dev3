<!DOCTYPE html>
<html>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<select id="systemOption">
<option >mark</option>
<option>reimond</option>
<option>mardy</option>
<option>mica</option>
</select>

<script>
$(document).on('change','#systemOption',function(){
    var newsystem = $(this).children("option:selected").val();
    console.log(newsystem);
})
</script>
</body>
</html> 
