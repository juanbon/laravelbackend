<?php


    class Twitter{
     
        function getTweets($user){
            ini_set('display_errors', 1);
            require_once('TwitterAPIExchange.php');

            $settings = array(
                'oauth_access_token'        => "45629928-0vCGJ9fOz8uufK7SMTLrLMRwbBCCq82U0ggCmCChu",
                'oauth_access_token_secret' => "0IYSWytvr2JR24NAPRUzGR5P7nahLgGRIvDhedw938VAC",
                'consumer_key'              => "fOlgKBJVFgdyW5Wl2UMp1g",
                'consumer_secret'           => "JEV1M13ozevlCfiFtmCeO28A2hQlvtCKOCSmBoII"
            );
     
            $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
            $getfield = '?screen_name='.$user.'&count=1';        
            $requestMethod = 'GET';
            $twitter = new TwitterAPIExchange($settings);
            $json =  $twitter->setGetfield($getfield)
                         ->buildOauth($url, $requestMethod)
                         ->performRequest();
            return $json;
     
        }
     
        function getArrayTweets($jsonraw){
            $rawdata = "";
            $json = json_decode($jsonraw);
            $num_items = count($json);
            for($i=0; $i<$num_items; $i++){
     
                $user = $json[$i];
     
                $fecha = $user->created_at;
                $url_imagen = $user->user->profile_image_url;
                $screen_name = $user->user->screen_name;
                $tweet = $user->text;
     
                $imagen = "<a href='https://twitter.com/".$screen_name."' target=_blank><img src=".$url_imagen."></img></a>";
                $name = "<a href='https://twitter.com/".$screen_name."' target=_blank>@".$screen_name."</a>";
     
                $rawdata[$i][0]=$fecha;
                $rawdata[$i]["FECHA"]=$fecha;
                $rawdata[$i][1]=$imagen;
                $rawdata[$i]["imagen"]=$imagen;
                $rawdata[$i][2]=$name;
                $rawdata[$i]["screen_name"]=$name;
                $rawdata[$i][3]=$tweet;
                $rawdata[$i]["tweet"]=$tweet;
            }
            return $rawdata;
        }
     
        function displayTable($rawdata){
     
            //DIBUJAMOS LA TABLA
            echo '<table border=1>';
            $columnas = count($rawdata[0])/2;
            //echo $columnas;
            $filas = count($rawdata);
            //echo "<br>".$filas."<br>";
            //Añadimos los titulos
     
            for($i=1;$i<count($rawdata[0]);$i=$i+2){
                next($rawdata[0]);
                echo "<th><b>".key($rawdata[0])."</b></th>";
                next($rawdata[0]);
            }
            for($i=0;$i<$filas;$i++){
                echo "<tr>";
                for($j=0;$j<$columnas;$j++){
                    echo "<td>".$rawdata[$i][$j]."</td>";
     
                }
                echo "</tr>";
            }      
            echo '</table>';
        }
    }

        $sites_tw=array('BubulubuUSA','PaletaPayasoUSA');

        $twitterObject = new Twitter();
        $i=0;

        foreach ($sites_tw as $key => $value) {

            $tweets[$i] = json_decode($twitterObject->getTweets($value));
            $i++;
        }

        echo json_encode($tweets);
?>