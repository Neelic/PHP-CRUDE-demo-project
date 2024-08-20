const showRecord = (element) => {
    element = element.parentElement.parentElement.children[4];
    document.getElementById('doB').value = element.innerText;
    element = element.previousElementSibling;
    document.getElementById('desc').value = element.innerText;
    element = element.previousElementSibling;
    document.getElementById('post').value = element.innerText;
    element = element.previousElementSibling;
    document.getElementById('fio').value = element.innerText;
    element = element.previousElementSibling;
    document.getElementById('imgPath').value = element.innerText;
}

const showLoginRegForm = (nameForm) => {
    let otherForm;
    if (nameForm === 'loginForm') {
        otherForm = 'regForm';
    } else if (nameForm === 'regForm') {
        otherForm = 'loginForm';
    }
    let show = document.getElementById(nameForm).style.display;
    if (show === 'none') {
        show = 'block';
        document.getElementById(otherForm).style.display = 'none';
    } else {
        show = 'none';
    }
    document.getElementById(nameForm).style.display = show;
}

const showModalDialogChangeGuard = (id, fio, postName, desc, DoB) => {
    const modal = document.getElementById('fixed-overlay-change');
    modal.style.display = 'block'

    document.getElementById('changeFio').value = fio;
    document.getElementById('changeDesc').value = desc;
    document.getElementById('changeDoB').value = DoB;
    document.getElementById('changePostName').value = postName;
    const element = document.getElementById('changeId'); 
    document.getElementById('changeId').value = id;
}

const showModalDialogChangePost = (id, name, location) => {
    const modal = document.getElementById('fixed-overlay-change');
    modal.style.display = 'block'

    document.getElementById('changePostName').value = name;
    document.getElementById('changePostLocation').value = location;
    document.getElementById('changeId').value = id;
}

// document.getElementById('nav-home-tab').onclick = function() {
//     document.getElementById('sameContent').style.display='flex';
// }

// document.getElementById('nav-profile-tab').onclick = function() {
//     document.getElementById('sameContent').style.display='none';
// }

// document.getElementById('nav-other-tab').onclick = function() {
//     document.getElementById('sameContent').style.display='none';
// }

// document.getElementById('nav-general-tab').onclick = function() {
//     document.getElementById('sameContent').style.display='none';
// }

document.getElementById('addMenuShow').onclick = function () {
    document.getElementById('fixed-overlay-create').style.display = 'block';
}

document.getElementById('closeModalDialogCreateBtn').onclick = function () {
    document.getElementById('fixed-overlay-create').style.display = 'none';
}

document.getElementById('closeModalDialogChangeBtn').onclick = function () {
    document.getElementById('fixed-overlay-change').style.display = 'none';
}
