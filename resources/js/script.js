// Get DOM elements
const loginFormContent = document.getElementById('login-form-content');
const registerFormContent = document.getElementById('register-form-content');
const showLoginLink = document.getElementById('show-login');
const showRegisterLink = document.getElementById('show-register');

// Get multi-step form elements
const step1 = document.getElementById('step-1');
const step2 = document.getElementById('step-2');
const step3 = document.getElementById('step-3');
const nextStep1Btn = document.getElementById('next-step-1');
const nextStep2Btn = document.getElementById('next-step-2');
const backStep2Btn = document.getElementById('back-step-2');
const backStep3Btn = document.getElementById('back-step-3');
const registerSubmitBtn = document.getElementById('register-submit');

// Initial state
let currentStep = 1;

// Function to show/hide login form
function showLoginForm() {
    loginFormContent.classList.remove('hidden');
    registerFormContent.classList.add('hidden');
}

// Function to show/hide register form
function showRegisterForm() {
    loginFormContent.classList.add('hidden');
    registerFormContent.classList.remove('hidden');
    showStep(1); // Start at step 1
}

// Function to control form steps
function showStep(stepNumber) {
    step1.classList.add('form-step-hidden');
    step2.classList.add('form-step-hidden');
    step3.classList.add('form-step-hidden');

    if (stepNumber === 1) {
        step1.classList.remove('form-step-hidden');
    } else if (stepNumber === 2) {
        step2.classList.remove('form-step-hidden');
    } else if (stepNumber === 3) {
        step3.classList.remove('form-step-hidden');
    }
}

// =================================================================
// Logika Baru untuk Searchable Dropdown
// =================================================================
function createSearchableDropdown(inputElement) {
    const dropdownContainer = inputElement.parentElement;
    const dropdownList = dropdownContainer.querySelector('.searchable-dropdown-list');
    const hiddenInput = dropdownContainer.querySelector('input[type="hidden"]');
    const options = inputElement.dataset.options.split(',');

    // Render initial options
    function renderOptions(filterText = '') {
        dropdownList.innerHTML = '';
        const filteredOptions = options.filter(option =>
            option.toLowerCase().includes(filterText.toLowerCase())
        );

        if (filteredOptions.length === 0) {
            const noResultItem = document.createElement('div');
            noResultItem.textContent = 'Tidak ada hasil';
            noResultItem.classList.add('searchable-dropdown-list-item', 'text-gray-500', 'cursor-default');
            dropdownList.appendChild(noResultItem);
        } else {
            filteredOptions.forEach(option => {
                const optionItem = document.createElement('div');
                optionItem.textContent = option;
                optionItem.classList.add('searchable-dropdown-list-item');
                optionItem.addEventListener('click', () => {
                    inputElement.value = option;
                    hiddenInput.value = option;
                    dropdownList.classList.add('hidden');
                    inputElement.focus();
                });
                dropdownList.appendChild(optionItem);
            });
        }
    }

    // Show/hide dropdown on input click
    inputElement.addEventListener('click', () => {
        dropdownList.classList.toggle('hidden');
        renderOptions(inputElement.value);
    });

    // Filter options on keyup
    inputElement.addEventListener('keyup', () => {
        dropdownList.classList.remove('hidden');
        renderOptions(inputElement.value);
    });

    // Hide dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!dropdownContainer.contains(e.target)) {
            dropdownList.classList.add('hidden');
        }
    });

    renderOptions();
}

// Inisialisasi semua searchable dropdown di Step 1
document.querySelectorAll('.searchable-dropdown-container input[type="text"]').forEach(input => {
    createSearchableDropdown(input);
});

// =================================================================
// Event listeners for login/register links
// =================================================================
showLoginLink.addEventListener('click', (e) => {
    e.preventDefault();
    showLoginForm();
});

showRegisterLink.addEventListener('click', (e) => {
    e.preventDefault();
    showRegisterForm();
});

// =================================================================
// Event listeners for multi-step navigation
// =================================================================
nextStep1Btn.addEventListener('click', () => {
    // Validasi untuk Step 1, mengambil nilai dari hidden input
    const role = document.getElementById('selected-role').value;
    const unit = document.getElementById('selected-unit').value;
    const vendor = document.getElementById('selected-vendor').value;
    const position = document.getElementById('selected-position').value;

    if (role && unit && vendor && position) {
        currentStep = 2;
        showStep(currentStep);
    } else {
        alert('Silakan lengkapi semua field pada Langkah 1.');
    }
});

nextStep2Btn.addEventListener('click', () => {
    // Basic validation for Step 2
    const firstName = document.getElementById('register-first-name').value;
    const username = document.getElementById('register-username').value;
    const password = document.getElementById('register-password').value;
    if (firstName && username && password) {
        currentStep = 3;
        showStep(currentStep);
    } else {
        alert('Silakan lengkapi semua field pada Langkah 2.');
    }
});

backStep2Btn.addEventListener('click', () => {
    currentStep = 1;
    showStep(currentStep);
});

backStep3Btn.addEventListener('click', () => {
    currentStep = 2;
    showStep(currentStep);
});

// Event listener for final registration submit
registerSubmitBtn.addEventListener('click', (e) => {
    e.preventDefault();
    // Basic validation for Step 3
    const dob = document.getElementById('register-dob').value;
    const email = document.getElementById('register-email').value;
    const phone = document.getElementById('register-phone').value;
    const terms = document.getElementById('agree-terms').checked;

    if (dob && email && phone && terms) {
        alert('Pendaftaran berhasil! Silakan periksa email Anda.');
        // Here you would send the form data to your backend
        // e.g., fetch('/api/register', { method: 'POST', body: JSON.stringify(formData) })
        console.log('Register form submitted with all data!');
        // Reset form to step 1 or redirect
        showStep(1);
    } else {
        alert('Silakan lengkapi semua field dan setujui syarat & ketentuan.');
    }
});