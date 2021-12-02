// JavaScript Document
function checkZip() {
if($F('ci').length == 5) {
var url = 'script/data/code_inscription.php';
var params = 'code_inscription=' + $F('ci');
var ajax = new Ajax.Updater(
{success: 'er_code'},
url,
{method: 'get', parameters: params, onFailure: reportError});
}
}
function reportError(request) {
$F('er_code') = "Error";
}
