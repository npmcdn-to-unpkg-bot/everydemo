<html>
<head>
    <meta charset="utf-8">
    <title>test geometry of three.js</title>
    <script rel="script" src="/threejs/bower_components/three.js/build/three.js"></script>
    <script rel="script" src="/threejs/bower_components/stats.js/build/stats.min.js"></script>
    <script rel="script" src="/threejs/bower_components/dat-gui/build/dat.gui.min.js"></script>
</head>
<body>
<script>
    var scene, camera, render,camera_helper,light;
    var texture,object;
    var status;
    var control= new function() {
        this.scale = 1;
        this.add = function() {
            var geometry = new THREE.SphereGeometry( Math.random(), Math.random(),Math.random() );
            var sphereMaterial = new THREE.MeshBasicMaterial({
                map:texture,
                opacity: 0.5,
                transparent: true
            });
            var sphereMesh = new THREE.Mesh(geometry, sphereMaterial);
            sphereMesh.receiveShadow = true;
            sphereMesh.position.set(Math.random()+1, Math.random()+2,Math.random()+3 );
            scene.add(sphereMesh);
        }
    };
    var camera_ctrl = new function () {
        this.x=50;
        this.y=0;
        this.z=20;
        this.fov =30;
        this.near = 10;
        this.far = 100;
        this.aspect = window.innerWidth / window.innerHeight;
    };
    var light_ctrl = new function () {


    };
    var geometry_ctrl = new function () {
        this.rotationX = 0;
        this.rotationY = 0;
        this.rotationZ = 0;
        this.scale = 1;
    };
    function init(){
        var hasGL = detectWebGL();
        if(hasGL) {
            scene = new THREE.Scene();
            camera = new THREE.PerspectiveCamera(camera_ctrl.fov, camera_ctrl.aspect, camera_ctrl.near, camera_ctrl.far);
            camera.position.x = camera_ctrl.x;
            camera.position.y = camera_ctrl.y;
            camera.position.z = camera_ctrl.z;
            camera.lookAt(scene.position);
            camera_helper = new THREE.CameraHelper(camera);
            render = new THREE.WebGLRenderer();
            render.setClearColor(0xc0c0c0, 1.0);
            render.setSize(document.body.clientWidth-20, document.body.clientHeight-20);
            var loader = new THREE.TextureLoader();
            texture = loader.load('/images/skull.jpg');
            texture.needsUpdate= true;
            stats = createStats();
            document.body.appendChild(render.domElement);
            document.body.appendChild(stats.domElement);
            addControls();
            animate();
        } else{
            alert('The Browser is not support WebGL!');
        }
    }
    function animate() {
        camera.position.x = camera_ctrl.x;
        camera.position.y = camera_ctrl.y;
        camera.position.z = camera_ctrl.z;
        camera.lookAt(scene.position);
        render.render(scene, camera);
        stats.update();
        camera_helper.update();
        requestAnimationFrame(animate);
    }
    function detectWebGL() {
        // first create a canvas element
        var testCanvas = document.createElement("canvas");
        // and from that canvas get the webgl context
        var gl = null;
        // if exceptions are thrown, indicates webgl is null
        try {
            gl = testCanvas.getContext("webgl");
        } catch (x) {
            gl = null;
        }
        // if still null try experimental
        if (gl == null) {
            try {
                gl = testCanvas.getContext("experimental-webgl");
            } catch (x) {
                gl = null;
            }
        }
        // if webgl is all good return true;
        if (gl) {
            return true;
        } else {
            return false;
        }
    }
    function createStats() {
        var stats = new Stats();
        stats.setMode(0);
        stats.domElement.style.position = 'absolute';
        stats.domElement.style.left = 0;
        stats.domElement.style.top = 0;
        return stats;
    }
    function addControls() {
        var gui = new dat.GUI();
        var f1 = gui.addFolder('Camera');
        f1.add(camera_ctrl, 'x',-100,100);
        f1.add(camera_ctrl, 'y',-100,100);
        f1.add(camera_ctrl, 'z',-100,100);
        f1.add(camera_ctrl, 'fov',-2*camera_ctrl.fov,3*camera_ctrl.fov);
        f1.add(camera_ctrl, 'near',-2*camera_ctrl.near,3*camera_ctrl.near);
        f1.add(camera_ctrl, 'far',-2*camera_ctrl.far,3*camera_ctrl.far);
        var f2 = gui.addFolder('Control');
        f2.add(control,'add');
        var f3 = gui.addFolder('Geometry');
        f3.add(geometry_ctrl, 'rotationX',-10,10);
        f3.add(geometry_ctrl, 'rotationY',-10,10);
        f3.add(geometry_ctrl, 'rotationZ',-10,10);
        f3.add(geometry_ctrl, 'scale',0.5,2);
        f1.open();
    }
    document.body.onload = init();

</script>
</body>
</html>