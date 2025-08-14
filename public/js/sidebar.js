// sidebar.js
function initSidebar() {
    const toggleBtn = document.querySelector(".toggle-btn");
    const wrapper = document.querySelector(".wrapper");
    const icon = document.getElementById("icon");

    if (toggleBtn && wrapper && icon) {
        toggleBtn.onclick = function () {
            wrapper.classList.toggle("sidebar-collapsed");
            if (wrapper.classList.contains("sidebar-collapsed")) {
                icon.classList.replace(" bx-chevrons-right", " bx-chevrons-left");
            } else {
                icon.classList.replace(" bx-chevrons-left", " bx-chevrons-right");
            }
        };
    }

    // links active
    const sidebarLinks = document.querySelectorAll(".sidebar-link");
    sidebarLinks.forEach((link) => {
        link.addEventListener("click", function () {
            sidebarLinks.forEach((l) => l.classList.remove("active"));
            this.classList.add("active");
        });
    });
}

//onload page
document.addEventListener("DOMContentLoaded", () => {
    if (document.querySelector("#sidebar")) {
        initSidebar();
    }
});
