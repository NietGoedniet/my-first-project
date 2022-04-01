<?php
session_start();
function ErrorMessage(){
    if(isset($_SESSION["ErrorMessage"])){
        $Output = "<div class=\"alert alert-danger\">";
        $Output .= htmlentities($_SESSION["ErrorMessage"]);
        $Output .= "</div>";
        $_SESSION["ErrorMessage"] = null;
        return $Output;
    }
}
function InfoMessage(){
    if(isset($_SESSION["InfoMessage"])){
        $Output = "<div class=\"alert alert-light\"><h4>";
        $Output .= htmlentities($_SESSION["InfoMessage"]);
        $Output .= "<h4></div>";
        $_SESSION["InfoMessage"] = null;
        return $Output;
    }
}
function SuccessMessage(){
    if(isset($_SESSION["SuccessMessage"])){
        $Output = "<div class=\"alert alert-success\"><h3>";
        $Output .= htmlentities($_SESSION["SuccessMessage"]);
        $Output .= "</div>";
        $_SESSION["SuccessMessage"] = null;
        return $Output;
    }
}

function FilterMessage(){
    if(isset($_SESSION["FilterMessage"])){
        // $Output = "<div class=\"alert alert-success\">";
        // $Output .= htmlentities($_SESSION["FilterMessage"]);
        // $Output .= "</div>";

        $Output = "<div class=\"text-black\">".htmlentities($_SESSION["FilterMessage"])."</div> ";
        $_SESSION["FilterMessage"] = null;
        return $Output;
    }
}

?>
