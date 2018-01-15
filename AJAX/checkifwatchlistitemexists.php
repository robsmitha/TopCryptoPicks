<?php
session_start();
include_once("../DAL/watchlist.php");
include_once("../DAL/watchlistitem.php");
include_once("../Utilities/SessionManager.php");
$CustomerId = SessionManager::getCustomerId();
if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["name"]) && $_GET["name"] != ""){
        $foundwatchlist = Watchlist::loadbycustomerid($CustomerId);
        if($foundwatchlist != null){
            $watchlistitemList = Watchlistitem::loadbywatchlistid($foundwatchlist->getId());
            $itemExists = false;
            foreach ($watchlistitemList as $wi){
                $name = $_GET["name"];
                $name = str_replace(' ', '-', $name);
                $name = strtolower($name);
                $test = $wi->getName();
                $test = str_replace(' ', '-', $test);
                $test = strtolower($test);
                if($name == $test){
                    $itemExists = true;
                    $watchlistitemid = $wi->getId();
                }
            }
            if($itemExists){
                echo $watchlistitemid;
            }
            else {
                echo 0; //item does not exist
            }
        }
        else {
            echo 0; //item does not exist
        }
    }
    else {
        echo 0; //item does not exist
    }
}
?>