
// ====== Hamburger Menu Click Js ====== //

const hamburger = document.getElementById("hamburger_menu");
hamburger.addEventListener('click', function () {
    var element1 = document.getElementById("collapse_menu");
    var element2 = document.getElementById("menu_overlay");
    var element3 = document.getElementById("body");
    element1.classList.toggle("collapse-menu-open");
    element2.classList.toggle("collapse-overlay");
    element3.classList.toggle("overflow-hidden");
});

// ====== Menu Overlay Click Js ====== //

const menuoverlay = document.getElementById("menu_overlay");
menuoverlay.addEventListener('click', function () {
    var element4 = document.getElementById("collapse_menu");
    var element5 = document.getElementById("menu_overlay");
    var element6 = document.getElementById("body");
    element4.classList.toggle("collapse-menu-open");
    element5.classList.toggle("collapse-overlay");
    element6.classList.toggle("overflow-hidden");
});

// ====== Menu Close Click Js ====== //

const menuclose = document.getElementById("colapse_close");
menuclose.addEventListener('click', function () {
    var element7 = document.getElementById("collapse_menu");
    var element8 = document.getElementById("menu_overlay");
    var element9 = document.getElementById("body");
    element7.classList.toggle("collapse-menu-open");
    element8.classList.toggle("collapse-overlay");
    element9.classList.toggle("overflow-hidden");
});




// ====== OnScroll Header Class Add and Remove Js ====== //

let scrollpos = window.scrollY
const header = document.querySelector("header")
const header_height = header.offsetHeight

const add_class_on_scroll = () => header.classList.add("dark")
const remove_class_on_scroll = () => header.classList.remove("dark")

window.addEventListener('scroll', function () {
    scrollpos = window.scrollY;

    if (scrollpos >= header_height) { add_class_on_scroll() }
    else { remove_class_on_scroll() }

    // console.log(scrollpos)

});

// header submenu start
jQuery(document).ready(function ($) {

    // ================== Dropdown

    if ($(window).width() < 1279) {
        $(function () {
            $('#myUL li').click(function (e) {
                e.stopPropagation();
                $(this).children('ul').stop().slideToggle(400);
            });
        });
    } else {
        $('#myUL li').hover(function () {
            $(this).children('ul').stop().slideToggle(400);
        });
    }


});
// header submenu end

// tom select init start
if (document.getElementById("select-beast")) {
    new TomSelect("#select-beast", {
        plugins: {
            remove_button: {
                title: 'Remove this item',
            }
        },
        onDelete: function (values) {
            return confirm(values.length > 1 ? 'Are you sure you want to remove these ' + values.length + ' items?' : 'Are you sure you want to remove "' + values[0] + '"?');
        },
        persist: false,
        create: false,
        maxItems: 10,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
}
// tom select init end

// data table init start
new DataTable('table.my-created-tk', {
    responsive: true
});

new DataTable('table.my-assigned-tk', {
    responsive: true
});
// data table init end

// view table data to offcanvas start
document.addEventListener("DOMContentLoaded", function () {
    if (document.querySelectorAll(".view-ticket").length > 0) {

        document.querySelectorAll(".view-ticket").forEach(btn => {
            btn.addEventListener("click", function () {
                document.getElementById("oc-id").textContent = this.dataset.id;
                document.getElementById("oc-name").textContent = this.dataset.name;
                document.getElementById("oc-description").textContent = this.dataset.description;
                document.getElementById("oc-status").textContent = this.dataset.status;
               if(this.dataset.file === ""){
                    document.querySelector("#oc-file").innerHTML = "No File Uploaded";
                } else {
                       document.querySelector("#oc-file img").src = "https://crm-ticket-module.fwh.is/uploads/" + this.dataset.file;
                }
                
           
                document.getElementById("oc-created-by").textContent = this.dataset.createdBy;
                document.getElementById("oc-assigned").textContent = this.dataset.assigned;
                document.getElementById("oc-created").textContent = this.dataset.created;
                document.getElementById("oc-updated").textContent = this.dataset.updated;
                // document.getElementById("oc-completed").textContent = this.dataset.completed;
                // document.getElementById("oc-deleted").textContent = this.dataset.deleted;

            });
        });
    }
});
// view table data to offcanvas end

// file preview js start
let file_upload_wpr = document.querySelectorAll('.file-upload-wpr');
console.log(file_upload_wpr);
if (file_upload_wpr.length > 0) {
    
    file_upload_wpr.forEach((item)=> {
      item.querySelector('.file-upload-fld').onchange = evt => {
            const [file] = evt.target.files;
            console.log([file]);
            if (file) {
                item.querySelector('.file-upload-preview img').src = URL.createObjectURL(file);
            };
        };
    })
}
// file preview js end

