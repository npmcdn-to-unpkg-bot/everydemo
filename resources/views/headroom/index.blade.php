<html>
<head>
    <meta charset="utf-8">
    <title>headroom.js Demo</title>
    <link rel='stylesheet' href='/headroom/bower_components/animate.css/animate.min.css'/>
    <script rel='script' src='/headroom/bower_components/headroom.js/dist/headroom.min.js'></script>
    <style>
        /*初始化样式*/
        .headroom{
            width: 100%;
            height: 100px;
            position: fixed;
            display: block;
            padding: 0;
            margin: 0;
            top:0;
            background-color: red;
        }
        /*页面向上滚动的样式*/
        .headroom--pinned{

        }
        /*页面向下滚动的样式*/
        .headroom--unpinned{
            width: 0;
            height: 0;
            display: none;
            padding: 0;
            margin: 0;
            top:0;
        }
        /*header在顶部的样式*/
        .headroom--top{

        }
        /*header不在顶部的样式*/
        .headroom--not-top{

        }
    </style>
</head>
<body>
<!-- initially -->
<header id="header" class="headroom headroom--top"></header>
<div>
    @for($i=1;$i<=50;++$i)
    <p>{!! 'No.' .$i. ' lines' !!}</p>
    @endfor
    </div>
</body>
<script>
    var header = document.getElementById("header");
    var headroom  = new Headroom(header,{
        // vertical offset in px before element is first unpinned
        //设置一个垂直方向的相对于页面顶端的偏移像素量，元素垂直方向偏移超过这个值就触发unpinned状态，并执行对应的回调函数
        offset : 300,
        // scroll tolerance in px before state changes
        tolerance : 1,
        // or scroll tolerance per direction
        tolerance : {
            down : 0,
            up : 0
        },
        // css classes to apply
        classes : {
            // when element is initialised
            initial : "headroom",
            // when scrolling up
            pinned : "headroom--pinned",
            // when scrolling down
            unpinned : "headroom--unpinned",
            // when above offset
            top : "headroom--top",
            // when below offset
            notTop : "headroom--not-top"
        },
        // callback when pinned, `this` is headroom object
        onPin : function() {

        },
        // callback when unpinned, `this` is headroom object
        onUnpin : function() {

        },
        // callback when above offset, `this` is headroom object
        onTop : function() {

        },
        // callback when below offset, `this` is headroom object
        onNotTop : function() {
            this.ClassName = "animated shake";
        }
    });
    // headroom.options = ;
    // initialise
    headroom.init();
</script>
</html>
