<?php
/********************************************************************************
Copyright (c) 2016 Chris Knoll, Kimberly Praxel, Nicole Bassen, & Sergio Ramirez.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
********************************************************************************/

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
