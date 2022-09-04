<?php
  // This PHP file prevents other from using the add-on tool called ModHeader.
  // This PHP file stops users from accessing your ALTS. 
  //This user must purchase a plan first before accessing the generator.
  
  // Author: SinisterExploits
  // Version: 1.0
  
  // Name of the IP address log.
  $outputWebBug = 'iplog.csv';

  // Get the IP address and info about client.
  @ $details = json_decode(file_get_contents("http://ipinfo.io/{$_SERVER['REMOTE_ADDR']}/json"));
  @ $hostname=gethostbyaddr($_SERVER['REMOTE_ADDR']);
  
  // Get the query string from the URL.
  $QUERY_STRING = preg_replace("%[^/a-zA-Z0-9@,_=]%", '', $_SERVER['QUERY_STRING']);
  
  // Write the ip address and info to file.
  @ $fileHandle = fopen($outputWebBug, "a");
  if ($fileHandle)
  {
    $string ='"'.$QUERY_STRING.'","'
      .$_SERVER['REMOTE_ADDR'].'","'
      .$hostname.'","'
      .$_SERVER['HTTP_USER_AGENT'].'","'
      .$_SERVER['HTTP_REFERER'].'","'
      .$details->loc.'","' 
      .$details->org.'","' 
      .$details->city.'","' 
      .$details->region.'","' 
      .$details->country.'","' 
      .date("D dS M,Y h:i a").'"'
      ."\n"
      ;
     $write = fputs($fileHandle, $string);
    @ fclose($fileHandle);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="author" content="SinisterExploits">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>HaHa!</title>
<style>#cf-content{display:none!important}body{background:#101010;font-size:14px;color:#FFF;text-align:center;padding-top:2%;margin:auto;font-family:Helvetica,Arial,sans-serif;overflow:hidden}.dickbutt{margin-top:10%}i{font-style:normal;color:#14c9c9}h1,h2{font-weight:400}h1{margin:auto;max-width:417px;border-bottom:1px dashed #fff;font-size:64px}h2{font-size:24px}</style>
<script type="text/javascript">
  //<![CDATA[
  (function(){
    var a = function() {try{return !!window.addEventListener} catch(e) {return !1} },
    b = function(b, c) {a() ? document.addEventListener("DOMContentLoaded", b, c) : document.attachEvent("onreadystatechange", b)};
    b(function(){
      var a = document.getElementById('cf-content');a.style.display = 'block';
      setTimeout(function(){
        var s,t,o,p,b,r,e,a,k,i,n,g,f, rHJZCzM={"TKVSi":+((+!![]+[])+(!+[]+!![]))};
        t = document.createElement('div');
        t.innerHTML="<a href='/'>x</a>";
        t = t.firstChild.href;r = t.match(/https?:\/\//)[0];
        t = t.substr(r.length); t = t.substr(0,t.length-1);
        a = document.getElementById('jschl-answer');
        f = document.getElementById('challenge-form');
        ;rHJZCzM.TKVSi+=+((!+[]+!![]+!![]+[])+(!+[]+!![]+!![]));rHJZCzM.TKVSi+=!+[]+!![]+!![]+!![]+!![]+!![]+!![];rHJZCzM.TKVSi-=+((!+[]+!![]+!![]+!![]+[])+(!+[]+!![]+!![]+!![]+!![]+!![]));a.value = parseInt(rHJZCzM.TKVSi, 10) + t.length; '; 121'
        f.submit();
      }, 4000);
    }, false);
  })();
  //]]>
</script>

</head>
<body>
<div class="ModHeader Patch">
<h1><i class="fa fa-angle-down"></i> Your IP <i class="fa fa-angle-down"></i> <?php echo $_SERVER['REMOTE_ADDR']; ?></h1>
<h2>Greetings Mr. Hacker, we already fixed the exploits, we have your IP!</h2>
<h3>Like honestly, who in the name of fuck uses mod header anymore? Every gen out there has this patched...</h3>
  <form id="challenge-form" action="logout.php" method="get">
    <input type="hidden" name="jschl_vc" value=""/>
    <input type="hidden" name="pass" value=""/>
    <input type="hidden" id="jschl-answer" name=""/>
  </form>
</div>
<p>Please wait while we send your IP to our database/</p>
</div>
</body>
</html>

