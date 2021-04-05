require('./bootstrap');

const toggleLeftMenu = (toggleId, navbarId, bodyId, topNavbarId, profileImgId, profileNameId) => {
    console.log("toggle");
    const toggle = document.getElementById(toggleId);
    const navbar = document.getElementById(navbarId);
    const body = document.getElementById(bodyId);
    const topNavbar = document.getElementById(topNavbarId);
    const profileImg = document.getElementById(profileImgId);
    const profileName = document.getElementById(profileNameId);
    
    if (toggle && navbar) {
        toggle.addEventListener('click', () => {
            navbar.classList.toggle('left-navbar-expander');
            topNavbar.classList.toggle('top-navbar-shrinker');
            body.classList.toggle('body-padding');
            toggle.classList.toggle('fa-arrow-right');
            toggle.classList.toggle('fa-arrow-left');
            profileImg.classList.toggle('left-nav-profile-img-max');
            profileName.classList.toggle('d-none');
        });
    }
}

toggleLeftMenu('left-nav-toggle', 'left-navbar', 'page-body', 'top-navbar',
 'left-nav-profile-img', 'left-nav-admin-name');