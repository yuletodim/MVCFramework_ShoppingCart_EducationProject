<div class="col-lg-6" ng-controller="LoginController">
    <div class="well bs-component">
        <form class="form-horizontal" method="post">
            <legend>Login</legend>

            <div class="form-group">
                <label for="username" class="col-lg-2 control-label">Username</label>
                <div class="col-lg-10">
                    <input class="form-control" name="username" placeholder="Username" type="text" required />
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-lg-2 control-label">Password</label>
                <div class="col-lg-10">
                    <input class="form-control" name="password" placeholder="Password" type="password" required />
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button name="login" class="btn btn-primary">Login</button>
                </div>
            </div>
        </form>
    </div>
</div>