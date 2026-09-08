<?php 
/** @var array $roles */
?>
<h2>Create new user</h2>
<div class="row">
    <div class="col">&nbsp;</div>
    <div class="col">
        <form method="post" action="">
            <div class="mb-3">
                <label for="username" class="form-label">User name</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="passwordConfirm" class="form-label">Confirm password</label>
                <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm">
            </div>
            <div class="mb-3">
                <label for="role_id" class="form-label">User role</label>
                <select class="form-select" aria-label="Please select from the list" name="role_id">
                    <option value="0" selected>Pick role from list</option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= $role['id'] ?>"><?= $role['role'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
    <div class="col">&nbsp;</div>
</div>