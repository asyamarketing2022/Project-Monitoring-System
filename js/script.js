let users_id = document.querySelectorAll('.user-id');
let users_row = document.querySelectorAll('.table-row_user');
let tab_form = document.querySelector('#edit_employee .tab-content');

Array.from(users_row).forEach((user_row) => {

        user_row.addEventListener('click', (e) => {

            table_data = user_row.children;

            let tr = table_data[1].innerText;

            // document.cookie = "selected_item"+tr;


            // user_row.setAttribute("value", td);
           

       });
});

let search_menu = document.querySelector('.search');

search_menu.addEventListener('keyup', () => {
    let input, filter, tr, table_data, txtValue

    input = document.querySelector(".search");
    filter = input.value.toUpperCase();
    tr = document.querySelector('.table-row_user');
    table_data = document.querySelectorAll(".table-row_user td:nth-child(3)");

    Array.from(table_data).forEach((td) => {

        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {

            td.parentNode.style.display = "";

        } else {

            td.parentNode.style.display = "none";

        }

    });
});


// Disable Input
function disableInput() {
    let viewButton = document.querySelectorAll('.view-project');
    let inputbox = document.querySelectorAll(".input");

    Array.from(viewButton).forEach((view) => {

        view.addEventListener('click', () => {

            Array.from(inputbox).forEach((input) => {

                // input.setAttribute('readonly', true);
                console.log(input)

            });
              

        });

    });

}

disableInput();