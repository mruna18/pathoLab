<?php 
// Include the database configuration file 
include_once 'partials/_dbconn.php'; 
 
$statusMsg = ''; 
 
// File upload directory 
$targetDir = "uploads/"; 
 
if(isset($_POST["submit"])){ 
    if(!empty($_FILES["file"]["name"])){ 
        $fileName = basename($_FILES["file"]["name"]); 
        $targetFilePath = $targetDir . $fileName; 
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION); 
     
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            // Upload file to server 
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
                // Insert image file name into database 
                $insert = $conn->query("INSERT INTO uploaded_prescription (file_name, uploaded_on) VALUES ('".$fileName."', NOW())"); 
                if($insert){ 
                    $statusMsg = "The file ".$fileName. " has been uploaded successfully."; 
                }else{ 
                    $statusMsg = "File upload failed, please try again."; 
                }  
            }else{ 
                $statusMsg = "Sorry, there was an error uploading your file."; 
            } 
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select a file to upload.'; 
    } 
} 
 
// Display status message 
echo $statusMsg; 
?>
