/**
 * Mini Blog Kreatif - Main JavaScript
 * Berisi semua fungsi interaktif untuk aplikasi blog
 */

document.addEventListener('DOMContentLoaded', function() {
    // Toggle menu mobile
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mainNav = document.querySelector('.main-nav');
    
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            mainNav.classList.toggle('active');
            this.classList.toggle('active');
        });
    }
    
    // Validasi form
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    showError(field, 'Bidang ini wajib diisi');
                } else {
                    removeError(field);
                    
                    // Validasi email
                    if (field.type === 'email' && !isValidEmail(field.value)) {
                        isValid = false;
                        showError(field, 'Format email tidak valid');
                    }
                    
                    // Validasi password
                    if (field.type === 'password' && field.dataset.minLength && field.value.length < parseInt(field.dataset.minLength)) {
                        isValid = false;
                        showError(field, `Password minimal ${field.dataset.minLength} karakter`);
                    }
                }
            });
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    });
    
    // Fungsi untuk menampilkan pesan error
    function showError(field, message) {
        removeError(field);
        
        const errorElement = document.createElement('div');
        errorElement.className = 'error-message';
        errorElement.textContent = message;
        
        field.classList.add('is-invalid');
        field.parentNode.appendChild(errorElement);
    }
    
    // Fungsi untuk menghapus pesan error
    function removeError(field) {
        field.classList.remove('is-invalid');
        
        const errorElement = field.parentNode.querySelector('.error-message');
        if (errorElement) {
            errorElement.remove();
        }
    }
    
    // Validasi format email
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    // Preview gambar saat upload
    const imageInputs = document.querySelectorAll('.image-upload');
    
    imageInputs.forEach(input => {
        input.addEventListener('change', function() {
            const preview = document.querySelector(this.dataset.preview);
            
            if (preview && this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
    
    // Konfirmasi hapus
    const deleteButtons = document.querySelectorAll('.delete-btn');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                e.preventDefault();
            }
        });
    });
    
    // Tombol scroll ke atas
    const scrollTopBtn = document.querySelector('.scroll-top');
    
    if (scrollTopBtn) {
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                scrollTopBtn.classList.add('show');
            } else {
                scrollTopBtn.classList.remove('show');
            }
        });
        
        scrollTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    // Editor WYSIWYG sederhana
    const textareas = document.querySelectorAll('.wysiwyg-editor');
    
    textareas.forEach(textarea => {
        if (textarea.dataset.wysiwyg === 'true') {
            initWysiwygEditor(textarea);
        }
    });
    
    function initWysiwygEditor(textarea) {
        // Buat toolbar
        const toolbar = document.createElement('div');
        toolbar.className = 'wysiwyg-toolbar';
        
        // Tambahkan tombol-tombol toolbar
        const buttons = [
            { icon: 'fas fa-bold', command: 'bold', title: 'Bold' },
            { icon: 'fas fa-italic', command: 'italic', title: 'Italic' },
            { icon: 'fas fa-underline', command: 'underline', title: 'Underline' },
            { icon: 'fas fa-heading', command: 'formatBlock', value: '<h2>', title: 'Heading' },
            { icon: 'fas fa-list-ul', command: 'insertUnorderedList', title: 'Bullet List' },
            { icon: 'fas fa-list-ol', command: 'insertOrderedList', title: 'Numbered List' },
            { icon: 'fas fa-link', command: 'createLink', title: 'Insert Link' },
            { icon: 'fas fa-image', command: 'insertImage', title: 'Insert Image' }
        ];
        
        buttons.forEach(btn => {
            const button = document.createElement('button');
            button.type = 'button';
            button.title = btn.title;
            button.innerHTML = `<i class="${btn.icon}"></i>`;
            
            button.addEventListener('click', function() {
                const command = btn.command;
                
                if (command === 'createLink') {
                    const url = prompt('Masukkan URL:');
                    if (url) document.execCommand(command, false, url);
                } else if (command === 'insertImage') {
                    const url = prompt('Masukkan URL gambar:');
                    if (url) document.execCommand(command, false, url);
                } else if (btn.value) {
                    document.execCommand(command, false, btn.value);
                } else {
                    document.execCommand(command, false, null);
                }
            });
            
            toolbar.appendChild(button);
        });
        
        // Buat editor area
        const editorArea = document.createElement('div');
        editorArea.className = 'wysiwyg-editor-area';
        editorArea.contentEditable = true;
        editorArea.innerHTML = textarea.value;
        
        // Update textarea saat editor berubah
        editorArea.addEventListener('input', function() {
            textarea.value = this.innerHTML;
        });
        
        // Sembunyikan textarea asli
        textarea.style.display = 'none';
        
        // Tambahkan toolbar dan editor ke DOM
        textarea.parentNode.insertBefore(toolbar, textarea);
        textarea.parentNode.insertBefore(editorArea, textarea);
    }
});
