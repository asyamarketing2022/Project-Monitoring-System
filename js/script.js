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

//Search function

let searchInput = document.querySelectorAll('.search');

Array.from(searchInput).forEach((search) => {
    search.addEventListener('keyup', () => {
        let input, filter, tr, table_data, txtValue
    
        // input = document.querySelector(".search");
        filter = search.value.toUpperCase();
        tr = document.querySelector('.table-form');
        table_data = document.querySelectorAll(".table-form td:nth-child(3)");
    
        console.log('keyup')
    
        Array.from(table_data).forEach((td) => {
    
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
    
                td.parentNode.style.display = "";
    
            } else {
    
                td.parentNode.style.display = "none";
    
            }
    
        });
    });
});

//Search User Filter

let searchUser_input = document.querySelectorAll('.searchUser-input');

Array.from(searchUser_input).forEach((search) => {
    search.addEventListener('keyup', () => {
        let input, filter, tr, table_data, txtValue
   

        // input = document.querySelector(".search");
        filter = search.value.toUpperCase();
        tr = document.querySelector('.search-user');
        table_data = document.querySelectorAll(".search-user td:nth-child(1)");

        let searchValue = search.value;
    
        Array.from(table_data).forEach((td) => {

            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
    
                td.parentNode.style.display = "block";
    
            } else  {

                td.parentNode.style.display = "";
            }
        });

        Array.from(table_data).forEach((td) => {

            if ( searchValue == "" || searchValue == null ) {
    
               td.parentNode.style.display = "";
    
            }
        });
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
                // console.log(input)

            });
    
        });

    });

}

disableInput();

//Create dynamic Input
function dynamicInput() {
    let searchUser = document.querySelectorAll('.search-user');
    
    Array.from(searchUser).forEach((rowUser) => {

        rowUser.addEventListener('click', () => {

            let nameofuser = rowUser.querySelector('.nameofuser').innerText;
            // let pickBtn = rowUser.querySelector('.pickBtn')
            let btnValue = rowUser.getAttribute('value');
            const input = document.createElement(`input`);
            const div = document.createElement(`div`);
            const p = document.createElement(`p`);
            
            p.innerHTML = " x ";
            // p.setAttribute('class', 'removeInput');
            p.classList.add(btnValue)
            div.classList.add('content__info');
            div.classList.add('text-center');
            input.setAttribute('name', 'pickEmployee[]');
            // input.setAttribute('id', btnValue);
            input.setAttribute('value', nameofuser);

            div.appendChild(p);
            div.appendChild(input);

            document.querySelector('#pick_project .assign').appendChild(div);

            rowUser.classList.add('d-none');
          
            document.querySelector('.dateToday').valueAsDate = new Date();

            //Remove Dynamic Input
            
            function removeInput() {

                let removeIcon = document.querySelectorAll('.content__info p');
            
                Array.from(removeIcon).forEach((removeInput) => {
            
                    removeInput.addEventListener('click', () => {
            
                        removeInput.parentElement.remove();
                        rowUser.classList.remove('d-none');

                    });
                    
                });
            
            }

            removeInput();
        });
        
    });
    
}

dynamicInput();



