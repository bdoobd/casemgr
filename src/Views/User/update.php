<?php

/** @var array $roles */
/** @var array $user */
?>
<h2>Update user <?= ucfirst($user['username']) ?></h2>
<?php
// echo '<pre>';
// var_dump($formdata);
// echo '</pre>';
?>
<script defer src="/assets/js/updateUserData.js"></script>
<div class="row">
    <div class="col">&nbsp;</div>
    <div class="col">
        <form method="post" action="">
            <input type="hidden" value="<?= $user['id'] ?>" name="id">
            <div class="mb-3">
                <label for="username" class="form-label">User name</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="role_id" class="form-label">User role</label>
                <select class="form-select" aria-label="Please select from the list" name="role_id" id="role_id">
                    <option value="0" selected>Pick role from list</option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= $role['id'] ?>" <?php if (isset($user['role_id']) && $user['role_id'] === $role['id']) echo 'selected'; ?>><?= $role['role'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input chkSize-1 me-3" type="checkbox" value="" id="reset" name="reset">
                <label class="form-check-label" for="reset">
                    Reset password
                </label>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" disabled>
            </div>
            <div class="mb-3">
                <label for="passwordConfirm" class="form-label">Confirm password</label>
                <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" disabled>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
    <div class="col">&nbsp;</div>
</div>