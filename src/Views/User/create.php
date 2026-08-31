<h2>Create new user</h2>
<div class="row">
    <div class="col">&nbsp;</div>
    <div class="col">
        <form method="post" action="" >
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
                <select class="form-select" aria-label="Default select example" name="role">
                    <option selected>Pick role from list</option>
                    <option value="1">Admin</option>
                    <option value="2">Power</option>
                    <option value="3">User</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
    <div class="col">&nbsp;</div>
</div>