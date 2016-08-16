<?php
/********************************************************************************
Copyright (c) 2016 Chris Knoll, Kimberly Praxel, Nicole Bassen, & Sergio Ramirez.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
********************************************************************************/
?>
<div class="container">
  <div class="panel panel-default profile">
    <div class="panel-heading">
      <h3 class="panel-title">
        Success
      </h3>
    </div>
    <div class="panel-body">
      Event successfully added!
      <?php echo "<br /><br /><div class='text-center'><a href='" . $_SERVER["URI"] . "/org_details.php?id=" . $user->getOrgId() . "' class='btn btn-primary'>Back To My Organization</a></div>"; ?>
    </div>
  </div>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/inc/footer.php'); ?>
