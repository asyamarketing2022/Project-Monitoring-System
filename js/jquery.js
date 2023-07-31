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
            url: 'notification-count.php',
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

   //Search Filter (User Log)
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

   //Limit of data in table (User Log)
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

   //Changing Data thru pagination (User Log)
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

   //Pagination with LimitData (User Log)
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

   //Selected Page (User Log)
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

   function selectServicesxxxxxxxxx() {
      $(document).on('change', '.services', function(){

         let selectedVal = this.value;

         if(selectedVal == "architecture") {

           // Remove the unselected service
           $('.dynamic').remove();

            // Creating dynamic element
           let openDiv = $("<div class='content__info dynamic'>");
           let span = $("<span>Phases of Work</span>");
           let select = $("<select class='phases-of-work architecture' name='architecture'>");
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
            let select = $("<select class='phases-of-work engineering' name='engineering'>");
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
           let select = $("<select class='phases-of-work interiorDesign' name='interior design'>");
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
           let select = $("<select class='phases-of-work masterPlanning' name='master planning'>");
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
   // selectServices();

   function swiperInit() {
      var swiper = new Swiper(".mySwiper", {
         pagination: {
           el: ".swiper-pagination",
           type: "progressbar",
         },
         navigation: {
           nextEl: ".swiper-button-next",
           prevEl: ".swiper-button-prev",
         },
       });

   }
   swiperInit()

   class SelectServices 
   {
       constructor(name, checkbox, services, powContent) {
           this.name = name;
           this.checkbox = checkbox;
           this.services = services;
           this.powContent = powContent;
       }
   
       dynamic_phaseofwork() {

         let dynamic_checkbox = `<div class='pow ${this.powContent}'>
                                    <span>Phases of Work</span>
                                 </div>`;


            $(this.checkbox).off().on('change', ()=> {

               if($(this.checkbox).is(':checked')) {
                  
                  let checkbox_wrapper = $(this.checkbox).parent();
                  $(dynamic_checkbox).appendTo(checkbox_wrapper);

               } else if($(this.checkbox).prop('checked', false)) {

                  let powContent= document.getElementsByClassName(this.powContent);
                  $(powContent).remove();

               }

            });

       }

      engrDepartment() {
         
         let deparment = `<div class='pow ${this.powContent}'>
                              <span>Department</span>
                              <div class="form-check dept_list">
                                 <div class="checkbox_wrapper">
                                    <input class="form-check-input dept_checkbox mechanical" name="mechanical" type="checkbox" value="">
                                    <label class="form-check-label" for="flexCheckDefault">
                                       Mechanical
                                    </label>
                                    <div class="managers_wrapper"></div>
                                 </div>
                              </div>

                              <div class="form-check dept_list">
                                 <div class="checkbox_wrapper">
                                    <input class="form-check-input dept_checkbox electrical" name="electrical" type="checkbox" value="">
                                    <label class="form-check-label" for="flexCheckDefault">
                                       Electrical
                                    </label>
                                    <div class="managers_wrapper"></div>
                                 </div>
                              </div>

                              <div class="form-check dept_list">
                                 <div class="checkbox_wrapper">
                                    <input class="form-check-input dept_checkbox plumbing" name="plumbing" type="checkbox" value="">
                                    <label class="form-check-label" for="flexCheckDefault">
                                       Plumbing
                                    </label>
                                    <div class="managers_wrapper"></div>
                                 </div>
                              </div>

                              <div class="form-check dept_list">
                                 <div class="checkbox_wrapper">
                                    <input class="form-check-input dept_checkbox fireProtection" name="fire protection" type="checkbox" value="">
                                    <label class="form-check-label" for="flexCheckDefault">
                                       Fire Protection
                                    </label>
                                    <div class="managers_wrapper"></div>
                                 </div>
                              </div>

                              <div class="form-check dept_list">
                                 <div class="checkbox_wrapper">
                                    <input class="form-check-input dept_checkbox structural" name="structural" type="checkbox" value="">
                                    <label class="form-check-label" for="flexCheckDefault">
                                       Structural
                                    </label>
                                    <div class="managers_wrapper"></div>
                                 </div>
                              </div>
                           </div>`;

          $(this.checkbox).off().on('change', ()=> {       
            
            if($(this.checkbox).is(':checked')) {
                  
               let checkbox_wrapper = $(this.checkbox).parent();
               $(deparment).appendTo(checkbox_wrapper);

            } else if($(this.checkbox).prop('checked', false)) {

               let powContent= document.getElementsByClassName(this.powContent);
               $(powContent).remove();

            }

          });
         
      }

       conceptual() {

         $(this.checkbox).on('change', ()=> {
               let powContent= document.getElementsByClassName(this.powContent);
               let pow_checkbox = `<div class="form-check pow_wrapper" >
                     <div class="checkbox_wrapper">
                        <input class="form-check-input pow_checkbox conceptual" name="${this.name}_conceptual" type="checkbox" value="1">
                        <label class="form-check-label" for="flexCheckDefault">
                           Conceptual
                        </label>
                        <div class="managers_wrapper"></div>
                     </div>

                  </div>`;

               $(pow_checkbox).appendTo(powContent);
         });
      } 

      schematic() {

         $(this.checkbox).on('change', ()=> {
         
            let powContent = document.getElementsByClassName(this.powContent);
            let pow_checkbox = `<div class="form-check pow_wrapper" >
                                 <div class="checkbox_wrapper">
                                    <input class="form-check-input pow_checkbox schematic" name="${this.name}_schematic" type="checkbox" value="1">
                                    <label class="form-check-label" for="flexCheckDefault">
                                       Schematic
                                    </label>
                                    <div class="managers_wrapper"></div>
                                 </div>`;
      
            $(pow_checkbox).appendTo(powContent);
   
         });
      }

      designDevelopment() {

         $(this.checkbox).on('change', ()=> {

            let powContent = document.getElementsByClassName(this.powContent);
            let pow_checkbox = `<div class="form-check pow_wrapper">
                                 <div class="checkbox_wrapper">
                                    <input class="form-check-input pow_checkbox designDevelopment" name="${this.name}_designdevelopment" type="checkbox" value="1">
                                    <label class="form-check-label" for="flexCheckDefault">
                                       Design Development
                                    </label>
                                    <div class="managers_wrapper"></div>
                                 </div>
                                 </div>`;
      
            $(pow_checkbox).appendTo(powContent);

         });

      }

      constructionDrawings() {

         $(this.checkbox).on('change', ()=> {
         
            let powContent = document.getElementsByClassName(this.powContent);
            let pow_checkbox = `<div class="form-check pow_wrapper">
                                 <div class="checkbox_wrapper">
                                    <input class="form-check-input pow_checkbox constructionDrawings" name="${this.name}_construction" type="checkbox" value="1">
                                    <label class="form-check-label" for="flexCheckDefault">
                                       Construction Drawings
                                    </label>
                                    <div class="managers_wrapper"></div>
                                    </div>
                                 </div>`;
      
            $(pow_checkbox).appendTo(powContent);
        
         });

      }

      siteSupervision() {

         $(this.checkbox).on('change', ()=> {
         
            let powContent = document.getElementsByClassName(this.powContent);
            let pow_checkbox = `<div class="form-check pow_wrapper">
                                 <div class="checkbox_wrapper">
                                    <input class="form-check-input pow_checkbox siteSupervision" name="${this.name}_site" type="checkbox" value="1">
                                    <label class="form-check-label" for="flexCheckDefault">
                                       Site Supervision
                                    </label>
                                    <div class="managers_wrapper"></div>
                                 </div>
                                 </div>`;
      
            $(pow_checkbox).appendTo(powContent);
        
         });

      }
     
   }

   let arch = new SelectServices('arch', '#architecture', 'Architecture', 'arch-pow_wrapper');
   $('#architecture').on('change', arch.dynamic_phaseofwork(), arch.conceptual(), arch.schematic(), arch.designDevelopment(), arch.constructionDrawings(), arch.siteSupervision()  );

   // let engi = new SelectServices('engi', '#engineering', 'Engineering', 'engi-pow_wrapper');
   // $('#engineering').on('change', engi.engrDepartment());
   let engi = new SelectServices('engi', '#engineering', 'Engineering', 'engi-pow_wrapper');
   $('#engineering').on('change', engi.dynamic_phaseofwork(), engi.schematic(), engi.designDevelopment(), engi.constructionDrawings() );

   let intDesign = new SelectServices('interior', '#interiorDesign', 'Interior Design', 'interiorDesign-pow_wrapper');
   $('#interiorDesign').on('change', intDesign.dynamic_phaseofwork(), intDesign.conceptual(), intDesign.designDevelopment(), intDesign.constructionDrawings(), intDesign.siteSupervision());

   let masterPlanning = new SelectServices('masterplan', '#masterPlanning', 'Master Planning', 'masterPlanning-pow_wrapper');
   $('#masterPlanning').on('change', masterPlanning.dynamic_phaseofwork(), masterPlanning.conceptual(), masterPlanning.schematic());


   //Phase of work checkbox to select managers
   class SelectCheckbox
   {
      constructor(pow_wrapper, service_checkbox, phaseofwork_checkbox, department) {
           this.pow_wrapper = pow_wrapper;
           this.service_checkbox = service_checkbox;
           this.phaseofwork_checkbox = phaseofwork_checkbox;
           this.department = department;
      }

      pow_checkbox()
      {

         let phaseofwork_checkbox = document.querySelectorAll(`${this.pow_wrapper} .pow_checkbox${this.phaseofwork_checkbox}`);

         Array.from(phaseofwork_checkbox).forEach((checkbox) => {

            $(checkbox).off().on('click', ()=> {

               let checkbox_wrapper = $(checkbox).parent();
               let managerWrapper = $(checkbox_wrapper).children().last();

               if($(checkbox).is(':checked') ) {
                     
               let dept = `${this.department}`
         
                  $.ajax({   
                     type: 'POST',
                     url: 'departmentManager.php',
                     data: {
                        'dept': dept,
                     },
                        success:function(data){
                                 
                           $(managerWrapper).html(data);
            
                        }
                  });

               } else {
   
                  $(managerWrapper).children().remove();
   
               }
   
             });

         });
      }

      dept_checkbox()
      {

         let phaseofwork_checkbox = document.querySelectorAll(`${this.pow_wrapper} .dept_checkbox${this.phaseofwork_checkbox}`);

         Array.from(phaseofwork_checkbox).forEach((checkbox) => {

            $(checkbox).off().on('click', ()=> {

               let checkbox_wrapper = $(checkbox).parent();
               let managerWrapper = $(checkbox_wrapper).children().last();

               if($(checkbox).is(':checked') ) {
                     
               let dept = `${this.department}`
         
                  $.ajax({   
                     type: 'POST',
                     url: 'departmentManager.php',
                     data: {
                        'dept': dept,
                     },
                        success:function(data){
                                 
                           $(managerWrapper).html(data);
            
                        }
                  });
   
               } else {
   
                  $(managerWrapper).children().remove();
   
               }
   
             });

         });
      }

      managers_checkbox()
      {
         let checkbox = document.querySelectorAll(`${this.pow_wrapper} .managerCheckbox_container ${this.service_checkbox}${this.phaseofwork_checkbox}`);
       
            for (let i = 0; checkbox.length > i; i++){

               if($(checkbox[i]).off().is(':checked')) {

                  let formCheck = $(checkbox[i]).parent();

                  if($(formCheck).children().length < 3){

                     let department_space = `${this.department}`;
                     let department = department_space.replace(/\s/g, '');

                     let phaseofwork_Wrapper = `<div class="phase_of_work">
                     <span>Phase of Work</span>
                     <div class="form-check">
                        <input class="form-check-input schematic" name="${department}_schematic[]" type="checkbox" value="">
                        <label class="form-check-label" for="flexCheckDefault">Schematic<label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input designDevelopment" name="${department}_designdevelopment[]" type="checkbox" value="">
                        <label class="form-check-label" for="flexCheckDefault">Design Development<label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input constructionDrawing" name="${department}_constructiondrawing[]" type="checkbox" value="">
                        <label class="form-check-label" for="flexCheckDefault">Construction Drawings<label>
                     </div>
                  </div>`;

                  $(phaseofwork_Wrapper).appendTo(formCheck);

                  } 

               } else if($(checkbox[i]).is(':not(:checked)')) {

                  let formCheck = $(checkbox[i]).parent();
                  $(formCheck).children().eq(2).remove();

               }

         }
        
      }

      managers()
      {
         let powCheckbox = document.querySelectorAll(`${this.pow_wrapper} ${this.phaseofwork_checkbox}`);
    
         for (let i = 0; i < powCheckbox.length; i++){

            let powCheckbox_wrapper = $(powCheckbox[i]).parent();
            if($(powCheckbox[i]).off().is(':checked')){
   
               let managersWrapper = $(powCheckbox_wrapper).children().eq(2);
               let formCheck_array = managersWrapper.children();
           
               Array.from(formCheck_array).forEach((formCheck) => {
   
                  let checkbox = $(formCheck).children().eq(0);
                  let powStringdot = `${this.phaseofwork_checkbox}`;
                  let pow = powStringdot.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '.')
                  let underscore = '_';
                  let department_space = `${this.department}`;
                  let department = department_space.replace(/\s/g, '');
                  let array = '[]';
   
                  let name1 = pow.concat(underscore);
                  let name2 = name1.concat(department);
                  let final = name2.concat(array);
   
                  $(checkbox).attr('name', final);
   
   
               });   
   
            } 

         } 

      }

    
   }
   let archConceptual = new SelectCheckbox('.arch-pow_wrapper', '#architecture', '.conceptual', 'design');
   let archSchematic = new SelectCheckbox('.arch-pow_wrapper', '#architecture', '.schematic', 'design');
   let archdesignDev = new SelectCheckbox('.arch-pow_wrapper', '#architecture', '.designDevelopment', 'production');
   let archconsDrawings = new SelectCheckbox('.arch-pow_wrapper', '#architecture', '.constructionDrawings', 'project management');
   let archsiteVision = new SelectCheckbox('.arch-pow_wrapper', '#architecture', '.siteSupervision', 'project management');
   
   let engrMechanical = new SelectCheckbox('.engi-pow_wrapper', '#engineering', '.mechanical', 'mechanical');
   let engrElectrical = new SelectCheckbox('.engi-pow_wrapper', '#engineering', '.electrical', 'electrical');
   let engrPlumbing = new SelectCheckbox('.engi-pow_wrapper', '#engineering', '.plumbing', 'plumbing');
   let engrFirepro = new SelectCheckbox('.engi-pow_wrapper', '#engineering', '.fireProtection', 'fire protection');
   let engrStructural = new SelectCheckbox('.engi-pow_wrapper', '#engineering', '.structural', 'structural');

   let interiorDesign_Conceptual = new SelectCheckbox('.interiorDesign-pow_wrapper', '#interiorDesign', '.conceptual', 'interior design');
   let interiorDesign_designDev = new SelectCheckbox('.interiorDesign-pow_wrapper', '#interiorDesign', '.designDevelopment', 'interior design');
   let interiorDesign_constructionDrawings = new SelectCheckbox('.interiorDesign-pow_wrapper', '#interiorDesign', '.constructionDrawings', 'interior design');
   let interiorDesign_siteSupervision = new SelectCheckbox('.interiorDesign-pow_wrapper', '#interiorDesign', '.siteSupervision', 'interior design');
   
   let masterPlanning_Conceptual = new SelectCheckbox('.masterPlanning-pow_wrapper', '#masterPlanning', '.conceptual', 'master planning');
   let masterPlanning_Schematic = new SelectCheckbox('.masterPlanning-pow_wrapper', '#masterPlanning', '.schematic', 'master planning');

   // let engrMechanical = new SelectCheckbox('.engi-pow_wrapper', '#engineering', '.mechanical', 'mechanical');
   // let engrElectrical = new SelectCheckbox('.engi-pow_wrapper', '#engineering', '.electrical', 'electrical');
   // let engrPlumbing = new SelectCheckbox('.engi-pow_wrapper', '#engineering', '.plumbing', 'plumbing');
   // let engrFirepro = new SelectCheckbox('.engi-pow_wrapper', '#engineering', '.fireProtection', 'fire protection');
   // let engrStructural = new SelectCheckbox('.engi-pow_wrapper', '#engineering', '.structural', 'structural');

   let mechanicalDepartmentCheckbox = new SelectCheckbox('.engi-pow_wrapper', '.managersCheckbox', '.mechanical', 'mechanical' );
   let electricalDepartmentCheckbox = new SelectCheckbox('.engi-pow_wrapper', '.managersCheckbox', '.electrical', 'electrical');
   let plumbingDepartmentCheckbox = new SelectCheckbox('.engi-pow_wrapper', '.managersCheckbox', '.plumbing', 'plumbing');
   let fireProtectionDepartmentCheckbox = new SelectCheckbox('.engi-pow_wrapper', '.managersCheckbox', '.fire', 'fire protection');
   let structuralDepartmentCheckbox = new SelectCheckbox('.engi-pow_wrapper', '.managersCheckbox', '.structural', 'structural');

 
   $(document).on('change', ()=> {

      archConceptual.managers();
      archSchematic.managers();
      archdesignDev.managers();
      archconsDrawings.managers();
      archsiteVision.managers();

      // mechanicalDepartmentCheckbox.managers();
      // electricalDepartmentCheckbox.managers();
      // plumbingDepartmentCheckbox.managers();
      // fireProtectionDepartmentCheckbox.managers();
      // structuralDepartmentCheckbox.managers();
      
      interiorDesign_Conceptual.managers();
      interiorDesign_designDev.managers();
      interiorDesign_constructionDrawings.managers();
      interiorDesign_siteSupervision.managers();

      masterPlanning_Conceptual.managers();
      masterPlanning_Schematic.managers();

      // //Department Manager > checkbox
      // mechanicalDepartmentCheckbox.managers_checkbox();
      // electricalDepartmentCheckbox.managers_checkbox();
      // plumbingDepartmentCheckbox.managers_checkbox();
      // fireProtectionDepartmentCheckbox.managers_checkbox();
      // structuralDepartmentCheckbox.managers_checkbox();

      // //Architecture services > Phase of work checkbox
      // archConceptual.pow_checkbox();
      // archSchematic.pow_checkbox();
      // archdesignDev.pow_checkbox();
      // archconsDrawings.pow_checkbox();
      // archsiteVision.pow_checkbox();

      // //Interior Design services > Phase of work checkbox
      // interiorDesign_Conceptual.pow_checkbox();
      // interiorDesign_designDev.pow_checkbox();
      // interiorDesign_constructionDrawings.pow_checkbox();
      // interiorDesign_siteSupervision.pow_checkbox();

      // //Master planning services > Phase of work checkbox
      // masterPlanning_Conceptual.pow_checkbox();
      // masterPlanning_Schematic.pow_checkbox();

      // //Engineering Department > checkbox
      // engrMechanical.dept_checkbox();
      // engrElectrical.dept_checkbox();
      // engrPlumbing.dept_checkbox();
      // engrFirepro.dept_checkbox();
      // engrStructural.dept_checkbox();



   });

   // function xx() {

   //    let checkboxes = document.querySelectorAll('.engi-pow_wrapper .managers_wrapper .form-check-input')

   //    Array.from(checkboxes).forEach((checkbox) => {

   //       $(checkbox).off().on('click', ()=> {

   //          // mechanicalDepartmentCheckbox.managers_checkbox();
   //          // electricalDepartmentCheckbox.managers_checkbox();
   //          // plumbingDepartmentCheckbox.managers_checkbox();
   //          // fireProtectionDepartmentCheckbox.managers_checkbox();

   //          console.log('okay');
      
   //       });


   //    });

   // }

   // $(document).on('change', xx());


   // Engineering Department Checkbox
   function engrDepartment_checkbox(){
      let checkboxes = document.querySelectorAll('.engi-pow_wrapper .managers_wrapper .managersCheckbox');

      Array.from(checkboxes).forEach((checkbox) => {

         // $(checkbox).off().on('click', checkbox, ()=> {
         $(checkbox).off().on('click', ()=> {

            console.log('okay');

         });

      });
     
   }
   // $(document).on('change', engrDepartment_checkbox);

   // Engineering Manager Checkbox
   function engrManager_checkbox(){
      let checkbox = document.querySelectorAll('.engi-pow_wrapper .managersCheckbox');

      for (let i = 0; i < checkbox.length; i++) {

         $(checkbox[i]).off().on('change', `${(checkbox[i])}:checkbox`, ()=> {
   
            if($(checkbox[i]).is(':checked')) {

               let checkboxWrapper = $(checkbox[i]).parent();
               let phaseofwork_Wrapper = `<div class="phase_of_work">
                  <span>Phase of Work</span>
                  <div class="form-check">
                     <input class="form-check-input" name="" type="checkbox" value="">
                     <label class="form-check-label" for="flexCheckDefault">Schematic<label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" name="" type="checkbox" value="">
                     <label class="form-check-label" for="flexCheckDefault">Design Development<label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" name="" type="checkbox" value="">
                     <label class="form-check-label" for="flexCheckDefault">Construction Drawings<label>
                  </div>
               </div>`;

               $(phaseofwork_Wrapper).appendTo(checkboxWrapper);
              

            } else {

               let checkboxWrapper = $(checkbox[i]).parent();
               $(checkboxWrapper).children().eq(2).remove();

            }

         });

      }

   }
   // $(document).on('change', engrManager_checkbox);


   // Creating dyanamic inputbox
   function pow_checkbox() {
      let powCheckbox = document.querySelectorAll('.pow_checkbox');

      Array.from(powCheckbox).forEach((checkbox)=> {

         $(checkbox).off().on('change', ()=> {
            
            let wrapper = $(checkbox).parent().parent();

            Array.from(wrapper).forEach((checkbox_wrapper)=> {

                  if($(checkbox).is(':checked')) {

                     let dynamicInput = `<input class="textEnter" type="text"><button type="button" class="btn btn-primary enterBtn ">Enter</button>`
                     let contentSearch = $(checkbox_wrapper).children().eq(1);
      
                     $(dynamicInput).appendTo(contentSearch);

                  } else {

                     let contentSearch = $(checkbox_wrapper).children().eq(1);
                     $(contentSearch).children().remove();

                  }
               
            });

         });
         
      });
   }
   // $(document).on('change', pow_checkbox);


   // Get Text Value and Print
   function enterText() {
      let enterBtn = document.querySelectorAll('.enterBtn');

         Array(enterBtn).forEach((btn_nodelist)=> {

               $(btn_nodelist).off().on('click', ()=> {

                  Array.from(btn_nodelist).forEach((btn)=> {
                     
                     $(btn).off().on('click', ()=> {

                     let contentSearch = $(btn).parent();
                     let textEnter = $(contentSearch).children().eq(0);
                     let textValue = $(textEnter).val();  
                     
                     let pow_wrapper = $(btn).parent().parent();
                     let contentEnter = $(pow_wrapper).children().eq(2);
                     let ul_fn = contentEnter.children().eq(0)
                     let li = `<li class='contentlist'><img class="removeContent" src="../img/x-circle-red.svg" alt=""> ${textValue} </li>`;

                     $(li).appendTo(ul_fn);


                     });
                     
                  });

               });

         });

   }
   // $(document).on('change', enterText);

   $(document).on('change', ()=> {

      let enterBtn = document.querySelectorAll('.enterBtn');

      Array.from(enterBtn).forEach((btn) => {

         $(btn).on('click', ()=> {

            let contentList = document.querySelectorAll('.contentlist');
 
         });

         let x = contentList;

      });

   });


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


   function removeUser() {

      let btns = document.querySelectorAll('.removeUser')

      Array.from(btns).forEach((btn) => {
  
         $(btn).on('click', () => {

            $(btn).closest('ul').remove();
            

          });
          
      });

   }

   function selectedUser() {

   let searchUser = document.querySelectorAll('.search-user');
   let list = document.querySelector('.list');

       Array.from(searchUser).forEach((user) => {

         $(user).off().on('click', function(){

         let listManagers = document.querySelectorAll('.list ul');
         let nameofuser = $(user).children('li')[1];
         let val1 = $(nameofuser).text()


         // Array.from(listManagers).forEach((manager) => {

         //    let managersName = $(manager).children('li')[1];
         //    let val2 = $(managersName).text()

         //    if(val1 != val2 || $('.list').is(':parent')){
        
         //       let ul = $("<ul>")
         //       let userChild = $(user).children();
         //       let userInfo = $(userChild).clone();
        
         //       $(ul).append(userInfo);
         //       $(list).append(ul);
         //       // $(this).css("display", "none");
           
         //       let btn = document.querySelector('.list .addBtn');
         //       $(btn).text('remove');
         //       $(btn).addClass('removeUser');
         //       $(btn).removeClass('addBtn');

         //    } else {
         //       console.log('same');
         //    }

         // });

         for(let i = 0; i < listManagers.length || i == listManagers.length; i++ ){

            let managersName = $(listManagers[i]).children('li')[1];
            let val2 = $(managersName).text()

            if(val1 != val2 ){

               let ul = $("<ul>")
               let userChild = $(user).children();
               let userInfo = $(userChild).clone();
        
               $(ul).append(userInfo);
               $(list).append(ul);
               // $(this).css("display", "none");
           
               let btn = document.querySelector('.list .addBtn');
               $(btn).text('remove');
               $(btn).addClass('removeUser');
               $(btn).removeClass('addBtn');
               
               console.log('not same');

            } else {

     
               console.log('same');
            }
         
   
            return "Not found"
         } 



  
            // Array.from(userChild).forEach((userInfo) => {

            //    console.log($(userInfo).text());

            // });
            // let nameofuser = user.querySelector('.nameofuser').innerText;
            
            // users_array.push($(user).attr('value'));

            // $(".list ul").append('<li>');
            removeUser();
         });

      });

   }

   let searchUser = document.querySelector('.searchUser-input');

   $(searchUser).on('change', () => {
      selectedUser();
   })


   //Phase of work status clicked
   function statusTooltip(){

      let td_powStatus = document.querySelectorAll('.pow_status');

      for (let i = 0; td_powStatus.length > i; i++) {

         let textStatus = $(td_powStatus[i]).children('.text_status');
         let tooltip = $(td_powStatus[i]).children('.status_tooltip');

         $(textStatus).on('click', ()=> {

            if($(tooltip).hasClass('d-none')) {

               $(tooltip).removeClass('d-none');
    
            } else {
               
               $(tooltip).addClass('d-none');

            }

         });
         
      }
   }
   statusTooltip();


   function statusColor(){

      let textStatus = document.querySelectorAll('.text_status');
      let span = document.querySelectorAll('.text_status span');

      for(let num = 0; textStatus.length > num; num++){

         if($(span[num]).text() === 'Working on it'){

            // $(textStatus[num]).css("background", "#fdab3d");
            $(span[num]).parent().css("background", "#fdab3d");

         } else if($(span[num]).text() === 'Stuck') {

            // $(textStatus[num]).css("background", "#e2445c");
            $(span[num]).parent().css("background", "#e2445c");
            
         } else if($(span[num]).text() === 'Done') {

            // $(textStatus[num]).css("background", "#00c875");
            $(span[num]).parent().css("background", "#00c875");

         } else {

            // $(textStatus[num]).css("background", "#abd8e3");
            $(span[num]).parent().css("background", "#abd8e3");

         }

      }
   }
   statusColor();
   

   function enterStatus(){

      let statusTooltip = document.querySelectorAll('.status_tooltip');

      for (let i = 0; statusTooltip.length > i; i++) {

        let span = $(statusTooltip[i]).children('span');
        let input = $(statusTooltip[i]).children('input');
        let powStatus = $(statusTooltip[i]).parent();
        let textStatus = $(powStatus).children('.text_status');

        for (let num = 0; span.length > num; num++) {
         
            $(span[num]).off().on('click', ()=> {

             $(span[num]).parent().addClass('d-none');

             let updateStatus = $(span[num]).text();
             let status_db_row = $(powStatus).attr('value');
             let projectId = $('#projectTitle').attr('value');

               $.ajax({   
               type: 'POST',
               url: 'phase-of-work_status.php',
               data: {
                  'updateStatus': updateStatus,
                  'projectId': projectId,
                  'status_db_Row': status_db_row,
                  },
                  success:function(data){
                     $(textStatus).html(data);
                  }
               });
            });

         }

         $(input).on('keypress', (e)=> {

            let inputText = $(input).val();
            let status_db_row = $(powStatus).attr('value');
            let projectId = $('#projectTitle').attr('value');

            
            if(e.key === 'Enter') {
   
                  $.ajax({   
                     type: 'POST',
                     url: 'phase-of-work_status.php',
                     data: {
                        'inputText': inputText,
                        'projectId': projectId,
                        'status_db_Row': status_db_row,
                        },
                        success:function(data){
                           $(textStatus).html(data);
                        }
                  });

                  $(input).parent().addClass('d-none');
                  $(textStatus).css("background", "#abd8e3");
              
            }

         });

      }

   }
   enterStatus();

   function taskStatus(){

      let statusTooltip = document.querySelectorAll('.user-tasks .status_tooltip');

      for (let i = 0; statusTooltip.length > i; i++) {

         let span = $(statusTooltip[i]).children('span');
         let input = $(statusTooltip[i]).children('input');
         let tableRow = $(statusTooltip[i]).parent().parent();

         let powStatus = $(statusTooltip[i]).parent();
         let textStatus = $(powStatus).children('.text_status');

         for (let num = 0; span.length > num; num++) { 

            $(span[num]).off().on('click', ()=> {

               $(span[num]).parent().addClass('d-none');

               let updateStatus = $(span[num]).text();
               let taskId = $(tableRow).find('.taskId').attr('value');

               $.ajax({   
                  type: 'POST',
                  url: 'taskStatus.php',
                  data: {
                     'updateStatus': updateStatus,
                     'taskId': taskId
                     },
                     success:function(data){
                        $(textStatus).html(data);
                  }
               });

            });

         };

         $(input).on('keypress', (e)=> {

            let inputText = $(input).val();
            let taskId = $(tableRow).find('.taskId').attr('value');
            
            if(e.key === 'Enter') {
   
                  $.ajax({   
                     type: 'POST',
                     url: 'taskStatus.php',
                     data: {
                        'taskId': taskId,
                        'inputText': inputText
                        },
                        success:function(data){
                           $(textStatus).html(data);
                        }
                  });

                  $(input).parent().addClass('d-none');
                  $(textStatus).css("background", "#abd8e3");
              
            }

         });

      }      

   }
   $('.tasks-content_container').on('mouseenter focus', taskStatus);
   $('.tasks-content_container').on('mouseleave blur', taskStatus);


   // Project Status Color Change function
   function changeStatus(){
   
      let powStatus_wrapper = document.querySelectorAll('.pow_status');

      Array.from(powStatus_wrapper).forEach((powStatus) => {

           let status_tooltip = $(powStatus).children('.status_tooltip');
           let textStatus = $(powStatus).children('.text_status');
           let orangeStatusBtn = $(status_tooltip).find('.orangeStatus');
           let redStatusBtn = $(status_tooltip).find('.redStatus');
           let greenStatusBtn = $(status_tooltip).find('.greenStatus');
   
            $(orangeStatusBtn).on('click', ()=> {
   
               $(textStatus).css("background", "#fdab3d");
     
            });

            $(redStatusBtn).on('click', ()=> {

               (textStatus).css("background", "#e2445c");

            });

            $(greenStatusBtn).on('click', ()=> {

               (textStatus).css("background", "#00c875");

            });
   
      });
   }
   changeStatus()
   $('.tasks-content_container').on('mouseenter focus', changeStatus);
   $('.tasks-content_container').on('mouseleave blur', changeStatus);


   // Assigned Manager - Modal
   function postUsersManager_in_modal(){

      let manager_photo_id = document.querySelectorAll('.manager_photo_id');

      for (let i = 0; manager_photo_id.length > i; i++) {

         $(manager_photo_id[i]).on('click', ()=> {

            let managerPhotoId = $(manager_photo_id[i]).attr('value');

            $.ajax({   
              type: 'POST',
              url: 'postUsersManager_in_modal.php',
              data: {
                 'managerPhotoId': managerPhotoId,
               },
               success:function(data){
                   $('.managers_container').html(data);
                 }
            });

         });
         
      }
   }
   postUsersManager_in_modal();

   // Assigned Project In Charge - Modal
   function postUsersProjectInCharge_in_modal(){

      let employeesAssigned_id = document.querySelectorAll('.projectIncharge_table_row');
      let managers_id = document.querySelectorAll('.who_assigned_manager');

      for (let i = 0; employeesAssigned_id.length > i; i++) {

         $(employeesAssigned_id[i]).on('click', ()=> {

            let employeeAssigned_id = $(employeesAssigned_id[i]).attr('value');
            let managerIds = $(managers_id[i]).attr('value');

            $.ajax({   
              type: 'POST',
              url: 'postUsersProjectInCharge_in_modal.php',
              data: {
                 'employeeAssigned_id': employeeAssigned_id,
                 'managerIds': managerIds,
               },
               success:function(data){
                   $('.project_in_charge_container').html(data);
                 }
            });
         });
         
      }
   }
   postUsersProjectInCharge_in_modal();

   // Project Info - Show Project Information function 
   function postProjectInfo_in_modal(){

      let infoIcon = document.querySelector('.info-icon');
      
      $(infoIcon).on('click', ()=> {

         let projectId = $('#projectTitle').attr('value');
         
         $.ajax({   
            type: 'POST',
            url: 'postProjectInfo_in_modal.php',
            data: {
               'projectId': projectId,
             },
             success:function(data){
                 $('.projectInfo_container').html(data);
               }
          });
      });
      
   }
   postProjectInfo_in_modal()

   // function postProjectInfo_in_modal_delay(){

   //    let projectInchargeBtn = document.querySelectorAll('.projectIncharge_table_row');

   //    for(let i = 0; projectInchargeBtn.length > i; i++){

   //       $(projectInchargeBtn[i]).on('click', ()=> {
   //          setTimeout(function() {
   //             $('#view_project_in_charge').modal('show');
   //          }, 1000);
   //       });

   //    }
   // }
   // postProjectInfo_in_modal_delay();


   // Upload File Path Function
   function upload_file_path(){

      let projectName = $('#projectTitle').text()
      let projectId = $('#projectTitle').attr('value');
      let uploadPathBtn = document.querySelectorAll('.uploadPathBtn');
      let td_phaseofwork = document.querySelectorAll('.td_phase_of_work');

      for(let i = 0; uploadPathBtn.length > i; i++){
         
         $(uploadPathBtn[i]).off().on('click', ()=> {

            let tableContainer = $(uploadPathBtn[i]).closest('.project_services_table');
            let projectService = $(tableContainer).find('th.th_services').text();
            let text_phaseofwork = $(td_phaseofwork[i]).text();

            $.ajax({
               type: 'POST',
               url: 'postUpload_file_path_modal.php',
               data: {
                  'projectId': projectId,
                  'projectName': projectName,
                  'projectService': projectService,
                  'text_phaseofwork': text_phaseofwork,
               },
               success:function(data){
                  $('.uploadFilePath_container').html(data);
               }
            });
         });

      }

   }
   upload_file_path();

   //Tasks upload file path tooltip 
   function upload_file_path_tooltip() {

      let uploadPathBtn = document.querySelectorAll('.uploadPathBtn');

      for(let i = 0; uploadPathBtn.length > i; i++){
   
            let upload_filepath_td = $(uploadPathBtn[i]).parent();
            let upload_filepath_tooltip = $(upload_filepath_td).find('.upload_filepath_tooltip');

            $(uploadPathBtn[i]).off().on('click', ()=> {

               let tableRow = $(uploadPathBtn[i]).parent().parent();
               let taskId = $(tableRow).find('.taskId').attr('value');
               let taskTitle = $(tableRow).find('.taskTitle').text();
               let employeeName = $('.user_photo h3').text();

               $.ajax({
                  type: 'POST',
                  url: 'tasks-table.php',
                  data: {
                     'employee-name': employeeName,
                  },
                  success:function(data){
                     $('.employee-name').html(data);
                  }
               });

               $.ajax({
                  type: 'POST',
                  url: 'tasks-table.php',
                  data: {
                     'taskId': taskId,
                  },
                  success:function(data){
                     $('.task-id').html(data);
                  }
               });

               $.ajax({
                  type: 'POST',
                  url: 'tasks-table.php',
                  data: {
                     'taskTitle': taskTitle
                  },
                  success:function(data){
                     $('.task-title').html(data);
                  }
               });

               if($(upload_filepath_tooltip).hasClass('d-none')) {
   
                  $(upload_filepath_tooltip).removeClass('d-none');
       
               } else {
                  
                  $(upload_filepath_tooltip).addClass('d-none');
   
               }
   
            });
      }

   }
   $('.tasks-content_container').on('mouseenter focus', upload_file_path_tooltip);
   $('.tasks-content_container').on('mouseleave blur', upload_file_path_tooltip);

 //Check file path tooltip 
 function check_file_path_tooltip() {

   let checkfilepathBtn = document.querySelectorAll('.checkfilepathBtn');

   for(let i = 0; checkfilepathBtn.length > i; i++){

      let check_filepath_td = $(checkfilepathBtn[i]).parent();
      let check_filepath_tooltip = $(check_filepath_td).find('.check_filepath_tooltip');

      $(checkfilepathBtn[i]).off().on('click', ()=> {

         let taskId = $($('.taskId')[i]).attr('value');

        $.ajax({
            type: 'POST',
            url: 'check_file_paths_table.php',
            data: {
               'taskId': taskId,
            },
            success:function(data){
               $('.check_filepath_wrapper .content-table').html(data);
            }

        });

         if($(check_filepath_tooltip).hasClass('d-none')) {
   
            $(check_filepath_tooltip).removeClass('d-none');
 
         } else {
            
            $(check_filepath_tooltip).addClass('d-none');

         }

      });

   }

 }
 $('.tasks-content_container').on('mouseenter focus', check_file_path_tooltip);
 $('.tasks-content_container').on('mouseleave blur', check_file_path_tooltip);

   //Tasks upload file path tooltip 
   function submit_file_path(){

      let submitBtn = document.querySelectorAll('.submit-file-path');

      for(let i = 0; submitBtn.length > i; i++){

         $(submitBtn[i]).off().on('click', ()=> {

            let notes = $($('.new-task-notes')[i]).val();
            let fileName = $($('.file-name')[i]).val();
            let filePath = $($('.file-path')[i]).val();
            let projectId = $('.project-Id').attr('value');
            let projectName = $('.project-name').attr('value');
            let phaseofwork = $('.phase-of-work').attr('value');
            let services = $('.services').attr('value');
            let employeeId = $('.employeeId').attr('value');
            let employeeName = $('.employee-name').html();
            let taskId = $('.task-id').html();
            let taskTitle = $('.task-title').html();

            $.ajax({
               type: 'POST',
               url: 'submitFile_path.php',
               data: {
                  'notes': notes,
                  'fileName': fileName,
                  'filePath': filePath,
                  'projectId': projectId,
                  'projectName': projectName,
                  'phaseofwork': phaseofwork,
                  'services': services,
                  'employeeId': employeeId,
                  'employeeName': employeeName,
                  'taskId': taskId,
                  'taskTitle': taskTitle
               },
               success:function(data){
                  // $('').html(data);
                  alert("success", data)
                  $($('.new-task-notes')[i]).val('');
                  $($('.file-name')[i]).val('');
                  $($('.file-path')[i]).val('');

                  $($('.upload_filepath_tooltip')[i]).addClass('d-none');
               }
            });

         });

      }

   }
   $('.tasks-content_container').on('mouseenter focus', submit_file_path);
   $('.tasks-content_container').on('mouseleave blur', submit_file_path);

   
   // View All File paths function
   function view_file_paths(){

      let projectId = $('#projectTitle').attr('value');
      let viewfilepathBtn = document.querySelectorAll('.viewfilepathBtn');
      let td_phaseofwork = document.querySelectorAll('.td_phase_of_work');

      for(let i = 0; viewfilepathBtn.length > i; i++){

         $(viewfilepathBtn[i]).on('click', ()=> {

            let tableContainer = $(viewfilepathBtn[i]).closest('.project_services_table');
            let projectService = $(tableContainer).find('th.th_services').text();
            let text_phaseofwork = $(td_phaseofwork[i]).text();

            $.ajax({
               type: 'POST',
               url: 'view-Filepath_in_modal.php',
               data: {
                  'projectId': projectId,
                  'projectService': projectService,
                  'text_phaseofwork': text_phaseofwork,
               },
               success:function(data){
                  $('.viewFilePath_container').html(data);
               }
            });
         });
      }

   }
   view_file_paths();

   //New Task Tooltip
   function newtask_tooltip(){

      let newTask_Btn = document.querySelectorAll('.new-task-btn');

      for(let i = 0; newTask_Btn.length > i; i++){

         let invite_status_td = $(newTask_Btn[i]).parent();
         let invite_status_tooltip = $(invite_status_td).find('.invite_status_tooltip');

         $(newTask_Btn[i]).off().on('click', ()=> {

            if($(invite_status_tooltip).hasClass('d-none')) {
   
               $(invite_status_tooltip).removeClass('d-none');
    
            } else {
               
               $(invite_status_tooltip).addClass('d-none');

            }

         });

      }

   }
   newtask_tooltip()

   //New Task Tooltip
   function decline_note_popup(){

         let decline_btn = document.querySelectorAll('.decline');
         let decline_note_wrapper = document.querySelectorAll('.decline-note_wrapper');
   
         for(let i = 0; decline_btn.length > i; i++){
   
            $(decline_btn[i]).off().on('click', ()=> {
   
               if($(decline_note_wrapper[i]).hasClass('d-none')) {
      
                  $(decline_note_wrapper[i]).removeClass('d-none');
       
               } else {
                  
                  $(decline_note_wrapper[i]).addClass('d-none');
   
               }

            });
   
         }
   
      }
   decline_note_popup();

   //Accept Task
   function accept_task(){

      let accept_btn = document.querySelectorAll('button.accept');
      let newTask_btn = document.querySelectorAll('.new-task-btn');

      for(let i = 0; accept_btn.length > i; i++){

        let taskId = $(accept_btn[i]).parents('.task-table_row').attr('value');

         $(accept_btn[i]).off().on('click', ()=> {

            let acceptText = 'accept';
            
            $.ajax({
               type: 'POST',
               url: 'task-accept.php',
               data: {
                  'taskId': taskId,
                  'acceptText': acceptText,
               },
               success:function(data){
               //  $(newTask_btn[i]).html(data);
                  window.location.reload();
               }
            });

         });

      }

   }
   accept_task();

   //Decline Task
   function decline_task(){

      let submit_decline_btn = document.querySelectorAll('.submit-decline');

      for(let i = 0; submit_decline_btn.length > i; i++ ) {

         let decline = document.querySelectorAll('.decline-notes');

         $(submit_decline_btn[i]).off().on('click', ()=> {

            let taskId = $(submit_decline_btn[i]).parents('.task-table_row').attr('value');
            let declineNotes = $(decline[i]).val();
            let declineText = 'decline';

            if($(decline[i]).val() == '') {

               alert('Please fill-up decline notes');

            } else {

                  $.ajax({
                     type: 'POST',
                     url: 'task-decline.php',
                     data: {
                        'taskId': taskId,
                        'declineText': declineText,
                        'declineNotes': declineNotes,
                     },
                     success:function(data){
                        window.location.reload();
                  }
               });

            }

         });
      }
   }
   decline_task();
  
   // Notes File Path - tooltip
   function tooltip(){

      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
         return new bootstrap.Tooltip(tooltipTriggerEl)
      })

   }

   let viewfilepathBtn = document.querySelectorAll('.viewfilepathBtn');

   Array.from(viewfilepathBtn).forEach((viewfilepath) => {

      $(viewfilepath).on('click', ()=> {

         setTimeout(
            function() 
            {
               tooltip();
            }, 500);

      });
   });

      // Search Manager Function
      function searchManager(){

         let searchManager = document.querySelector('.searchManager');
   
         $(searchManager).on('keydown', ()=> {

            let searchManager_pow = document.querySelector('.searchManager_pow');
            let searchManager_service = document.querySelector('.searchManager_service');
            let userIDs = document.querySelectorAll('.managers_container .user_container');
            let userId_container = [];

            let phase_of_work = $(searchManager_pow).text();
            let service = $(searchManager_service).text();

            Array.from(userIDs).forEach((userID) => {
    
               userId_container.push($(userID).attr('value'));
   
            });
   
            setTimeout(
               function() 
               {
                  let searchValue = $(searchManager).val();
   
                  $.ajax({
                     type: 'POST',
                     url: 'searchManager_table.php',
                     data: {
                        'userId_container' : userId_container,
                        'searchValue' : searchValue,
                        'phase_of_work' : phase_of_work,
                        'service' : service,
                     },
                     success:function(data){
                        $('.search_manager_wrapper').html(data);
                     }
                  });
   
               }, 50);

         });
         
      }
      searchManager();

   // Add Project In Charge Button - To Show All Not Assign Employee
   function addManagerBtn(){

      let addManagerBtn = document.querySelector('.addManagerBtn');

      $(addManagerBtn).on('click', ()=> {

            let searchManager_pow = document.querySelector('.searchManager_pow');
            let searchManager_service = document.querySelector('.searchManager_service');
            let userIDs = document.querySelectorAll('.managers_container .user_container');
            let userId_container = [];

            let phase_of_work = $(searchManager_pow).text();
            let service = $(searchManager_service).text();

            Array.from(userIDs).forEach((userID) => {
    
               userId_container.push($(userID).attr('value'));

            });

            $.ajax({
               type: 'POST',
               url: 'searchManager_table.php',
               data: {
                  'userId_container' : userId_container,
                  'phase_of_work' : phase_of_work,
                  'service' : service,
               },
               success:function(data){
                  $('.search_manager_wrapper').html(data);
               }
            });
      });

   }
   addManagerBtn();

   // Search Employee Function
   function searchEmployee(){

      let searchFilter = document.querySelector('.searchFilter');

      $(searchFilter).on('keydown', ()=> {

         let userIDs = document.querySelectorAll('.project_in_charge_container .user_container');
         let userId_container = [];

         Array.from(userIDs).forEach((userID) => {
 
            userId_container.push($(userID).attr('value'));

         });

         setTimeout(
            function() 
            {
               let searchValue = $(searchFilter).val();

               $.ajax({
                  type: 'POST',
                  url: 'searchEmployee_table.php',
                  data: {
                     'userId_container' : userId_container,
                     'searchValue' : searchValue,
                  },
                  success:function(data){
                     $('.search_employee_wrapper').html(data);
                  }
               });

            }, 50);
     
      });
      
   }
   searchEmployee();

   // Add Project In Charge Button - To Show All Not Assign Employee
   function addProjectInChargeBtn(){

      let addProjectInChargeBtn = document.querySelector('.addProjectInChargeBtn');

      $(addProjectInChargeBtn).on('click', ()=> {

            let userIDs = document.querySelectorAll('.project_in_charge_container .user_container');
            let userId_container = [];

            Array.from(userIDs).forEach((userID) => {
    
               userId_container.push($(userID).attr('value'));

            });

            $.ajax({
               type: 'POST',
               url: 'searchEmployee_table.php',
               data: {
                  'userId_container' : userId_container,
               },
               success:function(data){
                  $('.search_employee_wrapper').html(data);
               }
            });
      });

   }
   addProjectInChargeBtn();

   function addProjectInChargeBtn_clicked_delay(){

      let addProjectInChargeBtn = document.querySelector('.addProjectInChargeBtn');

      $(addProjectInChargeBtn).on('click', ()=> {

         setTimeout(function() {
            $('#addProjectInCharge').modal();
         }, 2000);

      });

   }
   addProjectInChargeBtn_clicked_delay()

   // Create a dynamic html element for Service and Phase of work
   function PIC_service_and_pow(){

      let projectIncharge_table_row = document.querySelectorAll('.projectIncharge_table_row');

      for (let i = 0; projectIncharge_table_row.length > i; i++){

         $(projectIncharge_table_row[i]).on('click', ()=> {

           let tableForm = $(projectIncharge_table_row[i]).parent();
           let td_pow = $(tableForm).children('.td_phase_of_work');
           let tbody = $(tableForm).parent();
           let projectService = $(tbody).find('th.th_services').text();
           let searchEmployee_container = document.querySelector('.search-employee_container');
           let contentInfoWrapper = document.querySelector('.addNewTask_form_container .content-info__wrapper');

           let contentInfo = `<div class="content__info d-none">
                                 <span>Phase of work:</span>
                                 <p class="searchEmployee_pow">${$(td_pow).text()}</p>
                              </div>
                              <div class="content__info d-none">
                                 <span>Service:</span>
                                 <p class='searchEmployee_service'>${projectService}</p>
                              </div>
                              `;

           $(contentInfo).appendTo(searchEmployee_container);
         //   $(contentInfo).prependTo(contentInfoWrapper);

   
         });

      }

   }
   PIC_service_and_pow();

   function manager_service_and_pow(){

      let manager_photo_id = document.querySelectorAll('.manager_photo_id');

      for (let i = 0; manager_photo_id.length > i; i++){

         $(manager_photo_id[i]).on('click', ()=> {

           let tableForm = $(manager_photo_id[i]).parent();
           let td_pow = $(tableForm).children('.td_phase_of_work');
           let tbody = $(tableForm).parent();
           let projectService = $(tbody).find('th.th_services').text();
           let searchManager_container = document.querySelector('.search-manager_container');

           let contentInfo = `<div class="content__info">
                                 <span>Phase of work:</span>
                                 <p class="searchManager_pow">${$(td_pow).text()}</p>
                              </div>
                              <div class="content__info">
                                 <span>Service:</span>
                                 <p class='searchManager_service'>${projectService}</p>
                              </div>
                              `;

           $(contentInfo).appendTo(searchManager_container);
            
            let phase_of_work = $(td_pow).text();

           $.ajax({
            type: 'POST',
            url: 'searchManager_table.php',
            data: {
               'projectService' : projectService,
               'phase_of_work' : phase_of_work,
            },
            success:function(data){
               $('.search_manager_wrapper').html(data);
            }
         });


         });

      }

   }
   manager_service_and_pow();

   // Select Manager Function
   function selectManager(){

      let selectBtn = document.querySelectorAll('.selectBtn');

      for(let i = 0; selectBtn.length > i; i++){

         $(selectBtn[i]).on('click', ()=> {

            let userContainer = $(selectBtn[i]).parent().parent();
            let managerId = $(userContainer).attr('value');
            let projectId = $('#projectTitle').attr('value');
            let searchManager_pow = $('.searchManager_pow').text()
            let searchManager_service = $('.searchManager_service').text()
 
            $.ajax({
               type: 'POST',
               url: 'assign-manager.php',
               data: {
                  'managerId' : managerId,
                  'projectId' : projectId,
                  'searchManager_pow' : searchManager_pow,
                  'searchManager_service' : searchManager_service,
               },
               success: function(data){
                   // alert("success", data);
                  setTimeout(
                     function()
                     {

                        window.location.reload();

                     }, 100);
               },
            });
         });

      }
   }
   $('.addManagerBtn').on('click', ()=> {

      setTimeout(

         function() 
            {

               selectManager();

         }, 100);

   });

   $('.searchManager ').on('keydown', ()=> {

      setTimeout(

         function() 
            {

               selectManager();

         }, 100);

   });



   // Select Employee Function
   function selectEmployee(){

      let selectBtn = document.querySelectorAll('.selectBtn');

      for(let i = 0; selectBtn.length > i; i++){

         $(selectBtn[i]).on('click', ()=> {

            let userContainer = $(selectBtn[i]).parent().parent();
            let employeeId = $(userContainer).attr('value');
            let projectId = $('#projectTitle').attr('value');
            let searchEmployee_pow = $('.searchEmployee_pow').text()
            let searchEmployee_service = $('.searchEmployee_service').text()

            $.ajax({
               type: 'POST',
               url: 'assign-projectIncharge.php',
               data: {
                  'projectId' : projectId,
                  'employeeId' : employeeId,
                  'searchEmployee_pow' : searchEmployee_pow,
                  'searchEmployee_service' : searchEmployee_service,
               },
               success: function (data) {
                  // alert("success", data);
                  setTimeout(
                     function()
                     {

                        window.location.reload();

                     }, 100);

                },
            });

         });

      }
   }
   $('.addProjectInChargeBtn').on('click', ()=> {

      setTimeout(

         function() 
            {

         selectEmployee();

         }, 100);

   });

   $('.searchFilter').on('keydown', ()=> {

      setTimeout(

         function() 
            {

         selectEmployee();

         }, 100);

   });


   function disable_previous_dates() {

      var today = new Date().toISOString().split('T')[0];
      var calendars = document.querySelectorAll('.dis_previous_dates');
      
      Array.from(calendars).forEach((calendar) => {

         calendar.setAttribute('min', today);

      });
  }
  disable_previous_dates();
   
  function set_duedate() {

      let calendars = document.querySelectorAll('.dueDate');
      let projectId = $('#projectTitle').attr('value');

      for(let i = 0; calendars.length > i; i++){

         let tableContainer = $(calendars[i]).closest('.project_services_table');
         let name = $(calendars[i]).attr('name');

         $(calendars[i]).on('change', ()=> {

            let date = $(calendars[i]).val();
 
             $.ajax({
                type: 'POST',
                url: 'set-dueDate.php',
                data: {
                   'date' : date,
                   'name' : name,
                   'projectId' : projectId 
                },
                success: function (data) {
                   // alert("success", data);
                   window.location.reload();
                },
             });

            // console.log(projectId);
             
          });

      }
  }
  set_duedate();


  function project_in_charge_clicked(){
      let $pic_table = document.querySelectorAll('.projectIncharge_table_row');

      for(let i = 0; $pic_table.length > i; i++){
         
         $($pic_table[i]).on('click', ()=> {

            setTimeout(

               function() 
                  {
      
                     window.ViewTasksBtn = document.querySelectorAll('.viewTasks');
                     
      
               }, 1);


         });

      }

  }
//   project_in_charge_clicked();

   function viewTasksBtn() {

      $('#view_project_in_charge').on('mouseenter', ()=> {

         let ViewTasksBtn = document.querySelectorAll('.viewTasks');

            for(let i = 0; ViewTasksBtn.length > i; i++){

               $(ViewTasksBtn[i]).off().on('click', ()=> {

                  $('.userId').parent().remove();
                  $('.employeeName').parent().remove();

                  let userContainer = $(ViewTasksBtn[i]).parent().parent().parent().parent();
                  let userId = $(userContainer).attr('value');
                  let employeeName = $(userContainer).find('.user_fullname span').text()
                  let contentInfoWrapper = document.querySelector('.addNewTask_form_container .content-info__wrapper');
                  let phase_of_work = $('.searchEmployee_pow').text();
                  let services = $('.searchEmployee_service').text();
                  let projectId = $('#projectTitle').attr('value');
                  let projectName = $('#projectTitle').text();

                  let contentInfo = `<div class="content__info d-none">
                                       <span>Employee Name:</span>
                                       <p class="employeeName" value="${employeeName}">${employeeName}</p>
                                    </div>
                                    <div class="content__info d-none">
                                       <span>User ID:</span>
                                       <p class="userId" value="${userId}">${userId}</p>
                                    </div>
                                    `;

                  $(contentInfo).prependTo(contentInfoWrapper);

                  console.log(employeeName);
        
                  // For task table
                  $.ajax({
                     type: 'POST',
                     url: 'tasks-table.php',
                     data: {
                        'userId': userId,
                        'phase_of_work': phase_of_work,
                        'services': services,
                        'projectId': projectId,
                        'projectName': projectName
                     },
                     success: function (data) {
                        // $('.user-tasks .content-table').html(data);
                        $('.user-tasks .content-table').html(data);
                     },
                  });

                  // For user Photo and Name
                  let fullName = $(userContainer).find('.user_fullname span').text();
                  let userPhoto = $(userContainer).find('.user_photo img').attr('src');
                  let employeeId = userId;

                  $.ajax({
                     type: 'POST',
                     url: 'tasks-table.php',
                     data: {
                        'employeeId': employeeId,
                        'fullName': fullName,
                        'userPhoto': userPhoto
                     },
                     success: function (data) {
                        // $('.user-tasks .content-table').html(data);
                        $('.tasks-content .user_photo').html(data);
                     },
                  });

                  setTimeout(

                     function() 
                        {

                     $('#view_project_in_charge .modal-left-content').addClass('move-left-22');

                  }, 10);

                  setTimeout(

                     function() 
                        {

                     $('.tasks-content_container').css('z-index', '10')   
                     $('.tasks-content').addClass('tasks-content_show');
              
                     statusColor()

                  }, 70);

               });
         }
      
      });
  }
  viewTasksBtn();

  // Task Statups Tool tip
  function taskStatusTooltip(){

         let taskStatus = document.querySelectorAll('.user-tasks .pow_status');

         for (let i = 0; taskStatus.length > i; i++) {
   
            let textStatus = $(taskStatus[i]).children('.text_status');
            let tooltip = $(taskStatus[i]).children('.status_tooltip');
   
            $(textStatus).off().on('click', ()=> {

               if($(tooltip).hasClass('d-none')) {
   
                  $(tooltip).removeClass('d-none');
       
               } else {
                  
                  $(tooltip).addClass('d-none');
   
               }
   
            });
            
         }

      // });
  }
  taskStatusTooltip();
  $('.tasks-content_container').on('mouseenter focus', taskStatusTooltip);
  $('.tasks-content_container').on('mouseleave blur', taskStatusTooltip);

  function addNewTask(){

   $('.tasks-content_container').on('mouseenter', ()=> {

      let addNewTastBtn = document.querySelector('.addNewTask');

      $('.addNewTask').off().on('click', ()=> {

         console.log('okay');

      });

   });
   
  }
  addNewTask();

  function addNewTask_form_show(){

      $('.addNewTaskBtn').on('click', ()=> {

         $('.addNewTask_form_container').toggle();

      }); 

  }
  addNewTask_form_show();

  function submitNewTask(){

   $('.submit-new-task').off().on('click', ()=> {

      let projectId = $('#projectTitle').attr('value');
      let projectTitle = $('#projectTitle').text();
      let employeeId = $('.userId').attr('value');
      let employeeName = $('.employeeName').attr('value');
      let phase_of_work = $('.searchEmployee_pow').text();
      let services = $('.searchEmployee_service').text();
      let taskTitle = $('.taskTitle_field').val();
      let dateStart = $('.date_start').val();
      let dateEnd = $('.date_end').val();
      let newTask_notes = $('.newTask_notes').val();

      let projectName = $('#projectTitle').text();

      if(!$('.taskTitle_field').val()) {
   
         alert('Fill-up Task Title');

      } else if(!$('.date_start').val()) {

         alert('Select Date Start');

      } else if(!$('.date_end').val()) {

         alert('Select Due Date');

      } else if(!$('.newTask_notes').val()) {

         alert('Fill-up Notes');

      } else {

         $.ajax({
            type: 'POST',
            url: 'add-newTask.php',
            data: {
               projectId: projectId,
               projectTitle: projectTitle,
               employeeId: employeeId,
               employeeName: employeeName,
               phase_of_work: phase_of_work,
               services: services,
               taskTitle: taskTitle,
               dateStart: dateStart,
               dateEnd, dateEnd,
               newTask_notes: newTask_notes,
               projectName: projectName
            },
            success: function (data) {
               // alert("success", data);
               // window.location.reload();
               $('.user-tasks .content-table').html(data);
               $('.addNewTask_form_container').css('display', 'none');

               $('.taskTitle_field').val('');
               $('.date_start').val('');
               $('.date_end').val('');
               $('.newTask_notes').val('');

               setTimeout(

                  function() 
                     {

                     taskStatusTooltip();
                     statusColor();
                     upload_file_path_tooltip();

                     $('.tasks-content_container').on('mouseenter focus', taskStatus);
                     $('.tasks-content_container').on('mouseleave blur', taskStatus);
                     taskStatus();

                     $('.tasks-content_container').on('mouseenter focus', changeStatus);
                     $('.tasks-content_container').on('mouseleave blur', changeStatus);
                     changeStatus();

                     $('.tasks-content_container').on('mouseenter focus', check_file_path_tooltip);
                     $('.tasks-content_container').on('mouseleave blur', check_file_path_tooltip);
                     check_file_path_tooltip();

               }, 10);

            },
         });
 
      }
    
   });

  }
  submitNewTask();
  

  function loading(){

      let loading = document.querySelector('.loading');
      $(loading).addClass('d-none');

  }
//   $(window).on('load', loading);

  $('.modal').on('hidden.bs.modal', function () {
   location.reload();
  })

});


