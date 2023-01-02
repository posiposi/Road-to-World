const previewImage = (file) => {
    // 既存のアバター画像を取得する
    const image = document.querySelector('.avatar-img');

    const reader = new FileReader();
    
    reader.onload = (e) => {
        const imageUrl = e.target.result;
        image.src = imageUrl;
    }

    reader.readAsDataURL(file);
}

// ファイルインプットを取得
const fileInput = document.querySelector('.avatarHiddenBtn');

const handleFileSelect = () => {
    const files = fileInput.files;
    for (let i = 0; i < files.length; i++) {
        previewImage(files[i]);
    }
}
fileInput.addEventListener('change', handleFileSelect);