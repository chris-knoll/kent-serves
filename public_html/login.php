<?php
require('./inc/utilities.inc.php');

try {
  // instantiate a database object
  $dbh = new PDO("mysql:host=localhost; dbname=kentserv_organizations",
  "kentserv_user", "@pple!");
}
catch(PDOException $e) {
  echo $e->getmessage();
}

if (isset($_POST['submit'])) { // Handle login submission

  // Check if the login is in the database:
  $q = 'SELECT id, org_id, user_type, username, email FROM kentserv_organizations.users WHERE email=:email AND password=SHA1(:pass)';
  $statement = $dbh->prepare($q);
  $r = $statement->execute(array(':email' => $_POST['inputEmail'], ':pass' => $_POST['inputPassword']));

  // Try to fetch results:
  if ($r) {
    $statement->setFetchMode(PDO::FETCH_CLASS, 'User');
    $user = $statement->fetch();
  }

  // Store the user in the session and redirect:
  if ($user) {

    // Store in a session:
    $_SESSION['user'] = $user;

    // redirect
    if($user->isAdmin()) {
      header("Location: partnerstable.php");
    } else {
      header("Location: org_details.php?id=" . $user->getOrgId());
    }
    exit;
  }

} // End of form submission IF.

require_once('./inc/header.php');

?>
<div id="headerwrap">
  <div class="container">
    <form class="form-signin" action="" method="post">
      <h2 class="form-signin-heading">Please sign in</h2>
      <?php if(isset($_POST['submit']) && !$user) echo "<div class='input-error'>Email and password not found.</div>"; ?>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" name="inputEmail" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password" required>

      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
    </form>
  </div>
</div>

<?php require_once('./inc/footer.php'); ?>
