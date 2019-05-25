
<script type="text/javascript">
function validateForm()
{
var a=document.forms["addproduct"]["pname"].value;
if (a==null || a=="")
  {
  alert("Shenoni emrin e produktit");
  return false;
  }
var b=document.forms["addproduct"]["desc"].value;
if (b==null || b=="")
  {
  alert("Shenoni pershkrimin");
  return false;
  }
 var c=document.forms["addproduct"]["price"].value;
if (c==null || c=="")
  {
  alert("Caktoni qmimin");
  return false;
  }
var d=document.forms["addproduct"]["cat"].value;
if (d==null || d=="")
  {
  alert("Zgjedhni kategorine");
  return false;
  }
 var e=document.forms["addproduct"]["image"].value;
if (e==null || e=="")
  {
  alert("Caktoni foton e produktit");
  return false;
  }
}
</script>

<style type="text/css">

.ed{
border-style:solid;
border-width:thin;
border-color:#00CCFF;
padding:5px;
margin-bottom: 4px;
}
#button1{
text-align:center;
font-family:Arial, Helvetica, sans-serif;
border-style:solid;
border-width:thin;
border-color:#00CCFF;
padding:5px;
background-color:#00CCFF;
height: 34px;
}

</style>

<script type="text/javascript">
      
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
      
   </script>

<form action="addexec.php" method="post" enctype="multipart/form-data" name="addproduct" onsubmit="return validateForm()">
 Emri Produktit<br />
  <input name="pname" type="text" class="ed" /><br />
 Pershkrimi<br />
    <input name="desc" type="text" id="rate" class="ed" /><br />
 Cmimi<br />
    <input name="price" type="text" id="qty" class="ed" onkeypress="return isNumberKey(event)" /><br />
 Kategoria<br />
    <select name="cat" class="ed">
    
<?php
    include('db.php');

    $db = Databasei::getInstance();
    $mysqli = $db->getConnection();

    $q = "select * from category";
    $r = $mysqli->query($q); 
    while($row = mysqli_fetch_array($r)){
         echo '<option>'.$row['title'].'</option>';
    }
?>
  </select>

    
 Foto: <br /><input type="file" name="image" class="ed"><br />
 
    <input type="submit" name="Submit" value="Ruaj" id="button1" />
 
</form>
