// $(document).ready(function () {

jQuery(function () {

   $('.datepicker').datepicker();

   $('.multidate').datepicker({
      multidate: true
   }); 

   

   //Update User
      $('.table-row_user').each(function(){
         $(this).on("click", function(){
           $.ajax({
               type: 'POST',
               url: 'update-user.php',
               data: {
                  tableID:($(this).attr('value')),
               },
               success:function(data){
                  // console.log(data)
                  $('.updateform-user').html(data);
               }
            });
         });
      });

      $('#edit_employee').on('show.bs.modal', function (event) { 
         $(this).find('.nav a:first').tab('show');
     })


   //Update Project
   $('.table-row_projects').each(function(){
      $(this).on("click", function(){
         $.ajax({
            type: 'POST',
            url: 'update-project.php',
            data: {
                  tableID:($(this).attr('value')),
            },
            success:function(data){
               $('.updateform-project').html(data);
            }
         });
      });
   });

   //Assign Project
      $(".view-project").on("click", function(){
         $.ajax({
            type: 'POST',
            url: 'assign-project.php',
            data: {
                  tableID:($(this).attr('value')),
            },
            success:function(data){
               $('.assignform-project').html(data);
            }
         });
      });


   //MyProject Details
   $(".view-myProject").each(function(){
      $(this).on("click", function(){
         $.ajax({
            type: 'POST',
            url: 'view-myproject.php',
            data: {
               tableID:($(this).attr('value')),
            },
            success:function(data){
               $('.myProject-details').html(data);
            }
         });
         console.log($(this).attr('value'));
      });
   });

   //Assign Project In Charge
   $('.view-myProject').each(function(){
      $(this).on("click", function(){

         let eventID = $(this).attr('value');
         // let users_array = [];

          $.ajax({
            type: 'GET',
            url: 'assign-projectIncharge.php',
            data: {'tableID': eventID},
   
            success:function(data){
               $('.here').html(data);
            }
         });
         
      });
   });

   function btntext(){
      let viewsBtn = document.querySelectorAll('.view-myProject');

      Array.from(viewsBtn).forEach((viewBtn) => {


      });

      let submitBtn = document.querySelector('.prevent');
      submitBtn.addEventListener('click', ()=> {

         let users = document.querySelectorAll('.user');
         let users_array = [];

         Array.from(users).forEach((user) => {

            users_array.push($(user).attr('value'));

            $.ajax({
               type: 'POST',
               url: 'assign-projectIncharge.php',
               data: {'users': users_array },
    
               success:function(data){
                   $('.here').html(data);
               }
            });

         });

      });
 
   }

   // btntext();

   // Notification Message
   function notif() {
      $(function() {
         $.ajax({
            type: 'GET',
            url: 'notification.php',
            success:function(data){
               $('.notif_count').html(data);
            }
         });
      });
   }
   notif();

   function notifShow() {
      $(".fa-bell").on('click', ()=> {

         $(".notif-list").toggle();

      });
   }
   notifShow();

   //Search Filter  
   function searchFilter() {
      $('.submitFilter').on('click', (e)=> {
         let searchFilter = $(".searchFilter").val();
         let val = $('.dataLimit option:selected').attr('value');

            $.ajax({
               type: 'POST',
               url: 'usersReport-table.php',
               data: {
                  'searchFilter': searchFilter,
                  'DataLimit': val
               },
               success:function(data){
                  $('.userhistory-table').html(data);
               }
            });

            e.preventDefault();
      });

   }
   searchFilter()

   //Limit of data in table   
   function limitData() {
      $('.dataLimit').on('change', function(){
         let searchFilter = $(".searchFilter").val();
          let val = $('.dataLimit option:selected').attr('value');
          $.ajax({
            type: 'POST',
            url: 'usersReport-table.php',
            data: {
               'searchFilter': searchFilter,
               'DataLimit': val 
            },
               success:function(data){
                  $('.userhistory-table').html(data);
            }
          });
         
      });
   }
   limitData();

   //Changing Data thru pagination
   function page() {
      $(document).on('click', '.pagination_link', function(){
         let page = $(this).attr("id");
         let val = $('.dataLimit option:selected').attr('value');
         let searchVal = $(".searchFilter").val();

         $.ajax({
            url:"usersReport-table_2.php",
            type: 'POST',
            data:{'page' :page,
            'pageLimit' :val,
            'searchVal' :searchVal
            },
            success:function(data){
               $('.userhistory-table').html(data);
            }
         });
      });
  
   }
   page();  

   //Pagination with LimitData 
   function pageBtn() { 
      $('.dataLimit').on('change', function(){
          let val = $('.dataLimit option:selected').attr('value');
          let searchVal = $(".searchFilter").val();
          $.ajax({   
            type: 'POST',
            url: 'pagination.php',
            data: {
               'DataLimit': val,
               'searchVal' :searchVal
            },
               success:function(data){
                  $('.pageBtn').html(data);
            }
          });
         
      });
   }
   pageBtn();


   function selectedPage() {
      $(document).on('click', '.pagination_link', function(){

     
         if($(this).hasClass('selected') == false) {
            $('.pagination_link').removeClass('selected');
            $('.pagination_link').addClass('hide');
            $(this).addClass('selected');
            $('.selected').removeClass('hide');
            $('.selected').next().removeClass('hide');
            $('.selected').prev().removeClass('hide');
            $('.pagination_link:first-child').removeClass('hide');
            $('.pagination_link:last-child').removeClass('hide');
         }

         // $('.pagination_link').addClass('d-none');
         // $(this).addClass('selected');
         // $(this).removeClass('d-none');

         // $('.pagination_link').removeClass('selected');
      });
   }
   selectedPage();

   function selectServices() {
      $(document).on('change', '.services', function(){

         let selectedVal = this.value;

         if(selectedVal == "architecture") {

           // Remove the unselected service
           $('.dynamic').remove();

            // Creating dynamic element
           let openDiv = $("<div class='content__info dynamic'>");
           let span = $("<span>Phases of Work</span>");
           let select = $("<select class='architecture' name='architecture'>");
           let option = [
                        "<option value='' disabled selected>Select Phases of Work</option>",
                        "<option value='conceptual'>Conceptual</option>",
                        "<option value='schematic'>Schematic</option>",
                        "<option value='design development'>Design Development</option>",
                        "<option value='construction drawings'>Construction Drawings</option>",
                        "<option value='site supervision'>Site Supervision</option>",
                        ];
    
            // Marge all element
            $(openDiv).append(span);
            $(openDiv).append(select);
            $(select).append(option);
            $(openDiv).append(select);

            // implement to html 
            $(openDiv).insertAfter('#services');

         } else if(selectedVal == "engineering") {
            
            // Remove the unselected service
           $('.dynamic').remove();

           // Creating dynamic element
            let openDiv = $("<div class='content__info dynamic'>");
            let span = $("<span>Phases of Work</span>");
            let select = $("<select name='engineering'>");
            let option = [
                        "<option value='' disabled selected>Select Phases of Work</option>",
                        "<option value='schematic'>Schematic</option>",
                        "<option value='designDevelopment'>Design Development</option>",
                        "<option value='constructionDrawings'>Construction Drawings</option>",
                        "<option value='siteSupervision'>Site Supervision</option>",
                        ];
      
            // Marge all element
            $(openDiv).append(span);
            $(openDiv).append(select);
            $(select).append(option);
            $(openDiv).append(select);

            // implement to html 
            $(openDiv).insertAfter('#services');

         } else if(selectedVal == "interior design") {

           // Remove the unselected service
           $('.dynamic').remove();

            // Creating dynamic element
           let openDiv = $("<div class='content__info dynamic architecture'>");
           let span = $("<span>Phases of Work</span>");
           let select = $("<select name='interior design'>");
           let option = [
                        "<option value='' disabled selected>Select Phases of Work</option>",
                        "<option value='conceptual'>Conceptual</option>",
                        "<option value='schematic'>Schematic</option>",
                        "<option value='designDevelopment'>Design Development</option>",
                        "<option value='constructionDrawings'>Construction Drawings</option>",
                        ];
    
            // Marge all element
            $(openDiv).append(span);
            $(openDiv).append(select);
            $(select).append(option);
            $(openDiv).append(select);

            // implement to html 
            $(openDiv).insertAfter('#services');

         } else if(selectedVal == "master planning") {

           // Remove the unselected service
           $('.dynamic').remove();

            // Creating dynamic element
           let openDiv = $("<div class='content__info dynamic'>");
           let span = $("<span>Phases of Work</span>");
           let select = $("<select name='master planning'>");
           let option = [
                        "<option value='' disabled selected>Select Phases of Work</option>",
                        "<option value='conceptual'>Conceptual</option>",
                        "<option value='schematic'>Schematic</option>",
                        ];
    
            // Marge all element
            $(openDiv).append(span);
            $(openDiv).append(select);
            $(select).append(option);
            $(openDiv).append(select);

            // implement to html 
            $(openDiv).insertAfter('#services');
         } else {

            $('.dynamic').remove();

         }
         
      });
   }
   selectServices();

   function selectDepartment() {

      $(document).on('change', '.architecture', function(){

         let selectedVal = this.value;

         if(selectedVal == 'conceptual' || selectedVal == 'schematic'){
            
            $('#department').attr("placeholder", " Design Manager");
            $('#department').removeAttr("disabled");

            let dept = "design";

            $.ajax({   
               type: 'POST',
               url: 'managersTable.php',
               data: {
                  'Department': dept,
               },
                  success:function(data){
                     $('.managersTable').html(data);
               }
             });
            

         } else if(selectedVal == 'design development' || selectedVal == 'construction drawings'){

            $('#department').attr("placeholder", " Production Manager");
            $('#department').removeAttr("disabled");

         } else if(selectedVal == 'site supervision'){

            $('#department').attr("placeholder", " Site Supervision Manager");
            $('#department').removeAttr("disabled");

         }

      });
   }
   selectDepartment();

   function dynamicList() {

   let addBtn = document.querySelectorAll('.addBtn');

       Array.from(addBtn).forEach((btn) => {

         btn.addEventListener('click', () => {

            let ul = document.querySelector('.list ul');
            let nameofuser = document.querySelector('.nameofuser').innerText;
            var li = document.createElement('li');

            // $(".list ul").append('<li>');

            console.log(ul);
            console.log(nameofuser);

         });

      });

   }

   let searchUser = document.querySelector('.searchUser-input');

   searchUser.addEventListener('keyup', () => {
      dynamicList();
   });

});


