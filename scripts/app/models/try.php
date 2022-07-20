
<form action="try.php" enctype="multipart/form-data" method="post">
    <input type="file" name="admissionLetter" id="">
    <input type="submit" value="upload">
</form>
<?php

function isPdf($pdfFile)
{
    return $pdfFile["type"] == "application/pdf"?true:false;
      
}
function getCohort()
    {
        $thisYear = date('Y');
        $nextYear = $thisYear + 1;
        $cohort = $thisYear . "/" . $nextYear;
        return $cohort;
    }
array_merge();
//move_uploaded_file($_FILES['admissionLetter']['tmp_name'], '/a.pdf');
// if(!isPdf($_FILES['admissionLetter'])):
//     echo "file is not pdf";
// else:
//     echo "file is pdf";

