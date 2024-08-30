let newId = 0;

function getNewId(id) {
    newId = id;
}

function getAllInfo() {
    $.ajax({
        type: "GET",
        url: "action/read.php",
        success: function (data) {
            const contactList = JSON.parse(data);

            contactList.forEach((user) => (
                renderUserInfo(user)
            ))

        },
        error: (error) => {
            console.log(error);
        },
    })
}

const tdStyle = "info p-3 hover:bg-slate-700 hover:scale-95 transition duration-200 text-center";

function renderUserInfo(user) {
    $("#tbody").append(`
        <tr id="phone-list" class="hover:bg-slate-700 transition duration-300 pulse">
            <td class="${tdStyle}">${user.name}</td>
            <td class="${tdStyle}">${user.phone}</td>
            <td class="${tdStyle}">${user.email}</td>
            <td class="space-x-2 hover:text-green-500 hover:scale-105 transition duration-200">
                 <button class="edit-btn" onclick="getNewId(${user.id})">
                    <i class="fa-regular fa-pen-to-square"></i>
                    Edit
                </button>
            </td>
            <td class="hover:bg-slate-700 hover:text-red-500 hover:scale-105 transition duration-200">
                <button class="delete-tr-btn" onclick="getNewId(${user.id})">
                    <i class="fa-solid fa-trash"></i>
                  Delete
                </button>
            </td>
        </tr>
    `)
}

function toastNotification(msg, icontype = "success", seconds = 1000) {
    Swal.fire({
        position: "center",
        icon: icontype,
        title: icontype === "success" ? msg :"",
        text: icontype === "error" ? msg : "",
        showConfirmButton: false,
        timer: seconds
    });
}


$("document").ready(() => {
    $("#update-form").hide();
    $("#modal-delete").hide();
    $("#add-form").hide();

    getAllInfo();

    $("#add-new-contact-btn").click(() => {
        $("#add-form").fadeToggle();
    });

    $("#cancel-btn").click(() => {
        $("#add-form").fadeOut();
    });

    $("#add-new-contact-form").submit((e) => {
        e.preventDefault();

        const insertUrl = $("#add-new-contact-form").attr("action");


        $.ajax({
            type: "POST",
            url: insertUrl,
            data: $("#add-new-contact-form").serialize(),
            success: (data) => {
                const response = JSON.parse(data);
                console.log(response);

                if (response.success) {
                    $("#add-form").fadeOut();
                    toastNotification("Added Successfully!");
                    $("#tbody").empty();

                    getAllInfo();
                    $("#name").val("");
                    $("#phone").val("");
                    $("#email").val("");
                } else {
                    $("#add-form").fadeOut();
                    toastNotification(response.error, "error", 3000);
                }
            },
        });
    });

    //Update Form
    $("#update-cancel-btn").click(() => {
        $("#update-form").fadeOut();
    })

    $("#tbody").on('click', '.edit-btn', () => {
        $("#update-form").fadeToggle();
        const selectUrl = $("#update-contact-form").attr("action");

        $.ajax({
            type: "POST",
            url: selectUrl,
            data: { id: newId },
            success: (data) => {
                const selectedInfo = JSON.parse(data);

                $("#edit-name").val(selectedInfo.name);
                $("#edit-phone").val(selectedInfo.phone);
                $("#edit-email").val(selectedInfo.email);
            }
        });
    });

    $('#update-contact-form').submit((e) => {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "action/update.php",
            data: {
                id: newId,
                name: $("#edit-name").val(),
                phone: $("#edit-phone").val(),
                email: $("#edit-email").val(),
            },
            success: (data) => {
                const response = JSON.parse(data);

                if(response.success) {
                    $("#update-form").fadeOut();
                    $("#tbody").empty();
    
                    getAllInfo();
                    toastNotification("Updated Successfully");
                } else {
                    $("#update-form").fadeOut();
                    toastNotification(response.error, "error", 3000);
                }
            },
        });
    })

    //Delete form
    $("#tbody").on('click', '.delete-tr-btn', () => {
        $("#modal-delete").toggle();
        console.log("tr button delete");
    });

    $("#cancel-modal-btn").click(() => {
        $("#modal-delete").fadeOut();
    });

    $("#delete-modal-btn").click(() => {
        $.ajax({
            type: "POST",
            url: "action/delete.php",
            data: { id: newId },
            success: () => {
                $("#modal-delete").hide();
                $("#tbody").empty();
                getAllInfo();
                toastNotification("Deleted Successfully");
            }
        });
    });

    $("#search-input").keyup(function () {
        const searchVal = $("#search-input").val().toLowerCase();

        $.ajax({
            type: "GET",
            url: "action/read.php",
            success: function (data) {
                const contactList = JSON.parse(data);

                const filteredList = searchVal
                    ? contactList.filter(info =>
                        info.name.toLowerCase().includes(searchVal) ||
                        info.phone.includes(searchVal) ||
                        info.email.toLowerCase().includes(searchVal))
                    : contactList

                $("#tbody").empty();
                filteredList.forEach((user) => {
                    renderUserInfo(user);
                })

                filteredList.length === 0
                    ? $("#search-label").text(`We apologize, but the "${searchVal}" you were searching for was not found.`)
                    : $("#search-label").text("");
            }
        })
    });
})

