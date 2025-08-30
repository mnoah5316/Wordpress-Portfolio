// Scene setup
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(25, 1, 0.08, 800);
const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });

renderer.setSize(400, 400);
renderer.setClearColor(0x000000, 0);
renderer.shadowMap.enabled = true;
renderer.shadowMap.type = THREE.PCFSoftShadowMap;
renderer.toneMapping = THREE.ACESFilmicToneMapping;
renderer.toneMappingExposure = 1.2;
document.getElementById('container').appendChild(renderer.domElement);

// Controls
const controls = new THREE.OrbitControls(camera, renderer.domElement);
controls.enableDamping = true;
controls.dampingFactor = 0.05;
controls.enableZoom = true;
controls.enablePan = true;
controls.autoRotate = false;
controls.autoRotateSpeed = 2.0;

const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
directionalLight.position.set(10, 20, 10);
directionalLight.castShadow = true;
directionalLight.shadow.mapSize.width = 2048;
directionalLight.shadow.mapSize.height = 2048;
directionalLight.shadow.camera.near = 0.5;
directionalLight.shadow.camera.far = 100;
directionalLight.shadow.camera.left = -25;
directionalLight.shadow.camera.right = 25;
directionalLight.shadow.camera.top = 25;
directionalLight.shadow.camera.bottom = -25;
scene.add(directionalLight);

// Additional point lights for better illumination
const pointLight1 = new THREE.PointLight(0xFFFFFF, 1.5, 50);
pointLight1.position.set(-15, 15, -15);
scene.add(pointLight1);

const pointLight2 = new THREE.PointLight(0xffFFff, 1.5, 50);
pointLight2.position.set(15, 15, 15);
scene.add(pointLight2);



// Camera position
camera.position.set(25, 30, 25);
camera.lookAt(0, 0, 0);

// GLB Loader
const loader = new THREE.GLTFLoader();
let currentModel = null;

// Function to load GLB model
function loadGLBModel(filePath) {
    
    // Remove previous model if exists
    if (currentModel) {
        scene.remove(currentModel);
        currentModel = null;
    }

    // Try to load the model
    fetch(filePath)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.arrayBuffer();
        })
        .then(arrayBuffer => {
            loader.parse(arrayBuffer, '', (gltf) => {
                const model = gltf.scene;
                
                // Center the model
                const box = new THREE.Box3().setFromObject(model);
                const center = box.getCenter(new THREE.Vector3());
                model.position.sub(center);
                
                // Scale the model appropriately
                const size = box.getSize(new THREE.Vector3());
                const maxDim = Math.max(size.x, size.y, size.z);
                const scale = 10 / maxDim; // Scale to fit in 10x10x10 box
                model.scale.setScalar(scale);
                
                // Enable shadows for all meshes
                model.traverse((child) => {
                    if (child.isMesh) {
                        child.castShadow = true;
                        child.receiveShadow = true;
                        
                        // Enhance materials
                        if (child.material) {
                            child.material.envMapIntensity = 1.2;
                            child.material.roughness = 0.3;
                            child.material.metalness = 0.7;
                        }
                    }
                });
                
                // Add to scene
                scene.add(model);
                currentModel = model;
                
                // Update model info
                updateModelInfo(filePath, model);
                
                console.log('GLB model loaded successfully:', model);
            }, (error) => {
                console.error('Error parsing GLB:', error);
                alert('Error loading GLB model. Please check the file format.');
            });
        })
        .catch(error => {
            console.error('Error loading from path:', error);
            alert(`Error loading model from path: ${filePath}\n\nPlease ensure the file exists and is accessible.`);
        });
}

// Function to update model information
function updateModelInfo(filePath, model) {
    const info = document.getElementById('model-details');
    const box = new THREE.Box3().setFromObject(model);
    const size = box.getSize(new THREE.Vector3());
    const center = box.getCenter(new THREE.Vector3());
    
    info.innerHTML = `
        <strong>File:</strong> ${filePath.split('/').pop()}<br>
        <strong>Dimensions:</strong> ${size.x.toFixed(2)} × ${size.y.toFixed(2)} × ${size.z.toFixed(2)}<br>
        <strong>Center:</strong> (${center.x.toFixed(2)}, ${center.y.toFixed(2)}, ${center.z.toFixed(2)})<br>
        <strong>Scale:</strong> ${model.scale.x.toFixed(2)}x
    `;
}

load_3D();

// Event listeners
function load_3D () {
    const filePath = 'https://localhost/portfolio/wp-content/uploads/2025/08/desk.glb';
    if (filePath) {
        loadGLBModel(filePath);
    } else {
        alert('Please enter a file path.');
    }
};



// Animation loop
function animate() {
    requestAnimationFrame(animate);

    // Update controls
    controls.update();

    // Render
    renderer.render(scene, camera);
}

animate();