<?php

function name_and_email_from_ldap( $uid ) { 
  $ds=ldap_connect("denise.core.fh-salzburg.ac.at", 389);  
  ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
  ldap_set_option($ds, LDAP_OPT_TIMELIMIT, 2);
  ldap_bind($ds);
  $search_result=ldap_search($ds,"ou=people,ou=urstein,o=fh-salzburg.ac.at,o=FHS", "uid=$uid");
  if (ldap_count_entries($ds, $search_result) !== 1) throw new Exception("Keine Daten zu $uid bekannt.");
  $info = ldap_get_entries($ds, $search_result);
  $common_name = $info[0]["cn"][0];
  $email =  $info[0]["mail"][0];
  ldap_close($ds);
  return [$common_name, $email];
}?>

<!-- Diese Datei ist ein Teil des Multimediaprojektes 1,
 der Fachhochschule Salzburg, Studiengang Multimediatechnology.
Idee und Umsetzung von Elias Cia -->