<?php 
$curl = curl_init();
$searchString = 'movie/fifty-shades/';
$url = "https://mlwbd.love/$searchString";

curl_setopt($curl,CURLOPT_URL,$url);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);


$result = curl_exec($curl);
preg_match_all("!https://image.tmdb.org/t/p/w185/[^\s]*.jpg!",$result,$matches);
$images = array_values(array_unique($matches[0]));

for ($i=0; $i < count($images); $i++) { 
    echo "<div style='float:left; margin:10px 0 0 0;'>";
    echo"<img src='$images[$i]'><br/>";
    echo"</div>";
}

curl_close($curl);

?>
