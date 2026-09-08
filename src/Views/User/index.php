<?php /** @var array $data */ ?>
<h1>List of users</h1>
<p class="px-3 text-end"><a href="/admin/user/create" class="btn btn-primary">Create new user</a></p>
<table class="table table-striped table-hover table-bordered">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">username</th>
      <th scope="col">created</th>
      <th scope="col">modified</th>
      <th scope="col">role</th>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $user): ?>
        <tr>
            <th scope="row"><?= $user['id'] ?></th>
            <td><?= $user['username'] ?></td>
            <td><?= $user['created'] ?></td>
            <td><?= $user['modified'] ?></td>
            <td><?= $user['role_id'] ?></td>
            <td><a href="/admin/user/<?= $user['id'] ?>/update/">Edit</a></td>
            <td><a href="/admin/user/delete/<?= $user['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a></td> 
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>