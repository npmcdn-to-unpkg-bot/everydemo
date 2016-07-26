<html>
<head>
    @include('foundation-site.head',['title'=>'注册/登录测试页面'])
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 center-block">
                <form id="sign" method="post" action="/test/signin">
                    <input name="_token" value="{!! csrf_token() !!}}" type="hidden">
                    <div class="input-group">
                        <label for='un' class="input-group-label">邮箱</label>
                        <input id='un' name="email" type="email" class="input-group-field" placeholder="enter ur email address plz" required>
                    </div>
                    <div class="input-group">
                        <label for='up' class="input-group-label">密码</label>
                        <input id='up' name="passwd" type="password" class="input-group-field" placeholder="one upper alpha plz" required pattern="[A-Z]([a-z][A-Z][0-9]){7}+">
                    </div>
                    <button id="submit" class="button">Sign In</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>