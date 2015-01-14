<?php
#$string = "INSERT INTO domain (domain,description,aliases,mailboxes,maxquota,quota,transport,backupmx,active,created,modified) VALUES ('ALL','example','10','10','10','2048','virtual','0','1',now(),now())";



function ldap_domain_add($arr,$ldap)
{
	#Mapping of Sql query to Ldap 
	foreach($arr as $key => $value) {
		if ($key == "domain" )
		{		
			$new_array["vd"] = str_replace("'", '', $value);
		}
		if ($key == "description" )
		{		
			$new_array["description"] = str_replace("'", '', $value);
		}
		if ($key == "aliases" )
		{		
			$new_array["maxAlias"] = str_replace("'", '', $value);
		}
		if ($key == "mailboxes" )
		{		
			$new_array["maxMail"] = str_replace("'", '', $value);
		}
		if ($key == "maxquota" )
		{		
			$new_array["maxQuota"] = str_replace("'", '', $value);
		}
/*		if ($key == "quota" )
		{		
			$new_array["quota"] = str_replace("'", '', $value);
		}*/
		if ($key == "transport" )
		{		
			$new_array["postfixTransport"] = str_replace("'", '', $value);
		}
		if ($key == "backupmx" )
		{		
			if ( str_replace("'", '', $value) == "1" ){
			$new_array["delete"] = "TRUE";
			} else {	
			$new_array["delete"] = "FALSE";
			}
		}
		if ($key == "active" )
		{		
			if ( str_replace("'", '', $value) == "1" ){
			$new_array["accountActive"] = "TRUE";
			} else {	
			$new_array["accountActive"] = "FALSE";
			}
		}
		if ($key == "modified" )
		{		
			$new_array["lastChange"] = time();
		}
    	}
	$new_array["objectClass"]["0"] = "top";
	$new_array["objectClass"]["1"] = "virtualdomain";
	#$dn = "vd=" . $new_array['vd'] . ",ou=virtual," . $CONFVick Ally['database_name'] ;
	$dn = "vd=" . $new_array['vd'] . ",ou=virtual,".$CONF['database_name'];
	
$ldap_dn = "cn=admin," . $CONF['database_name'];
$password = "postfix";
	$bind = ldap_bind($ldap, $ldap_dn, $password);
	$a = ldap_add($ldap, $dn, $new_array);

}



#ldap domain select
#arr of string and connection
function ldap_domain_select($arr,$ldap)
{
	global $CONF;
	$base = "ou=virtual,".$CONF['database_name'];
	$filter = "vd=example.com";
	$justthese = array($arr['what']);
	$result = ldap_search($ldap, $base, $filter, $justthese);
	return $result;
	//exit;
}

#ldap mailbox select
#arr of string and connection
function ldap_mailbox_select($arr,$ldap)
{
	global $CONF;
	
	$base = "ou=virtual,".$CONF['database_name'];
	$filter = $arr["filter"];
	$justthese = array($arr['what']);
	$result = ldap_search($ldap, $base, $filter, $justthese);
	#$info = ldap_get_entries($ldap, $result);
	#$info["num_rows"] = $info["count"];
	#$info["result"] = $result;
	return $result;
	//exit;
}

#ldap query return ldap resource
function ldap_query($string,$link)
{
	global $CONF;
//	$ldap_dn = "cn=admin,".$CONF['database_name']";
//	$password = "postfix";

  	$l_arr = explode( " ", $string);
	if ( $l_arr["0"] == "INSERT" && $l_arr["2"] == "domain") {
		$key = str_replace(array( '(', ')' ), '', $l_arr["3"]);
		$value = str_replace(array( '(', ')' ), '', $l_arr["5"]);
		$a = explode("," ,$key);
		$b = explode("," ,$value);
		$c = array_combine($a, $b);
		ldap_domain_add($c, $link);
	} elseif ( $l_arr["0"] == "INSERT" && $l_arr["2"] == "mailbox") {
                $key = str_replace(array( '(', ')' ), '', $l_arr["3"]);
                $value = str_replace(array( '(', ')' ), '', $l_arr["5"]);
                $a = explode("," ,$key);
                $b = explode("," ,$value);
                $c = array_combine($a, $b);
                ldap_mailbox_add($c, $link);
	} elseif ( $l_arr["0"] == "SELECT" && $l_arr["3"] == "domain") {
		print_r("$l_arr");
		if ($l_arr["1"] == "domain"){
			$c["what"] = "vd";
		} else {
			$c["what"] = $l_arr["1"];
		}
		$c["f_where"] = $l_arr["3"];
		$c["filter"] = 'domain=!"ALL"';
		$result = ldap_domain_select($c, $link);
	} elseif ( $l_arr["0"] == "SELECT" && ( $l_arr["3"] == "admin"  || $l_arr["3"] == "mailbox") ) {
		if ($l_arr["1"] == "password"){
			$c["what"] = "userpassword";
		} else {
			$c["what"] = $l_arr["1"];
		}
		$c["f_where"] = $l_arr["3"];
                $l_arr["5"] = str_replace(array( "'" ), '', $l_arr["5"]);
		if ($value=preg_replace("/username/", "mail$2", $l_arr[5],1)){
		$c["filter"] = $value;
		}
		$result = ldap_mailbox_select($c, $link);
	} else {
		print $l_arr["4"];
	}
	return $result;
	
}




#ldap_fetch_array
function ldap_fetch_array ($result){
	$link = db_connect();
	$info = ldap_get_entries($link, $result);
	return $info;
}
#ldap_query($string,$link);


?>
