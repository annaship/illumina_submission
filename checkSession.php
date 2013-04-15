<?php

if (!isset($_SESSION)) {
  session_start();
}

function checkSession()
{
  $user = '';
  $user = $_SESSION['authenticatedUser'];
  $security_level = $_SESSION['authenticatedSecurityLevel'];
  
  if(!$user)
  {
    $user = $HTTP_SESSION_VARS['authenticatedUser'];
    $security_level = $_SESSION['authenticatedSecurityLevel'];
  }
  
  //
  // This appears to be legacy code and may no longer be needed.
  // Please see bug # 0000090
  //
  //take this out when all is synced
  if(!$user) {
    $user = $_SERVER['PHP_AUTH_USER'];
    $_SESSION['authenticatedUser'] == $user;
    $_SESSION['authenticatedSecurityLevel'] = 50;
    if (
      $user == 'big_visual'
      ||
      $user == 'Sue'
      ||
      $user == 'sogin'
      ||
      $user == 'dmwelch'
      ||
      $user == 'avoorhis'
      ||
      $user == 'jhuber'
    ) {
      $_SESSION['authenticatedSecurityLevel'] = 1;
    }
  }
  
  if(!$user)
  {
    $loc = 'Location: /utils/login.php';
    header($loc);
    exit; // Exit, we've issued a redirect to a different page.
  }
  return $user;
}
?>
