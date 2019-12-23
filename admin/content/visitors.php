<?php
$visitor_list = $visitors->readAllVisitors();
?>

<div class="member-card card">
  <h4>View All Visitors</h4>

  <table id="visitor-table" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
      <th>Id</th>
      <th>Full Name</th>
      <th>Role</th>
      <th>Email</th>
      <th>Date</th>
      <th>Browser</th>
      <th>IP</th>
      <th>OS</th>
    </tr>
    </thead>
    <tbody>
    <?php
      foreach ($visitor_list as $item) { ?>
        <tr>
          <td><?=$item['user_id']?></td>
          <td><?=$item['full_name']?></td>
          <td><?=$item['role']?></td>
          <td><?=$item['email']?></td>
          <td><?=$item['created_at']?></td>
          <td><?=$item['browser']?></td>
          <td><?=$item['ip']?></td>
          <td><?=$item['os']?></td>
        </tr>
     <?php }
    ?>
    </tbody>
  </table>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#visitor-table').DataTable({
      "aLengthMenu": [[50, 100, 250, 500, 1000], [50, 100, 250, 500, 1000]],
      "iDisplayLength": 50,
      "order": []
    });
  });
</script>