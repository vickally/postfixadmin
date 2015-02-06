<?php
#added by vicky
##lot's of work to do

global $CONF;

$ds = ldap_connect("localhost");  // assuming the LDAP server is on this host
if ($CONF['database_type'] == "ldap") {
        if (function_exists ("ldap_connect")){
                        if(!isset($CONF['database_port'])) {
                                $CONF['database_port'] = '389';
                        }
                $ds = @ldap_connect($CONF['database_host']) or $error_text .= ("<p />DEBUG INFORMATION:<br />Connect: failed to connect to database. $DEBUG_TEXT");

        }


if ($ds) {
    // bind with appropriate dn to give update access
    $r = ldap_bind($ds, $CONF['database_user'], $CONF['database_password']);

    // prepare data
    // for base
    $info["dc"] = "example";
    $info["objectclass"]["0"] = "top";
    $info["objectclass"]["1"] = "domain";
    //$dn = "" . $CONF['database_name'];

    // add data to directory
    //$r = ldap_add($ds, "$dn", $info);

    // preare for virtual
    $info["ou"] = "virtual";
    $info["objectclass"]["0"] = "top";
    $info["objectclass"]["1"] = "organizationalUnit";
    $dn = "ou=virtual," . $CONF['database_name'];
    // add data to directory
    $r = ldap_add($ds, "$dn", $info);


    // perpare for domain
	$dn="vd=ALL,ou=virtual," . $CONF['database_name'];
    $info["objectclass"]["0"] = "top";
    $info["objectclass"]["1"] = "VirtualDomain";
    $info["vd"] = "ALL";
    $info["description"] = "";
    $info["maxAlias"] = "0";
    $info["maxMail"] = "0";
    $info["maxQuota"] = "0";
    $info["postfixTransport"] = "virtual";
    $info["delete"] = "FALSE";
    $info["accountActive"] = "TRUE";
    $info["lastChange"] = time();
    // add data to directory
    $r = ldap_add($ds, "$dn", $info);



    ldap_close($ds);
} else {
    echo "Unable to connect to LDAP server";
}


?>
