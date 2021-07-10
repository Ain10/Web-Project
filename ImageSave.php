<?php
session_start();
require_once("xmlDomRequire.php");

if(isset($_FILES['pic'])){
    $fileTmpPath = $_FILES['pic']['tmp_name'];
    $fileName = $_FILES['pic']['name'];
    

    $fileNameParts = explode(".", $fileName);
    $fileExtenstion = strtolower(end($fileNameParts));
    $newFileName = md5($fileName).'.'.$fileExtenstion;
    $allowedfileExtensions = ['jpg', 'png', 'jpeg'];
    if(in_array($fileExtenstion, $allowedfileExtensions)){
        $uploadFileDir = './profile_pics/';
        $dest_path = $uploadFileDir.$newFileName;
        if(move_uploaded_file($fileTmpPath, $dest_path)){
            foreach($users as $user){
                if($user->getAttribute("username") == $_SESSION['username']){
                    $oldpic = $user->getElementsByTagName("profilePic")->item(0);
                    $newpic = $xml->createElement("profilePic", $newFileName);
                    $user->replaceChild($newpic, $oldpic);
                    $xml->save("users.xml");
                    break;
                }
            }
            $_SESSION['profilePic'] = $newFileName;
            echo $newFileName;
        }else{
            echo "default.png";
        }
    }else{
        echo "default.png";
    }

}else{
    header("Location: viewMovies.php");
}
?>