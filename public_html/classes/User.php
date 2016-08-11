<?php

class User {
  // All attributes correspond to database columns.
  // All attributes are protected.
  protected $id = null;
  protected $org_id = null;
  protected $user_type = null;
  protected $username = null;
  protected $email = null;
  protected $pass = null;
  protected $dateAdded = null;

  // Method returns the user ID:
  function getId() {
    return $this->id;
  }

  function getOrgId() {
    return $this->org_id;
  }

  function isAdmin() {
    return ($this->user_type == 'admin');
  }

  function canEditOrg($orgIdToEdit) {
    return ($this->isAdmin()) || ($this->org_id == $orgIdToEdit);
  }

  function displayProfile() {
    echo "Email Address: " . $this->email . "<br />";
    echo "User Type: " . $this->user_type . "<br /><br />";
    echo "<div class='text-center'><a href='org_details.php?id=" . $this->getOrgId() . "' class='btn btn-primary'>My Organization</a></div>";
    /*
    echo "Organization ID: ";
      if ($this->user_type == 'organization') {
        echo $this->org_id;
      } else {
        echo "None";
      }
    echo "<br />";
    */
  }

}
