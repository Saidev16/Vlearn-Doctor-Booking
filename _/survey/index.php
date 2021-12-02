<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stats : PIIMT - AUL </title>
</head>

<body>
<?php 

function PostRequest($url, $referer, $_data) {
 
    // convert variables array to string:
    $data = array();    
    while(list($n,$v) = each($_data)){
        $data[] = "$n=$v";
    }    
    $data = implode('&', $data);
    // format --> test1=a&test2=b etc.
 
    // parse the given URL
    $url = parse_url($url);
    if ($url['scheme'] != 'https') { 
        die('Only HTTP request are supported ! :current= '.$url['scheme']);
    }
 
    // extract host and path:
    $host = $url['host'];
    $path = $url['path'];
 
    // open a socket connection on port 80
    $fp = fsockopen($host, 80);
 
    // send the request headers:
    fputs($fp, "POST $path HTTP/1.1\r\n");
    fputs($fp, "Host: $host\r\n");
    fputs($fp, "Referer: $referer\r\n");
    fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
    fputs($fp, "Content-length: ". strlen($data) ."\r\n");
    fputs($fp, "Connection: close\r\n\r\n");
    fputs($fp, $data);
 
    $result = ''; 
    while(!feof($fp)) {
        // receive the results of the request
        $result .= fgets($fp, 128);
    }
 
    // close the socket connection:
    fclose($fp);
 
    // split the result header from the content
    $result = explode("\r\n\r\n", $result, 2);
 
    $header = isset($result[0]) ? $result[0] : '';
    $content = isset($result[1]) ? $result[1] : '';
 
    // return as array:
    return array($header, $content);
}//PostRequest




/*
** The example:
*/
 
// submit these variables to the server:
$data = array(
    "__EVENTVALIDATION" => "/wEWBgK5gYsBAsnawPwNArnA2YcBAtbjiCsCvsPYtAQCpL3NtAqdWYEa2TmO4DkiN8AsvWaGoc6KZA==",
    "__VIEWSTATE" => "/wEPDwULLTEwMDQ1ODA0MjMPZBYEZg9kFgRmDxYCHgdWaXNpYmxlaGQCAw9kFgICAg8WAh4EVGV4dAWXAjxzY3JpcHQgdHlwZT0idGV4dC9qYXZhc2NyaXB0Ij48IS0tCnMuZVZhcjU9cy5wcm9wNT0iTm90IExvZ2dlZCBJbiI7cy5wYWdlTmFtZT0nTXlBY2NvdW50X0xvZ2luJztzLmNoYW5uZWw9J015QWNjb3VudCc7cy5saW5rSW50ZXJuYWxGaWx0ZXJzPSdqYXZhc2NyaXB0OixzdXJ2ZXltb25rZXkuY29tLHN1cnZleW1rLmNvbSxzdXJ2ZXltb25rZXkubmV0LHJlc2VhcmNoLm5ldCc7dmFyIHNfY29kZT1zLnQoKTtpZihzX2NvZGUpZG9jdW1lbnQud3JpdGUoc19jb2RlKTsvLy0tPjwvc2NyaXB0PmQCAg9kFgwCAQ9kFgYCAQ8PFgIeC05hdmlnYXRlVXJsBRtodHRwOi8vZnIuc3VydmV5bW9ua2V5LmNvbS9kZAIGDw8WAh8CBSVodHRwOi8vYWlkZS5zdXJ2ZXltb25rZXkuY29tL2FwcC9ob21lZGQCCA8WAh8AaGQCAw8WAh8BBQdTaWduIEluZAIFDw8WAh8CBUhodHRwczovL2ZyLnN1cnZleW1vbmtleS5jb20vTXlBY2NvdW50X0pvaW4uYXNweD91dG1fc291cmNlPWFjY291bnRfbG9naW5kZAIHD2QWDAIBDxYEHgNmb3IFFXdjX0xvZ2luMV90eHRVc2VybmFtZR4JaW5uZXJodG1sBQlVc2VybmFtZTpkAgMPFgQfAwUVd2NfTG9naW4xX3R4dFBhc3N3b3JkHwQFCVBhc3N3b3JkOmQCBQ9kFgICAg8WAh8DBRZ3Y19Mb2dpbjFfY2JSZW1lbWJlck1lZAIGDw8WAh8CBWMvTXlBY2NvdW50X1Bhc3N3b3JkUmVxdWVzdC5hc3B4P3NtPURLQzlPVU1uS0FsZml4UUR3ZVNnRlElM2QlM2QmVEJfaWZyYW1lPXRydWUmaGVpZ2h0PTMwMCZ3aWR0aD00ODBkFgJmDxYCHwEFIUZvcmdvdCB5b3VyIHVzZXJuYW1lIG9yIHBhc3N3b3JkP2QCBw8PFgQfAgUbaHR0cDovL2ZyLnN1cnZleW1vbmtleS5jb20vHwBoZGQCCA8PFgIfAQUHU2lnbiBJbmRkAgkPZBYEAgEPDxYCHwIF9gFodHRwczovL2dyYXBoLmZhY2Vib29rLmNvbS9vYXV0aC9hdXRob3JpemU/Y2xpZW50X2lkPTEyNzcwOTUwMzkzMjA4MSZyZWRpcmVjdF91cmk9aHR0cDovL2ZyLnN1cnZleW1vbmtleS5jb20vYXV0aC5hc2h4P3NtPUZfMmZta0VIeHZIVThGTVVGS0drY0dMWkJydWNPUXJkT1QxWU1oMnN1UGZMU1JfMmZON2hfMmJaenBzdUU1bXhZNVpPTm8mc2NvcGU9ZW1haWwsdXNlcl9iaXJ0aGRheSx1c2VyX2xvY2F0aW9uJmRpc3BsYXk9cG9wdXBkZAICDw8WAh8CBaIGaHR0cHM6Ly93d3cuZ29vZ2xlLmNvbS9hY2NvdW50cy9vOC91ZD9vcGVuaWQubnM9aHR0cDovL3NwZWNzLm9wZW5pZC5uZXQvYXV0aC8yLjAmb3BlbmlkLmNsYWltZWRfaWQ9aHR0cDovL3NwZWNzLm9wZW5pZC5uZXQvYXV0aC8yLjAvaWRlbnRpZmllcl9zZWxlY3Qmb3BlbmlkLmlkZW50aXR5PWh0dHA6Ly9zcGVjcy5vcGVuaWQubmV0L2F1dGgvMi4wL2lkZW50aWZpZXJfc2VsZWN0Jm9wZW5pZC5yZXR1cm5fdG89aHR0cHM6Ly93d3cuc3VydmV5bW9ua2V5LmNvbS9hdXRoLmFzaHg/cGlkPUNXNlUmb3BlbmlkLnJlYWxtPWh0dHBzOi8vKi5zdXJ2ZXltb25rZXkuY29tJm9wZW5pZC5tb2RlPWNoZWNraWRfc2V0dXAmb3BlbmlkLm5zLmF4PWh0dHA6Ly9vcGVuaWQubmV0L3Nydi9heC8xLjAmb3BlbmlkLmF4Lm1vZGU9ZmV0Y2hfcmVxdWVzdCZvcGVuaWQuYXgucmVxdWlyZWQ9ZW1haWwsZmlyc3RuYW1lLGxhc3RuYW1lLGxhbmd1YWdlJm9wZW5pZC5heC50eXBlLmVtYWlsPWh0dHA6Ly9heHNjaGVtYS5vcmcvY29udGFjdC9lbWFpbCZvcGVuaWQuYXgudHlwZS5maXJzdG5hbWU9aHR0cDovL2F4c2NoZW1hLm9yZy9uYW1lUGVyc29uL2ZpcnN0Jm9wZW5pZC5heC50eXBlLmxhc3RuYW1lPWh0dHA6Ly9heHNjaGVtYS5vcmcvbmFtZVBlcnNvbi9sYXN0Jm9wZW5pZC5heC50eXBlLmxhbmd1YWdlPWh0dHA6Ly9heHNjaGVtYS5vcmcvcHJlZi9sYW5ndWFnZSZvcGVuaWQubnMudWk9aHR0cDovL3NwZWNzLm9wZW5pZC5uZXQvZXh0ZW5zaW9ucy91aS8xLjAmb3BlbmlkLnVpLm1vZGU9cG9wdXAmb3BlbmlkLnVpLmljb249dHJ1ZWRkAgsPZBYEZg8PFgIfAgX2AWh0dHBzOi8vZ3JhcGguZmFjZWJvb2suY29tL29hdXRoL2F1dGhvcml6ZT9jbGllbnRfaWQ9MTI3NzA5NTAzOTMyMDgxJnJlZGlyZWN0X3VyaT1odHRwOi8vZnIuc3VydmV5bW9ua2V5LmNvbS9hdXRoLmFzaHg/c209Rl8yZm1rRUh4dkhVOEZNVUZLR2tjR0xaQnJ1Y09RcmRPVDFZTWgyc3VQZkxTUl8yZk43aF8yYlp6cHN1RTVteFk1Wk9ObyZzY29wZT1lbWFpbCx1c2VyX2JpcnRoZGF5LHVzZXJfbG9jYXRpb24mZGlzcGxheT1wb3B1cGRkAgEPDxYCHwIFogZodHRwczovL3d3dy5nb29nbGUuY29tL2FjY291bnRzL284L3VkP29wZW5pZC5ucz1odHRwOi8vc3BlY3Mub3BlbmlkLm5ldC9hdXRoLzIuMCZvcGVuaWQuY2xhaW1lZF9pZD1odHRwOi8vc3BlY3Mub3BlbmlkLm5ldC9hdXRoLzIuMC9pZGVudGlmaWVyX3NlbGVjdCZvcGVuaWQuaWRlbnRpdHk9aHR0cDovL3NwZWNzLm9wZW5pZC5uZXQvYXV0aC8yLjAvaWRlbnRpZmllcl9zZWxlY3Qmb3BlbmlkLnJldHVybl90bz1odHRwczovL3d3dy5zdXJ2ZXltb25rZXkuY29tL2F1dGguYXNoeD9waWQ9Q1c2VSZvcGVuaWQucmVhbG09aHR0cHM6Ly8qLnN1cnZleW1vbmtleS5jb20mb3BlbmlkLm1vZGU9Y2hlY2tpZF9zZXR1cCZvcGVuaWQubnMuYXg9aHR0cDovL29wZW5pZC5uZXQvc3J2L2F4LzEuMCZvcGVuaWQuYXgubW9kZT1mZXRjaF9yZXF1ZXN0Jm9wZW5pZC5heC5yZXF1aXJlZD1lbWFpbCxmaXJzdG5hbWUsbGFzdG5hbWUsbGFuZ3VhZ2Umb3BlbmlkLmF4LnR5cGUuZW1haWw9aHR0cDovL2F4c2NoZW1hLm9yZy9jb250YWN0L2VtYWlsJm9wZW5pZC5heC50eXBlLmZpcnN0bmFtZT1odHRwOi8vYXhzY2hlbWEub3JnL25hbWVQZXJzb24vZmlyc3Qmb3BlbmlkLmF4LnR5cGUubGFzdG5hbWU9aHR0cDovL2F4c2NoZW1hLm9yZy9uYW1lUGVyc29uL2xhc3Qmb3BlbmlkLmF4LnR5cGUubGFuZ3VhZ2U9aHR0cDovL2F4c2NoZW1hLm9yZy9wcmVmL2xhbmd1YWdlJm9wZW5pZC5ucy51aT1odHRwOi8vc3BlY3Mub3BlbmlkLm5ldC9leHRlbnNpb25zL3VpLzEuMCZvcGVuaWQudWkubW9kZT1wb3B1cCZvcGVuaWQudWkuaWNvbj10cnVlZGQYAQUeX19Db250cm9sc1JlcXVpcmVQb3N0QmFja0tleV9fFgEFFndjX0xvZ2luMSRjYlJlbWVtYmVyTWW3VS0aqBHM6NAwkjlF+1jS1y2i+A==",
    "__EVENTARGUMENT" => "",
	"__EVENTTARGET" => "",
	"wc_Login1$txtUsername" => "aulm",	
	"wc_Login1$txtPassword" => "piimt2006",	
	"wc_Login1$txtPassword" => "0",	
	"wc_Login1$hdDirectToPro" => "0",			
);
 
// send a request to example.com (referer = jonasjohn.de)
list($header, $content) = PostRequest(
    "https://fr.surveymonkey.com/MyAccount_Login.aspx",
    "https://fr.surveymonkey.com/MyAccount_Login.aspx",
    $data
);
 
// print the result of the whole request:
print $content;
 
// print $header; --> prints the headers

?>
</body>
</html>
