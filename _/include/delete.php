<?php
// ggarciaa at gmail dot com (04-July-2007 01:57)
// I needed to empty a directory, but keeping it
// so I slightly modified the contribution from
// stefano at takys dot it (28-Dec-2005 11:57)
// A short but powerfull recursive function
// that works also if the dirs contain hidden files
//
// $dir = the target directory
// $DeleteMe = if true delete also $dir, if false leave it alone

function SureRemoveDir($chemain) {
  $fileToRemove = $chemain;
if (file_exists($fileToRemove)){
   // yes the file does exist
   unlink($fileToRemove);
} else {
   // the file is not found, do something about it???
   
   echo'fichier inexistant';
}
}

//SureRemoveDir('EmptyMe', false);
//SureRemoveDir('RemoveMe', true);

?>
