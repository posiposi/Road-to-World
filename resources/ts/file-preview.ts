/** 既存アバター画像を取得する */
const previewImage = (file: Blob) => {
	const image = <HTMLInputElement>document.querySelector<HTMLElement>('.avatar-img');
	const reader = new FileReader();
	reader.onload = (e: any) => {
		if (image != null) {
			const imageUrl = e.target.result;
			image.src = imageUrl;
		}
	}
	reader.readAsDataURL(file);
}

/** 変更画像をプレビュー表示する */
const fileInput = <HTMLInputElement>document.querySelector('.avatarHiddenBtn');
if (fileInput) {
	const handleFileSelect = () => {
		const files: FileList | null = fileInput.files;
		if (files != null) {
			for (let i = 0; i < files.length; i++) {
				previewImage(files[i]);
			}
		}
	}
	fileInput.addEventListener('change', handleFileSelect);
}