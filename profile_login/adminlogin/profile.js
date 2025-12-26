// profile.js

document.getElementById('edit-profile').addEventListener('click', function () {
    const editableFields = ['fullname', 'email', 'education', 'school', 'phone', 'address'];
    
    editableFields.forEach(function (field) {
        const div = document.getElementById('detail-' + field);
        const value = div.textContent.trim();
        const input = document.createElement('input');
        input.type = 'text';
        input.name = field;
        input.value = value;
        input.className = 'detail-value';
        div.parentNode.replaceChild(input, div);
    });

    const editBtn = document.getElementById('edit-profile');
    editBtn.textContent = 'Save';
    editBtn.removeEventListener('click', arguments.callee);
    editBtn.addEventListener('click', saveProfile);
});

function saveProfile() {
    const updatedData = {
        fullname: document.getElementsByName('fullname')[0].value,
        email: document.getElementsByName('email')[0].value,
        education: document.getElementsByName('education')[0].value,
        school: document.getElementsByName('school')[0].value,
        phone: document.getElementsByName('phone')[0].value,
        address: document.getElementsByName('address')[0].value
    };

    fetch('update_profile.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(updatedData)
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        location.reload();
    })
    .catch(error => {
        console.error('Error updating profile:', error);
    });
}

document.getElementById('profile-upload').addEventListener('change', function () {
    const fileInput = this;
    const formData = new FormData();
    formData.append('profile_pic', fileInput.files[0]);

    fetch('upload_profile_picture.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.success) {
            document.getElementById('profile-picture').src = data.new_path;
        }
    })
    .catch(error => {
        console.error('Error uploading picture:', error);
    });
});
