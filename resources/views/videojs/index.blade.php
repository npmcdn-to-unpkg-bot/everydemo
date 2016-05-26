<html>
<head>
    <meta charset="utf-8">
    <title>video.js demo</title>
    <link rel="stylesheet" href="/videojs/bower_components/video.js/dist/video-js.min.css">
    <script rel="script" src="/videojs/bower_components/video.js/dist/video.min.js"></script>
</head>
<body>
<video id="really-cool-video" class="video-js vjs-default-skin" controls
       preload="auto" width="640" height="264" poster="images/Three.bmp"
       data-setup='{}'>
    <source src="/video/demo.mp4" type="video/mp4">
    <p class="vjs-no-js">
        To view this video please enable JavaScript, and consider upgrading to a web browser
        that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
    </p>
</video>
</body>
<script>
    $(document).foundation();
    //    If you don't want to use auto-setup, you can leave off the data-setup attribute and initialize a video element manually.
    var player = videojs('really-cool-video', { /* Options */ }, function() {
        this.play(); // if you don't trust autoplay for some reason
        // How about an event listener?
        this.on('ended', function() {});
    });
</script>
</html>