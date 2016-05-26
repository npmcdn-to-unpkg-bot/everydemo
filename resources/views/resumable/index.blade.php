<html>
<head>
    <meta charset="utf-8">
    <title>upload page</title>
    <link rel="stylesheet" href="/bower_components/foundation/css/normalize.min.css">
    <link rel="stylesheet" href="/bower_components/foundation-sites/dist/foundation.css">
    <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
    <script rel="script" src="/bower_components/jquery/dist/jquery.min.js"></script>
    <script rel="script" src="/bower_components/fastclick/lib/fastclick.js"></script>
    <script rel="script" src="/bower_components/foundation-sites/dist/foundation.min.js"></script>
    <script rel="script" src="/resumable/bower_components/resumable.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="container">
        <h1>Upload page<small>trying to build it</small></h1>
    </div>
    <form id='mf' enctype="multipart/form-data">
        <div class="container">
            <div class="row middle">
                <div class="columns">
                    <a href="#" id="fileSelect">
                        <i class="fa fa-upload fa-4x"></i>
                    </a>
                </div>
                <div class="columns">
                    <button class="button" id="submit">提交</button>
                </div>
            </div>
            {{--style="display:none"--}}
            <input type="file" id="fileElem" multiple  >
            <input id="_token" type="hidden" name="_token" value="{!! csrf_token() !!}">
        </div>
    </form>
    <input id="progress" type="text"  value=0>
    <script>
        $(document).foundation();
        var token = document.getElementById('_token');
        var r = new Resumable({
            target:'/rsup',
            uploadMethod:'POST',
            testMethod:'POST',
            testChunks:false,
            query:{_token:token.value},
//          target:,
//          The target URL for the multipart POST request. This can be a string or a function that allows you you to construct and return a value, based on supplied params. (Default: /)
//          chunkSize:,
//          The size in bytes of each uploaded chunk of data. The last uploaded chunk will be at least this size and up to two the size, see Issue #51 for details and reasons. (Default: 1*1024*1024)
//          forceChunkSize:,
//          Force all chunks to be less or equal than chunkSize. Otherwise, the last chunk will be greater than or equal to chunkSize. (Default: false)
//          simultaneousUploads:,
//          Number of simultaneous uploads (Default: 3)
//          fileParameterName:,
//          The name of the multipart POST parameter to use for the file chunk (Default: file)
//          chunkNumberParameterName:,
//          The name of the chunk index (base-1) in the current upload POST parameter to use for the file chunk (Default: resumableChunkNumber)
//          totalChunksParameterName:,
//          The name of the total number of chunks POST parameter to use for the file chunk (Default: resumableTotalChunks)
//          chunkSizeParameterName:,
//          The name of the general chunk size POST parameter to use for the file chunk (Default: resumableChunkSize)
//          totalSizeParameterName:,
//          The name of the total file size number POST parameter to use for the file chunk (Default: resumableTotalSize)
//          identifierParameterName:,
//          The name of the unique identifier POST parameter to use for the file chunk (Default: resumableIdentifier)
//          fileNameParameterName:,
//          The name of the original file name POST parameter to use for the file chunk (Default: resumableFilename)
//          relativePathParameterName:,
//          The name of the file's relative path POST parameter to use for the file chunk (Default: resumableRelativePath)
//          currentChunkSizeParameterName:,
//          The name of the current chunk size POST parameter to use for the file chunk (Default: resumableCurrentChunkSize)
//          typeParameterName:,
//          The name of the file type POST parameter to use for the file chunk (Default: resumableType)
//          query:,
//          Extra parameters to include in the multipart POST with data. This can be an object or a function. If a function, it will be passed a ResumableFile and a ResumableChunk object (Default: {})
//          testMethod:,
//          Method for chunk test request. (Default: 'GET')
//          uploadMethod:,
//          Method for chunk upload request. (Default: 'POST')
//          parameterNamespace:,
//          Extra prefix added before the name of each parameter included in the multipart POST or in the test GET. (Default: '')
//          headers:,
//          Extra headers to include in the multipart POST with data. This can be an object or a function that allows you to construct and return a value, based on supplied file (Default: {})
//          method:,
//          Method to use when POSTing chunks to the server (multipart or octet) (Default: multipart)
//          prioritizeFirstAndLastChunk:,
//          Prioritize first and last chunks of all files. This can be handy if you can determine if a file is valid for your service from only the first or last chunk. For example, photo or video meta data is usually located in the first part of a file, making it easy to test support from only the first chunk. (Default: false)
//          testChunks:,
//          Make a GET request to the server for each chunks to see if it already exists. If implemented on the server-side, this will allow for upload resumes even after a browser crash or even a computer restart. (Default: true)
//          preprocess:,
//          Optional function to process each chunk before testing & sending. Function is passed the chunk as parameter, and should call the preprocessFinished method on the chunk when finished. (Default: null)
//          generateUniqueIdentifier:,
//          Override the function that generates unique identifiers for each file. (Default: null)
//          maxFiles:,
//          Indicates how many files can be uploaded in a single session. Valid values are any positive integer and undefined for no limit. (Default: undefined)
//          maxFilesErrorCallback(files, errorCount):,
//          A function which displays the please upload n file(s) at a time message. (Default: displays an alert box with the message Please n one file(s) at a time.)
//          minFileSize:,
//          The minimum allowed file size. (Default: undefined)
//          minFileSizeErrorCallback(file, errorCount):,
//          A function which displays an error a selected file is smaller than allowed. (Default: displays an alert for every bad file.)
            maxFileSize:10*1024*1024,
//          The maximum allowed file size. (Default: undefined)
            maxFileSizeErrorCallback:function(file, errorCount){
                alert("文件太大了，请上传"+this.maxFileSize/1024/1024+"MiB大小以内的文件!");
            },
//          A function which displays an error a selected file is larger than allowed. (Default: displays an alert for every bad file.)
            fileType:["mp4","avi","flac"],
//          The file types allowed to upload. An empty array allow any file type. (Default: [])
            fileTypeErrorCallback:function(file, errorCount){
                alert("请上传正确文件!");
            },
//          A function which displays an error a selected file has type not allowed. (Default: displays an alert for every bad file.)
//          maxChunkRetries:,
//          The maximum number of retries for a chunk before the upload is failed. Valid values are any positive integer and undefined for no limit. (Default: undefined)
//          chunkRetryInterval:,
//          The number of milliseconds to wait before retrying a chunk on a non-permanent error. Valid values are any positive integer and undefined for immediate retry. (Default: undefined)
//          withCredentials:,
//          Standard CORS requests do not send or set any cookies by default. In order to include cookies as part of the request, you need to set the withCredentials property to true. (Default: false)
//
        });

        //        Events
        //
        //                .fileSuccess(file) A specific file was completed.
        //                .fileProgress(file) Uploading progressed for a specific file.
        //                .fileAdded(file, event) A new file was added. Optionally, you can use the browser event object from when the file was added.
        //                .filesAdded(array) New files were added.
        //                .fileRetry(file) Something went wrong during upload of a specific file, uploading is being retried.
        //                .fileError(file, message) An error occurred during upload of a specific file.
        //                .uploadStart() Upload has been started on the Resumable object.
        //                .complete() Uploading completed.
        //                .progress() Uploading progress.
        //                .error(message, file) An error, including fileError, occurred.
        //                .pause() Uploading was paused.
        //                .beforeCancel() Triggers before the items are cancelled allowing to do any processing on uploading files.
        //                .cancel() Uploading was canceled.
        //                .chunkingStart(file) Started preparing file for upload
        //                                                                        .chunkingProgress(file,ratio) Show progress in file preparation
        //                .chunkingComplete(file) File is ready for upload
        //                                                                  .catchAll(event, ...) Listen to all the events listed above with the same callback function.
        //
        //        ResumableFile
        //        Properties
        //
        //                .resumableObj A back-reference to the parent Resumable object.
        //                .file The correlating HTML5 File object.
        //                .fileName The name of the file.
        //                .relativePath The relative path to the file (defaults to file name if relative path doesn't exist)
        //                .size Size in bytes of the file.
        //                .uniqueIdentifier A unique identifier assigned to this file object. This value is included in uploads to the server for reference, but can also be used in CSS classes etc when building your upload UI.
        //                .chunks An array of ResumableChunk items. You shouldn't need to dig into these.
        //
        //        Methods
        //
        //                .progress(relative) Returns a float between 0 and 1 indicating the current upload progress of the file. If relative is true, the value is returned relative to all files in the Resumable.js instance.
        //                .abort() Abort uploading the file.
        //                .cancel() Abort uploading the file and delete it from the list of files to upload.
        //                .retry() Retry uploading the file.
        //                .bootstrap() Rebuild the state of a ResumableFile object, including reassigning chunks and XMLHttpRequest instances.
        //                .isUploading() Returns a boolean indicating whether file chunks is uploading.
        //                .isComplete() Returns a boolean indicating whether the file has completed uploading and received a server response.

        r.assignBrowse(document.getElementById('fileElem'));

        r.on('fileSuccess', function(file){
            alert("上传成功!");
        });

        r.on('fileProgress', function(file,event){
            var p = document.getElementById("progress");
            p.setAttribute("value",this.progress(false)*100+"%");
//            console.debug(this.progress(false));
        });

        //单文件
        r.on('fileAdded', function(file, event){
            r.upload();
            //console.debug(file, event);
        });
        //多文件上传
        r.on('filesAdded', function(array){
            //console.debug(array);
        });

        r.on('fileRetry', function(file){
            //console.debug(file);
        });

        r.on('fileError', function(file, message){
//            console.debug(file, message);
        });

        r.on('uploadStart', function(){
            //console.debug();
        });

        r.on('complete', function(){
            //console.debug();
        });

        r.on('progress', function(){
            //console.debug();
        });

        r.on('error', function(message, file){
            //console.debug(message, file);
        });

        r.on('pause', function(){
            //console.debug();
        });

        r.on('cancel', function(){
            //console.debug();
        });
    </script>
</div>
</body>
</html>
