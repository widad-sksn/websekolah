<!-- Global Cropper Modal -->
<div id="cropperModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl w-full max-w-4xl flex flex-col max-h-[90vh] shadow-2xl">
        <!-- Header -->
        <div class="flex items-center justify-between p-4 border-b border-gray-100">
            <h3 class="text-lg font-bold font-display text-dark">Sesuaikan Potongan Gambar</h3>
            <button type="button" onclick="closeCropper()" class="text-gray-400 hover:text-red-500 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        
        <!-- Body (Cropper Area) -->
        <div class="p-4 flex-1 overflow-hidden bg-gray-50 flex items-center justify-center min-h-[50vh]">
            <div class="w-full h-full flex items-center justify-center">
                <img id="cropperImage" src="" alt="To Crop" class="max-w-full max-h-[60vh]">
            </div>
        </div>
        
        <!-- Footer -->
        <div class="p-4 border-t border-gray-100 flex justify-end space-x-3 bg-gray-50 rounded-b-2xl">
            <button type="button" onclick="closeCropper()" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors">
                Batal
            </button>
            <button type="button" onclick="applyCrop()" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition-colors shadow-md shadow-blue-500/20 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Terapkan & Simpan
            </button>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script>
    let cropper = null;
    let originalInput = null;
    let currentFilesQueue = [];
    let croppedFiles = [];
    let currentFileName = "";
    let currentFileType = "";
    let currentAspectRatio = null;

    window.initCropper = function(inputElement, aspectRatio = null) {
        if (inputElement.files && inputElement.files.length > 0) {
            originalInput = inputElement;
            currentAspectRatio = aspectRatio;
            
            // Filter only image files
            currentFilesQueue = Array.from(inputElement.files).filter(f => f.type.startsWith('image/'));
            croppedFiles = [];
            
            if (currentFilesQueue.length === 0) return;
            
            processNextFile();
        }
    };

    function processNextFile() {
        if (currentFilesQueue.length === 0) {
            // Finished cropping all images in the queue
            let dt = new DataTransfer();
            croppedFiles.forEach(f => dt.items.add(f));
            originalInput.files = dt.files;
            originalInput.dispatchEvent(new Event('crop-applied', { bubbles: true }));
            
            closeCropperModal();
            return;
        }

        let file = currentFilesQueue[0];
        currentFileName = file.name;
        currentFileType = file.type;
        
        let url = URL.createObjectURL(file);
        let image = document.getElementById('cropperImage');
        image.src = url;
        
        // Show indicator if multiple
        let title = document.querySelector('#cropperModal h3');
        if (currentFilesQueue.length + croppedFiles.length > 1) {
            title.innerText = `Sesuaikan Potongan Gambar (${croppedFiles.length + 1}/${currentFilesQueue.length + croppedFiles.length})`;
        } else {
            title.innerText = "Sesuaikan Potongan Gambar";
        }
        
        document.getElementById('cropperModal').classList.remove('hidden');
        document.getElementById('cropperModal').classList.add('flex');
        
        setTimeout(() => {
            if (cropper) {
                cropper.destroy();
            }
            cropper = new Cropper(image, {
                aspectRatio: currentAspectRatio,
                viewMode: 2,
                dragMode: 'move',
                autoCropArea: 1,
                restore: false,
                guides: true,
                center: true,
                highlight: false,
                cropBoxMovable: true,
                cropBoxResizable: true,
                toggleDragModeOnDblclick: false,
            });
        }, 100);
    }

    window.closeCropper = function() {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        if (originalInput) {
            originalInput.value = '';
        }
        currentFilesQueue = [];
        croppedFiles = [];
        originalInput = null;
        closeCropperModal();
    };

    function closeCropperModal() {
        document.getElementById('cropperModal').classList.add('hidden');
        document.getElementById('cropperModal').classList.remove('flex');
    }

    window.applyCrop = function() {
        if (!cropper || !originalInput) return;

        cropper.getCroppedCanvas({
            maxWidth: 1920,
            maxHeight: 1920,
        }).toBlob((blob) => {
            let croppedFile = new File([blob], currentFileName, { type: currentFileType, lastModified: Date.now() });
            croppedFiles.push(croppedFile);
            
            currentFilesQueue.shift(); // Remove processed file from queue
            
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
            
            processNextFile(); // Show next image or finish
            
        }, currentFileType, 0.85);
    };
</script>
