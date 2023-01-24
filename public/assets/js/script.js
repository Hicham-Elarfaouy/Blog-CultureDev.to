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
    data.append('post-img', $("#post-img")[0].files[0]);

    const req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            if(this.responseText === 'error'){
                location.reload();
            }
        }
    };
    req.open("POST", "../../index.php");
    req.send(data);

    document.getElementById("form").reset();
}

function searchPost(){
    let search = document.querySelector('#search').value;
    window.location.href = "index.php?search="+search;
}

function incorrectField(field, text){
    field.style.border = '1px solid red';
    const LI = document.createElement("li");
    LI.append(text);
    return LI;
}

const FORM = document.getElementById("formAuth");
const INPUTS = document.getElementsByTagName("input");
const VALIDATION = document.getElementById("validation");
FORM.addEventListener("submit",  (e)=>{
    Object.entries(INPUTS).forEach(e=>{
        e[1].style.border = '';
    });

    VALIDATION.textContent = '';
    const LIST = document.createElement("ul");

    if(!/^[a-zA-Z0-9]+@[a-zA-Z0-9]+.[a-zA-Z0-9]+$/.test(INPUTS['email'].value)){
        LIST.append(incorrectField(INPUTS['email'], 'Invalid email format !'));
    }
    if(!/^[a-zA-Z0-9]{8,}$/.test(INPUTS['pass'].value)){
        LIST.append(incorrectField(INPUTS['pass'], 'Password must contains at least 8 numbers & alpha !'));
    }

    if(INPUTS['first_name'] && INPUTS['last_name']){
        if(!/^[a-zA-Z]+$/.test(INPUTS['first_name'].value)){
            LIST.append(incorrectField(INPUTS['first_name'], 'Invalid first name format accept only alpha !'));
        }

        if(!/^[a-zA-Z]+$/.test(INPUTS['last_name'].value)){
            LIST.append(incorrectField(INPUTS['last_name'], 'Invalid last name format accept only alpha !'));
        }
    }
    VALIDATION.append(LIST);
    if(LIST.hasChildNodes()){
        e.preventDefault();
    }
});