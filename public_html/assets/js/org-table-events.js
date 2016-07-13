function disableAdminView() {
  $('.adminTableView').hide();
}

function enableAdminView() {
  $('.adminTableView').show();
}

function deleteRow(org_id) {
  $.ajax({
    type: "POST",
    url: '../inc/db_functions/delete-organization.php',
    data:{rowId:org_id},
    success:function() {
      alert(org_id);
    }
  });
}
