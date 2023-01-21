$(document).ready(function () {
    $('#example').DataTable();
});

function togglePassword(input) {
    const togglePassword = document.querySelector('#iconPassword');
    const password = document.getElementById(input);

    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    togglePassword.classList.toggle('fa-eye');
    togglePassword.classList.toggle('fa-eye-slash');
}

function openModal() {
    $("#modal-save-btn").show();
    $("#modal-multi-btn").show();
    $("#modal-update-btn").hide();
    document.getElementById("form").reset();
    $("#modal").modal('show');
}

function openEditCat(id, name) {
    openModal();
    $("#modal-save-btn").hide();
    $("#modal-update-btn").show();
    $("#cat-id").val(id);
    $("#cat-name").val(name);
}

function openEditPost(id) {
    openModal();
    $("#modal-save-btn").hide();
    $("#modal-multi-btn").hide();
    $("#modal-update-btn").show();

    $.ajax({
        type: "POST",
        url: '../../index.php',
        data: {specific_post: id},
        success: function (obj) {
            obj = JSON.parse(obj);
            $("#post-id").val(obj['id']);
            $("#post-auteur").val(obj['auteur']);
            $("#post-title").val(obj['title']);
            $("#post-cat").val(obj['cat']);
            $("#post-desc").val(obj['description']);
        }
    })
}

function deleteItem(id, name) {
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
            let data = new FormData();
            data.append(name, id);

            const req = new XMLHttpRequest();
            req.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    location.reload();
                }
            };
            req.open("POST", "../../index.php");
            req.send(data);
        }
    });
}

function saveMultiPost(){
    $('#modal').on('hidden.bs.modal', function () {
        location.reload();
    })

    let data = new FormData();
    data.append('save_post', 'true');
    data.append('post-title', $("#post-title").val());
    data.append('post-cat', $("#post-cat").val());
    data.append('post-desc', $("#post-desc").val());
    data.append('post-auteur', $("#post-auteur").val());

    const req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            // location.reload();
            console.log('save multi')
        }
    };
    req.open("POST", "../../index.php");
    req.send(data);

    document.getElementById("form").reset();
}