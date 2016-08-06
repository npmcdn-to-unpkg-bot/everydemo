<html>
<head>
    @include('foundation-site.head',['title'=>'注册/登录测试页面'])
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 center-block">
                <form id="sign" method="post" action="/test/signin">
                    <input name="_token" value="{!! csrf_token() !!}" type="hidden">
                    <div class="input-group">
                        <label for='un' class="input-group-label">昵称</label>
                        <input id='un' name="name" type="text" class="input-group-field" placeholder="ur kick name" required>
                    </div>
                    <div class="input-group">
                        <label for='em' class="input-group-label">邮箱</label>
                        <input id='em' name="email" type="email" class="input-group-field" placeholder="enter ur email address plz" required>
                    </div>
                    <div class="input-group">
                        <label for='up' class="input-group-label">密码</label>
                        <input id='up' name="password" type="password" class="input-group-field" placeholder="one upper alpha plz" required>
                    </div>
                    <button id="submit" class="button">Sign In</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
