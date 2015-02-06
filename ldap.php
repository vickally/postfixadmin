<?php
#added by vicky
#lot's of work to do



function ldap_domain_add($arr,$ldap)
{
	global $CONF;
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
	#$dn = "vd=" . $new_array['vd'] . ",ou=virtual," . $CONFVicky['database_name'] ;
	$dn = "vd=" . $new_array['vd'] . ",ou=virtual,".$CONF['database_name'];
	
$ldap_dn = "cn=admin," . $CONF['database_name'];
$password = "postfix";
	$bind = ldap_bind($ldap, $ldap_dn, $password);
	$a = ldap_add($ldap, $dn, $new_array);

}

#ldap admin add
function ldap_admin_add($arr,$ldap)
{
	global $CONF;
	#Mapping of Sql query to Ldap 
	foreach($arr as $key => $value) {
		if ($key == "username" )
		{		
			$new_array["mail"] = str_replace("'", '', $value);
			$new_array["cn"] = str_replace("'", '', $value);
			$new_array["sn"] = str_replace("'", '', $value);
		}
		if ($key == "password" )
		{		
			$new_array["userPassword"] = str_replace("'", '', $value);
		}
		if ($key == "superadmin" )
		{		
			$new_array["maxDomain"] = str_replace("'", '', $value);
		}
/*		if ($key == "quota" )
		{		
			$new_array["quota"] = str_replace("'", '', $value);
		}*/
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
	$new_array["objectClass"]["1"] = "VirtualAdmin";
	$new_array["objectClass"]["2"] = "person";
	$dn = "mail=" . $new_array["mail"] . ",ou=virtual,".$CONF['database_name'];
	
	$ldap_dn = $CONF['database_user'];
	$password = $CONF['database_password'];
	$bind = ldap_bind($ldap, $ldap_dn, $password);
	 if(ldap_add($ldap, $dn, $new_array)){ 
	 return TRUE;
	 } else {
	 return FALSE;
	 }
}

#ldap domain select
#arr of string and connection
function ldap_domain_select($arr,$ldap)
{
	global $CONF;
	$base = "ou=virtual,".$CONF['database_name'];
	$filter = $arr["filter"];
	//$filter = "vd=example.com";
	$justthese = array($arr['what']);
	$result = ldap_search($ldap, $base, $filter, $justthese);
	return $result;
	//exit;
}

#ldap domain admin select
#arr of string and connection
function ldap_domainsadmin_select($arr,$ldap)
{
	global $CONF;
	$base = "ou=virtual,".$CONF['database_name'];
	$filter = $arr["filter"];
	//$filter = "vd=example.com";
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
	$info = ldap_get_entries($ldap, $result);
	return $result;
}

#ldap mailbox select
#arr of string and connection
function ldap_effected_rows($result)
{
	global $CONF;
	if ($result) {
	 return 1;
	} else {
	 return FALSE;
	}
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
	} elseif ( $l_arr["0"] == "INSERT" && $l_arr["2"] == "admin") {
                $key = str_replace(array( '(', ')' ), '', $l_arr["3"]);
                $value = str_replace(array( '(', ')' ), '', $l_arr["5"]);
                $a = explode("," ,$key);
                $b = explode("," ,$value);
                $c = array_combine($a, $b);
	//	print $string;
                $result = ldap_admin_add($c, $link);
	} elseif ( $l_arr["0"] == "SELECT" && $l_arr["3"] == "domain") {
		if ($l_arr["1"] == "domain"){
			$c["what"] = "vd";
		} else {
			$c["what"] = $l_arr["1"];
		}
		$c["f_where"] = $l_arr["3"];
		#make a condition
  		$where_filter = explode("WHERE", $string);
			if ( preg_match("/order by/i", $where_filter["1"]) ){
  				$where_filter = explode("ORDER BY", $where_filter["1"]);
				$where_value = $where_filter["0"];	
			} else {
				$where_value = $where_filter["1"];	
			}
		$c_value = str_replace("domain","vd",$where_value);
		$c["filter"] = str_replace(array("'"," "),"",$c_value);
			if ( preg_match("/!/", $c["filter"]) ){
				$c_filter = str_replace("!","",$c["filter"]);
				$c["filter"] = "(!($c_filter))";
			}
		#need to check; should be change first match only 
		$result = ldap_domain_select($c, $link);
	} elseif ( $l_arr["0"] == "SELECT" && $l_arr["3"] == "domain_admins") {
		if ($l_arr["1"] == "username"){
			$c["what"] = "mail";
		} else {
			$c["what"] = $l_arr["1"];
		}
		$c["f_where"] = $l_arr["3"];
		#make a condition
  		$where_filter = explode("WHERE", $string);
		$c_value = str_replace("domain","vd",$where_filter["1"]);
		$c_value_tmp = str_replace("username","mail",$c_value);
                $c["filter"] = str_replace(array( '(', ')',"'" ), '', $c_value_tmp);
			if ( preg_match("/and/i", $c['filter']) ){
				$c_filter = explode("AND",$c["filter"]);
				$c["filter"] = "(&($c_filter[0])($c_filter[1]))";
			}
                $result = ldap_domainsadmin_select($c, $link);
	} elseif ( $l_arr["0"] == "SELECT" && ( $l_arr["3"] == "admin"  || $l_arr["3"] == "mailbox") ) {
		if ($l_arr["1"] == "password"){
			$c["what"] = "userPassword";
		} else {
			$c["what"] = $l_arr["1"];
		}
		$c["f_where"] = $l_arr["3"];
                $l_arr["5"] = str_replace(array( "'" ), '', $l_arr["5"]);
		if ($value=preg_replace("/username/", "mail$2", $l_arr[5],1)){
		$c["filter"] = $value;
		}
		$result = ldap_mailbox_select($c, $link);
	#just for the checking; will recify later
	} elseif( preg_match("/(group by|delete)/i", $string) ){
		$result = "TRUE";
	#No use for insert domain in domain_admins
	} elseif( preg_match("/(INSERT INTO domain_admins|INSERT INTO log)/i", $string) ){
		$result = "TRUE";
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
