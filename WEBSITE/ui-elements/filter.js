<link rel="stylesheet" type="text/css" href="style/filter.css">
<script> 
//Dichiaro la funzione che fa scomparire cose
function azione(variabile) { 
   if(document.getElementById(variabile).style.display=='block') { 
      document.getElementById(variabile).style.display='none'; 
   }else{ 
      document.getElementById(variabile).style.display='block'; 
   } 
}
</script>

<div class="filter">
   <div class="cate">
      <a href="#sub-1" onClick="azione('sub-1');"> <div class="sub">Prezzo </div></a>
      <div id="sub-1" class= "element">
         <input class= "item" type="checkbox" name="price" value="50-150 €">50-150 €<br>
         <input class= "item" type="checkbox" name="price" value="150-200 €">150-200 €<br>
         <input class= "item" type="checkbox" name="price" value="200-250 €">200-250 €<br>
      </div>
   </div>
   <div class="cate">
      <a href="#" onClick="azione('sub-2');"> <div class="sub">Marca </div></a>
      <div id="sub-2" class= "element">
         <input class= "item" type="checkbox" name="brand" value="Shitphone">Shitphone<br>
         <input class= "item" type="checkbox" name="brand" value="Iphone">Iphone<br>
         <input class= "item" type="checkbox" name="brand" value="Android">Android<br>
      </div>
   </div>
</div>
