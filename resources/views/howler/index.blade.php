<html>
<head>
    <title>

    </title>
    <script src="/howler/bower_components/howler.js/howler.min.js"></script>
</head>
<div id='center' style="border:1px solid black;border-radius: 25px;background-color: red;width: 50px;height: 50px;position:absolute;left: 500px;top:300px"></div>
<body>
<script>
    var timer = function (code,mils)
    {
        setTimeout(timer(code,mils),mils);
    }
    var sound = new Howl({
        urls: ['/audios/ninelie.mp3'],
        autoplay: true,
        loop: true,
        volume: 0.8,
        onend: function() {
            console.log('Finished!');
        }
    });
    timer('sound.pos3d(Math.random(),Math.random(),Math.random());',500);
</script>
</body>
</html>