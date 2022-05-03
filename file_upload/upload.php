<?php

if (isset($_POST['submit'])) {

	$file = $_FILES['file'];
	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];

	$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

	$whiteList = array('jpg', 'jpeg', 'png');

	if (in_array($fileExt, $whiteList)) {

		if (getimagesize($fileTmpName)) {

			if ($fileError === 0) {

				if ($fileSize < 500000) {

					$fileNameNew = uniqid('', true).".".$fileExt;
					$fileDest = 'uploads/'.$fileNameNew;
					move_uploaded_file($fileTmpName, $fileDest);
					header("Location: /file_upload/read.php?filename=".$fileNameNew."&type=".$fileType);

				} else {
				echo "Your file is too big!";
				}

			} else {
			echo "There was an error uploading your file!";
			}

		} else {
			echo "File is not an image";
		}

	} else {
		echo "You cannot upload files of this extension: ".$fileExt;
	}
} else {
	echo "Please submit a file!";
}

?>