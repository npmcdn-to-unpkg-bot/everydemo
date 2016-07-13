<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Demo</title>
    <script src="/webvr/aframe.js"></script>
</head>
<body>
<a-scene  stats fog="type: linear; color: #AAA" vr-mode-ui="enabled: false">
    <a-assets>
        <a-asset-item id="obj" src="1.obj"></a-asset-item>
    </a-assets>

<a-videosphere src="" color='#c0c0c0' segments-height="128" segments-width="128" radius="100"></a-videosphere>
    <a-entity position="0 2.2 4">
        <a-entity camera look-controls wasd-controls>
            <a-entity light="color: #fff; intensity: 1.2"></a-entity>
            <a-entity id='cursor' position="0 0 -3"
                      geometry="primitive: ring; radiusOuter: 0.08;radiusInner: 0.05;segmentsTheta:128;segmentsPhi:4;"
                      material="color: cyan; shader: flat;side:double;"
                      cursor="maxDistance: 200; timeout=100;">
                <a-animation id='trigger' begin="0" easing="ease-in" attribute="scale" fill="alternate" from="1.5 1.5 1.5" to="0.5 0.5 0.5   " dur="300"></a-animation>
                <a-animation id='listener' begin="300" easing="ease-out" attribute="scale" fill="alternate" from="1.0 1.0 1.0" to="1.5 1.5 1.5   " dur="300"></a-animation>
            </a-entity>
        </a-entity>
    </a-entity>
    <a-obj-model src='#obj'></a-obj-model>
</a-scene>
<script>
    var scene = document.querySelector('a-scene');
    var trigger = document.querySelector('#trigger');
    var listener = document.querySelector('#listener');
    var cursor = document.querySelector('#cursor');
    //adnimation feedback
    cursor.addEventListener('click',function(){
        console.debug('in');
    });
    var loader = new THREE.ObjectLoader()
    loader.load('/webvr/test3.json',function(obj){
        //search
        for(var node in obj){
            if(node == 'children'){
                var children = obj[node];
                break;
            }
        }
        //if searched pass and have object
        if(children != undefined){
            for(var i=0;i<children.length;i++){
                if(children[i].material!=undefined && children[i].material.hasOwnProperty('lightMap')){
                    children[i].material.map = children[i].material.lightMap;
                }else if(0) {//for extend

                }else {

                }
            }
            //copy to obj
            obj.children = children;
        }
        obj.object3D = obj;
        scene.add(obj);
    });
</script>
</body>
</html>