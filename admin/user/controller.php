<?php
require_once ("../../include/initialize.php");
	  if (!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
     }

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add' :
	doInsert();
	break;
	
	case 'edit' :
	doEdit();
	break;
        
    case 'update':
        update();
        break;
        
	case 'delete' :
	doDelete();
	break;

	case 'photos' :
	doupdateimage();
	break;

 
	}

function update(){
    if (isset($_POST['save'])) {
        $user = New User();
        $user->USERID = $_POST['USERID'];

        // Check if the passwords match
        if ($_POST['U_PASS'] !== $_POST['U_CONFIRM_PASS']) {
            message("Password and Confirm Password do not match.", "error");
            redirect("index.php?view=view&id=" . $_POST['USERID']);
        } else {
            // Update user details
            $user->FULLNAME = $_POST['U_NAME'];
            $user->USERNAME = $_POST['U_USERNAME'];
            if (!empty($_POST['U_PASS'])) {
                $user->PASS = sha1($_POST['U_PASS']);
            }
            $user->ROLE = $_POST['U_ROLE'];
            $user->COMPANYID = $_POST['U_COMPANY'];
            $user->update($_POST['USERID']);

            message("Profile has been updated!", "success");
            redirect("index.php?view=view&id=" . $_POST['USERID']);
        }
    }
}

// Rest of your controller code

   
	function doInsert() {
    if (isset($_POST['save'])) {
        if ($_POST['U_NAME'] == "" || $_POST['U_USERNAME'] == "" || $_POST['U_PASS'] == "" || $_POST['U_CONFIRM_PASS'] == "") {
            $messageStats = false;
            message("All fields are required!", "error");
            redirect('index.php?view=add');
        } elseif ($_POST['U_PASS'] != $_POST['U_CONFIRM_PASS']) {
            $messageStats = false;
            message("Password and Confirm Password do not match!", "error");
            redirect('index.php?view=add');
        } else {	
            $user = new User();
            $user->USERID = $_POST['user_id'];
            $user->FULLNAME = $_POST['U_NAME'];
            $user->USERNAME = $_POST['U_USERNAME'];
            $user->PASS = sha1($_POST['U_PASS']);
            $user->ROLE = $_POST['U_ROLE'];
            $user->COMPANYID = $_POST['U_COMPANY'];
            $user->create();

            $autonum = new Autonumber(); 
            $autonum->auto_update('userid');

            message("The account [" . $_POST['U_NAME'] . "] created successfully!", "success");
            redirect("index.php");
        }
    }
}

	function doEdit() {
    if (isset($_POST['save'])) {
        $user = New User();

        // Check if the passwords match
        if ($_POST['U_PASS'] !== $_POST['U_CONFIRM_PASS']) {
            message("Password and Confirm Password do not match.", "error");
            
            // Redirect back to the edit page with the user's ID
           redirect("index.php?view=edit&id=" . $_POST['USERID']);

            // Alternatively, you can use "index.php?view=edit&id=" if that's the correct URL structure.
        } else {
            // If passwords match, proceed with updating the user profile
            $user->FULLNAME = $_POST['U_NAME'];
            $user->USERNAME = $_POST['U_USERNAME'];
            $user->PASS = sha1($_POST['U_PASS']);
            $user->ROLE = $_POST['U_ROLE'];
            $user->COMPANYID = $_POST['U_COMPANY'];
            $user->update($_POST['USERID']);

            message("Profile has been updated!", "success");
            redirect("index.php"); // Redirect to the desired page after updating the profile
        }
    }
}


	function doDelete(){
		
		// if (isset($_POST['selector'])==''){
		// message("Select the records first before you delete!","info");
		// redirect('index.php');
		// }else{

		// $id = $_POST['selector'];
		// $key = count($id);

		// for($i=0;$i<$key;$i++){

		// 	$user = New User();
		// 	$user->delete($id[$i]);

		
				$id = 	$_GET['id'];

				$user = New User();
	 		 	$user->delete($id);
			 
			message("User has been deleted!","info");
			redirect('index.php');
		// }
		// }

		
	}

	function doupdateimage(){
 
			$errofile = $_FILES['photo']['error'];
			$type = $_FILES['photo']['type'];
			$temp = $_FILES['photo']['tmp_name'];
			$myfile =$_FILES['photo']['name'];
		 	$location="photos/".$myfile;


		if ( $errofile > 0) {
				message("No Image Selected!", "error");
				redirect("index.php?view=view&id=". $_GET['id']);
		}else{
	 
				@$file=$_FILES['photo']['tmp_name'];
				@$image= addslashes(file_get_contents($_FILES['photo']['tmp_name']));
				@$image_name= addslashes($_FILES['photo']['name']); 
				@$image_size= getimagesize($_FILES['photo']['tmp_name']);

			if ($image_size==FALSE ) {
				message("Uploaded file is not an image!", "error");
				redirect("index.php?view=view&id=". $_GET['id']);
			}else{
					//uploading the file
					move_uploaded_file($temp,"photos/" . $myfile);
		 	
					 

						$user = New User();
						$user->PICLOCATION 			= $location;
						$user->update($_SESSION['ADMIN_USERID']);
						redirect("index.php?view=view");
						 
							
					}
			}
			 
		}
 
?>
