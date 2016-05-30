<html>
<head>
    <title>

    </title>
    <script src="/howler/bower_components/howler.js/howler.min.js"></script>
</head>
<div id='center' style="border:1px solid black;border-radius: 25px;background-color: red;width: 50px;height: 50px;position:absolute;left: 500px;top:300px"></div>
<body>
<script>
    var x, y,z=0;
    var mils=10000000000;
    var sound = new Howl({
        urls: ['/audios/ninelie.mp3'],
        autoplay: true,
        loop: true,
        volume: 0.8,
        onend: function() {
            console.log('Finished!');
        }
    });
    sound.pos3d(x=Math.random()*0.5,y=Math.random()*(-0.5),0.1);
    console.debug(x,y,z);
</script>
</body>
</html>