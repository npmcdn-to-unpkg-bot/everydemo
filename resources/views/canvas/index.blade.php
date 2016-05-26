<html>
<head>
    <script src="/canvas/bower_components/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <script src="/canvas/bower_components/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <script src="/canvas/bower_components/push.js/push.js"></script>
    <script src="/canvas/bower_components/JavaScript-MD5/js/md5.min.js"></script>
</head>
<body>
<input id="file-input" type="file" alt="选择文件">

<script>
    //    Options
    //
    //    The optional third argument to loadImage() is a map of options:
    //
    //            maxWidth: Defines the maximum width of the img/canvas element.
    //            maxHeight: Defines the maximum height of the img/canvas element.
    //            minWidth: Defines the minimum width of the img/canvas element.
    //            minHeight: Defines the minimum height of the img/canvas element.
    //            sourceWidth: The width of the sub-rectangle of the source image to draw into the destination canvas.
    //            Defaults to the source image width and requires canvas: true.
    //            sourceHeight: The height of the sub-rectangle of the source image to draw into the destination canvas.
    //            Defaults to the source image height and requires canvas: true.
    //            top: The top margin of the sub-rectangle of the source image.
    //            Defaults to 0 and requires canvas: true.
    //            right: The right margin of the sub-rectangle of the source image.
    //            Defaults to 0 and requires canvas: true.
    //            bottom: The bottom margin of the sub-rectangle of the source image.
    //            Defaults to 0 and requires canvas: true.
    //            left: The left margin of the sub-rectangle of the source image.
    //            Defaults to 0 and requires canvas: true.
    //            contain: Scales the image up/down to contain it in the max dimensions if set to true.
    //            This emulates the CSS feature background-image: contain.
    //            cover: Scales the image up/down to cover the max dimensions with the image dimensions if set to true.
    //            This emulates the CSS feature background-image: cover.
    //            aspectRatio: Crops the image to the given aspect ratio (e.g. 16/9).
    //    Setting the aspectRatio also enables the crop option.
    //            pixelRatio: Defines the ratio of the canvas pixels to the physical image pixels on the screen.
    //            Should be set to window.devicePixelRatio unless the scaled image is not rendered on screen.
    //            Defaults to 1 and requires canvas: true.
    //            downsamplingRatio: Defines the ratio in which the image is downsampled.
    //            By default, images are downsampled in one step. With a ratio of 0.5, each step scales the image to half the size, before reaching the target dimensions.
    //            Requires canvas: true.
    //            crop: Crops the image to the maxWidth/maxHeight constraints if set to true.
    //            Enabling the crop option also enables the canvas option.
    //            orientation: Allows to transform the canvas coordinates according to the EXIF orientation specification.
    //            Setting the orientation also enables the canvas option.
    //            canvas: Returns the image as canvas element if set to true.
    //            crossOrigin: Sets the crossOrigin property on the img element for loading CORS enabled images.
    //            noRevoke: By default, the created object URL is revoked after the image has been loaded, except when this option is set to true.

    //Load Image
    var canvas=null;
    var callback = function (img) {
        canvas = img;
        document.body.appendChild(img);
    };
    var options= {
        maxWidth: 600,
        maxHeight: 300,
        minWidth: 100,
        minHeight: 50,
        canvas: true
    };

    document.getElementById('file-input').onchange = function (e) {
        canvas = loadImage(
                e.target.files[0],
                callback,
                options // Options
        );
        console.debug(canvas);
        loadImage.parseMetaData(
                e.target.files[0],
                function (data) {
                    if (!data.imageHead) {
                        return;
                    }
                    if(data.exif) {
                        var allTags = data.exif.getAll();
                        console.debug(allTags);
                    }
                    // Combine data.imageHead with the image body of a resized file
                    // to create scaled images with the original image meta data, e.g.:
                    var blob = new Blob([
                        data.imageHead,
                        // Resized images always have a head size of 20 bytes,
                        // including the JPEG marker and a minimal JFIF header:
//                        loadImage.blobSlice.call(resizedImage, 20)
                    ], {type: 'jpeg'});
                },
                {
                    maxMetaDataSize: 262144,
                    disableImageHead: false
                }
        );
        const getVisualCenter = require('visual-center');
        getVisualCenter(canvas.toDataURL(),function(err, result) {
            /*
             results in an object with the data as:
             {
             visualTop: <Visual center for Y axis, from 0 to 1>
             visualLeft: <Visual center for X axis, from 0 to 1>
             bgColor: <The background color that we detected>
             width: <The width of the image>
             height: <The height of the image>
             }
             */
            console.debug(result);
        });
        /* ... your canvas manipulations ... */
        if (canvas && canvas.toBlob) {
            canvas.toBlob(
                    function (blob) {
                        // Do something with the blob object,
                        // e.g. creating a multipart form for file uploads:
                        var formData = new FormData();
                        formData.append('file', blob, fileName);
                        document.body.appendChild(formData);
                        /* ... */
                    },
                    'image/jpeg'
            );
        }
        alert(canvas);
    };
    var raw = 'tc940819';
    var hash = md5(raw);
    alert("raw:"+raw+'\n'+"hash:"+hash);
</script>
</body>
</html>
