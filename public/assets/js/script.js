$(document).ready(function () {
    $('#example').DataTable();
});

function togglePassword(input){
    const togglePassword = document.querySelector('#iconPassword');
    const password = document.getElementById(input);

    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    togglePassword.classList.toggle('fa-eye');
    togglePassword.classList.toggle('fa-eye-slash');
}

function openModal(id){
    $("#cat-save-btn").show();
    $("#cat-update-btn").hide();
    document.getElementById("form").reset();
    $(id).modal('show');
}

function openEditCat(modal, id, name){
    $("#cat-save-btn").hide();
    $("#cat-update-btn").show();
    document.getElementById("form").reset();
    $(modal).modal('show');

    $("#cat-id").val(id);
    $("#cat-name").val(name);
}

function deleteCat(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: '../../index.php',
                data: {delete_cat: id},
                success: function (obj) {
                    location.reload();
                }
            });
        }
    });
}