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
       constructor(slide, checkbox, services, powContent) {
           this.slide = slide;
           this.checkbox = checkbox;
           this.services = services;
           this.powContent = powContent;
       }
   
       dynamicSlides() {
   
           let swiperSlide = document.querySelectorAll('.servicesSlide');
           let swiperLast = $(swiperSlide).last();
           let dynamicSlide = `
           <div class='swiper-slide servicesSlide ${this.slide}'>
            <div class='modal-content'>
               <div class='modal-header border-0'><h5></h5>
                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
               <span aria-hidden='true'>&times;</span></button>
               </div>
               <span class='modal-title'>${this.services}</span>
               <div class='pow ${this.powContent}'>
                  <h2>Phases of Work</h2>
               </div>
               
               <div class='swiper-button-next'></div>
               <div class='swiper-button-prev'></div>
            </div>
           </div>`;

         $(this.checkbox).on('change', ()=> {

           if($(this.checkbox).is(':checked')) {

            $(dynamicSlide).insertAfter(swiperLast);
   
            swiperInit()
          
         } else if($(this.checkbox).prop('checked', false)) {
   
            // let rmv = document.getElementsByClassName(this.powContent);
            let elements = document.getElementsByClassName(this.slide);

            $(elements).remove();
            swiperInit()
  
         }
            
         }); 
           
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
                                    <input class="form-check-input dept_checkbox" name="mechanical" type="checkbox" value="">
                                    <label class="form-check-label" for="flexCheckDefault">
                                       Mechanical
                                    </label>
                                 </div>
                              </div>

                              <div class="form-check dept_list">
                                 <div class="checkbox_wrapper">
                                    <input class="form-check-input dept_checkbox" name="electrical" type="checkbox" value="">
                                    <label class="form-check-label" for="flexCheckDefault">
                                       Electrical
                                    </label>
                                 </div>
                              </div>

                              <div class="form-check dept_list">
                                 <div class="checkbox_wrapper">
                                    <input class="form-check-input dept_checkbox" name="plumbing" type="checkbox" value="">
                                    <label class="form-check-label" for="flexCheckDefault">
                                       Plumbing
                                    </label>
                                 </div>
                              </div>

                              <div class="form-check dept_list">
                                 <div class="checkbox_wrapper">
                                    <input class="form-check-input dept_checkbox" name="firepro" type="checkbox" value="">
                                    <label class="form-check-label" for="flexCheckDefault">
                                       Fire Protection
                                    </label>
                                 </div>
                              </div>

                              <div class="form-check dept_list">
                                 <div class="checkbox_wrapper">
                                    <input class="form-check-input dept_checkbox" name="firepro" type="checkbox" value="">
                                    <label class="form-check-label" for="flexCheckDefault">
                                       Structural
                                    </label>
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
                        <input class="form-check-input pow_checkbox conceptual" name="conceptual" type="checkbox" value="">
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
                                    <input class="form-check-input pow_checkbox schematic" name="schematic" type="checkbox" value="">
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
                                    <input class="form-check-input pow_checkbox designDevelopement" name="design development" type="checkbox" value="">
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
                                    <input class="form-check-input pow_checkbox constructionDrawings" name="construction drawings" type="checkbox" value="">
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
                                    <input class="form-check-input pow_checkbox siteSupervision" name="site supervision" type="checkbox" value="">
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

   let engi = new SelectServices('engi', '#engineering', 'Engineering', 'engi-pow_wrapper');
   $('#engineering').on('change', engi.engrDepartment());

   let intDesign = new SelectServices('interiorDesign', '#interiorDesign', 'Interior Design', 'interiorDesign-pow_wrapper');
   $('#interiorDesign').on('change', intDesign.dynamic_phaseofwork(), intDesign.conceptual(), intDesign.designDevelopment(), intDesign.constructionDrawings(), intDesign.siteSupervision());

   let masterPlanning = new SelectServices('masterPlanning', '#masterPlanning', 'Master Planning', 'masterPlanning-pow_wrapper');
   $('#masterPlanning').on('change', masterPlanning.dynamic_phaseofwork(), masterPlanning.conceptual(), masterPlanning.schematic());


   //Phase of work checkbox to select managers
   class SelectManagers
   {
       constructor(pow_wrapper, service_checkbox, phaseofwork_checkbox, department) {
           this.pow_wrapper = pow_wrapper;
           this.service_checkbox = service_checkbox;
           this.phaseofwork_checkbox = phaseofwork_checkbox;
           this.department = department;
      }

       pow_checkbox() {

         let phaseofwork_checkbox = document.querySelector(`${this.pow_wrapper} ${this.phaseofwork_checkbox}`);

          $(phaseofwork_checkbox).on('click', ()=> {

            let checkbox_wrapper = $(phaseofwork_checkbox).parent();
            let managerWrapper = $(checkbox_wrapper).children().last();

            if($(phaseofwork_checkbox).is(':checked') ) {
                  
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
      }

   }
   let archConceptual = new SelectManagers('.arch-pow_wrapper', '#architecture', '.conceptual', 'design');
   let archSchematic = new SelectManagers('.arch-pow_wrapper', '#architecture', '.schematic', 'design');
   let archdesignDev = new SelectManagers('.arch-pow_wrapper', '#architecture', '.designDevelopement', 'production');
   let archconsDrawings = new SelectManagers('.arch-pow_wrapper', '#architecture', '.constructionDrawings', 'project management');
   let archsiteVision = new SelectManagers('.arch-pow_wrapper', '#architecture', '.siteSupervision', 'project management');
   
   $(document).on('change', ()=> {

      let conceptual_checkbox = document.querySelector('.arch-pow_wrapper .conceptual');
      $(conceptual_checkbox ).off().on('change', archConceptual.pow_checkbox());

      let schematic_checkbox = document.querySelector('.arch-pow_wrapper .schematic');
      $(schematic_checkbox).off().on('change', archSchematic.pow_checkbox());

      let designDev_checkbox = document.querySelector('.arch-pow_wrapper .designDevelopement');
      $(designDev_checkbox).off().on('change', archdesignDev.pow_checkbox());

      let consDrawings_checkbox = document.querySelector('.arch-pow_wrapper .constructionDrawings');
      $(consDrawings_checkbox).off().on('change', archconsDrawings.pow_checkbox());

      let siteVision_checkbox = document.querySelector('.arch-pow_wrapper .siteSupervision');
      $(siteVision_checkbox).off().on('change', archsiteVision.pow_checkbox());

   });


   //Architecture Services > Phase of work checkbox(Architecture)
   // function architecturePhaseofwork_checkbox(){
   //    let checkbox = document.querySelectorAll('.arch-pow_wrapper .pow_checkbox');

   //    for (let i = 0; i < checkbox.length; i++) {

   //       $(checkbox[i]).off().on('change', ()=> {
   
   //          if($(checkbox[i]).is(':checked')) {

   //             let checkboxWrapper = $(checkbox[i]).parent();
   //             let managersWrapper = `<div class="managers_wrapper">
   //                <span>Managers</span>
   //                <div class="form-check">
   //                   <input class="form-check-input" name="" type="checkbox" value="">
   //                   <label class="form-check-label" for="flexCheckDefault">Sample Manager 1<label>
   //                </div>
   //                <div class="form-check">
   //                   <input class="form-check-input" name="" type="checkbox" value="">
   //                   <label class="form-check-label" for="flexCheckDefault">Sample Manager 2<label>
   //                </div>
   //                <div class="form-check">
   //                   <input class="form-check-input" name="" type="checkbox" value="">
   //                   <label class="form-check-label" for="flexCheckDefault">Sample Manager 3<label>
   //                </div>
   //             </div>`;

   //             $(managersWrapper).appendTo(checkboxWrapper);
              
   //          } else {

   //             let checkboxWrapper = $(checkbox[i]).parent();
   //             $(checkboxWrapper).children().eq(2).remove();

   //          }

   //       });

   //    }
   // }
   // $(document).on('change', architecturePhaseofwork_checkbox);


   // Engineering Department Checkbox
   function engrDepartment_checkbox(){
      let checkbox = document.querySelectorAll('.engi-pow_wrapper .dept_checkbox');

      for (let i = 0; i < checkbox.length; i++) {

         $(checkbox[i]).off().on('change', ()=> {
   
            if($(checkbox[i]).is(':checked')) {

               let checkboxWrapper = $(checkbox[i]).parent();
               let managersWrapper = `<div class="managers_wrapper">
                  <span>Managers</span>
                  <div class="form-check">
                     <input class="form-check-input engrManager" name="" type="checkbox" value="">
                     <label class="form-check-label" for="flexCheckDefault">Sample Manager 1<label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input engrManager" name="" type="checkbox" value="">
                     <label class="form-check-label" for="flexCheckDefault">Sample Manager 2<label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input engrManager" name="" type="checkbox" value="">
                     <label class="form-check-label" for="flexCheckDefault">Sample Manager 3<label>
                  </div>
               </div>`;

               $(managersWrapper).appendTo(checkboxWrapper);
              

            } else {

               let checkboxWrapper = $(checkbox[i]).parent();
               $(checkboxWrapper).children().eq(2).remove();

            }

         });

      }

   }
   $(document).on('change', engrDepartment_checkbox);

   // Engineering Manager Checkbox
   function engrManager_checkbox(){
      let checkbox = document.querySelectorAll('.engi-pow_wrapper .engrManager');

      for (let i = 0; i < checkbox.length; i++) {

         $(checkbox[i]).off().on('change', ()=> {
   
            if($(checkbox[i]).is(':checked')) {

               let checkboxWrapper = $(checkbox[i]).parent();
               let managersWrapper = `<div class="managers_wrapper">
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

               $(managersWrapper).appendTo(checkboxWrapper);
              

            } else {

               let checkboxWrapper = $(checkbox[i]).parent();
               $(checkboxWrapper).children().eq(2).remove();

            }

         });

      }

   }
   $(document).on('change', engrManager_checkbox);

    //Interior Design > Phase of work checkbox(Interior Design)
    function interiorPhaseofwork_checkbox(){
      let checkbox = document.querySelectorAll('.interiorDesign-pow_wrapper .pow_checkbox');

      for (let i = 0; i < checkbox.length; i++) {

         $(checkbox[i]).off().on('change', ()=> {
   
            if($(checkbox[i]).is(':checked')) {

               let checkboxWrapper = $(checkbox[i]).parent();
               let managersWrapper = `<div class="managers_wrapper">
                  <span>Managers</span>
                  <div class="form-check">
                     <input class="form-check-input" name="" type="checkbox" value="">
                     <label class="form-check-label" for="flexCheckDefault">Sample Manager 1<label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" name="" type="checkbox" value="">
                     <label class="form-check-label" for="flexCheckDefault">Sample Manager 2<label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" name="" type="checkbox" value="">
                     <label class="form-check-label" for="flexCheckDefault">Sample Manager 3<label>
                  </div>
               </div>`;

               $(managersWrapper).appendTo(checkboxWrapper);
              

            } else {

               let checkboxWrapper = $(checkbox[i]).parent();
               $(checkboxWrapper).children().eq(2).remove();

            }

         });

      }
   }
   $(document).on('change', interiorPhaseofwork_checkbox);

    //MasterPlan > Phase of work checkbox(masterplan)
    function masterplanPhaseofwork_checkbox(){
      let checkbox = document.querySelectorAll('.masterPlanning-pow_wrapper .pow_checkbox');

      for (let i = 0; i < checkbox.length; i++) {

         $(checkbox[i]).off().on('change', ()=> {
   
            if($(checkbox[i]).is(':checked')) {

               let checkboxWrapper = $(checkbox[i]).parent();
               let managersWrapper = `<div class="managers_wrapper">
                  <span>Managers</span>
                  <div class="form-check">
                     <input class="form-check-input" name="" type="checkbox" value="">
                     <label class="form-check-label" for="flexCheckDefault">Sample Manager 1<label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" name="" type="checkbox" value="">
                     <label class="form-check-label" for="flexCheckDefault">Sample Manager 2<label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" name="" type="checkbox" value="">
                     <label class="form-check-label" for="flexCheckDefault">Sample Manager 3<label>
                  </div>
               </div>`;

               $(managersWrapper).appendTo(checkboxWrapper);
              

            } else {

               let checkboxWrapper = $(checkbox[i]).parent();
               $(checkboxWrapper).children().eq(2).remove();

            }

         });

      }
   }
   $(document).on('change', masterplanPhaseofwork_checkbox);

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

   // $(searchUser).on('change', () => {
   $(searchUser).on('change', () => {
      selectedUser();
   })


   //Class for 

});


