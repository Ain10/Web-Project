<?php
  session_start();
    ob_start();
		if(empty($_SESSION['logged'])){
		header('location: index.php');
	}
    require_once('xmlConnector.php');
    
    if(isset($_GET['display'])){
        $display = $_GET['display'];
        if($display=="list"){
 
             displayList();

        }else{
            displayGallery();
        }
    }

    function displayList(){
        require_once('movieSort.php');
        $genresearch = $_GET['genre'];
        $year = $_GET['year'];
       
        $html= "<table id='tableMovies'><tr><th>Game Code</th><th>Title</th><th>Developer</th><th>Publisher</th><th>Genre</th><th>Price</th><th>Date of Release</th></tr>";
            foreach($sortGame as $game){
            
            $id=$game['gameCode'];
            $title=$game['title'];
            $developer=$game['developer'];
            $publisher=$game['publisher'];
            $genre=$game['genre'];
            $price=$game['price'];
            $dateOfRelease=$game['dateOfRelease'];
            
            if(($genre == $genresearch || empty($genresearch))&& (intval($year)>=intval(substr($dateOfRelease,0,4)) || empty($year))){
               
                    $html.="<tr onclick='displayModal($id)' id='trHover'>
                    <td>$id</td>
                    <td>$title</td>
                    <td>$developer</td>
                    <td>$publisher</td>
                    <td>$genre</td>
                    <td>$price</td>
                    <td>$dateOfRelease</td>
                    </tr>";
            }
            }
        $html.="</table>";
        echo $html;
    }

    function displayGallery(){
        require_once('movieSort.php');
        $genresearch = $_GET['genre'];
        $year = $_GET['year'];
        $html="<main> <span id='span1' onclick='nice()'>&#139;</span><span id='span2' onclick='scrollRight()'>&#155;</span><section id='sectionChief'>";

        foreach($sortGame as $game){
            
            $id=$game['gameCode'];
            $title=$game['title'];
            $developer=$game['developer'];
            $publisher=$game['publisher'];
            $genre=$game['genre'];
            $price=$game['price'];
            $dateOfRelease=$game['dateOfRelease'];
            $image = $game['imagePath'];
            if(($genre == $genresearch || empty($genresearch))&& (intval($year)>=intval(substr($dateOfRelease,0,4)) || empty($year))){
                $html .= "<div id='divGal' onclick='displayModal($id)' style='background-image: url($image)''>
                <p id=textData>$title</p><br>
                <p id=textData>$developer</p><br>
                <p id=textData>$genre</p><br>
                </div>";                
            }

        }
        $html.="</section></main>";
        echo $html;
    }
?>