<?php
/**
 * Created by PhpStorm.
 * User: robsm_5mj
 * Date: 1/3/2018
 * Time: 9:04 PM
 */
session_start();
include_once("../DAL/watchlist.php");
include_once("../DAL/watchlistitem.php");
include_once("../Utilities/SessionManager.php");
$customerId = SessionManager::getCustomerId();
if($customerId > 0){
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        $symbol = $_GET["symbol"];
        $name = $_GET["name"];
        $foundwatchlist = Watchlist::loadbycustomerid($customerId);
        $currentDate = date('Y-m-d H:i:s');
        if($foundwatchlist != null){
            $watchlistitem = new Watchlistitem(0,$name,$symbol,$foundwatchlist->getId(),$currentDate);
            $watchlistitem->save();
        }
        else{
            $watchlist = new Watchlist(0, $customerId);
            $watchlist->save();
            $watchlistitem = new Watchlistitem(0,$name,$symbol,$watchlist->getId(),$currentDate);
            $watchlistitem->save();
        }
    }
}
