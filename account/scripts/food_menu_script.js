$(function(){
  // Showing the file in the custom input file
  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });

  // Showing the add Food Modal
  $("#food_modal_btn").click(function(e){
    e.preventDefault();
    $("#add_food_form")[0].reset();
    $("#food_menu_modal").modal('show');
  });

  // Showing all food in the food menu
  showAllFood();
  function showAllFood() {
    $.ajax({
      url: 'process/food_menu_process.php',
      type: 'POST',
      data:{action:'view_all_food'},
      success:function(resp) {
        $('.food_menu').html(resp);
        $("#food_menu_table").DataTable();
      }
    })
  }


  // Adding a food to the food menu
  $("#add_food_form").submit(function(e){
    e.preventDefault();
    Swal.fire({
      icon: 'warning',
      title: 'Add Food',
      text: 'Do you want to add this food?',
      showCancelButton: true,
      confirmButtonColor: 'green',
      cancelButtonColor: 'red'
    }).then((result)=>{
      if(result.value){
        $.ajax({
          url: 'process/food_menu_process.php',
          type: 'POST',
          data: new FormData(this),
          contentType: false,
          processData: false,
          success:function(resp){
            if(resp == 'ok') {
                Swal.fire({
                    icon: 'success',
                    title: 'Done',
                    text: 'Food Added Successfully',
                    showConfirmButton: false,
                    timer: 1000
                });
                showAllFood();
                $("#food_menu_modal").modal('hide');
            }
            else {
              $(".message").html(resp);
            }
          }
        });
      }
    });
  });


  // Setting food details on the edit form
  $(document).on('click', '.editBtn', function(e){
    e.preventDefault();
    let foodId = $(this).attr("id");
    $("#edit_food_form")[0].reset();
    $.ajax({
      url: 'process/food_menu_process.php',
      type: 'POST',
      data: {food_id:foodId},
      success:function(response) {
        data = JSON.parse(response);
        $("#hiddenId").val(data.food_id);
        $("#food_name").val(data.food_name);
        $("#food_category").val(data.food_cat_id);
        $("#food_status").val(data.food_status);
        $("#food_prize").val(data.food_prize);
        $("#edit_food_modal").modal('show');
      }
    });
  });

  // Updating Food in food Menu
  $("#edit_food_form").submit(function(e){
    e.preventDefault();
    let foodId = $("#hiddenId").val();
    let foodName = $("#food_name").val();
    let foodImage = $("#food_image").val();
    let foodCat = $("#food_category").val();
    let foodStatus = $("#food_status").val();
    let foodPrize = $("#food_prize").val();
    Swal.fire({
      icon: 'warning',
      title: 'Update Food?',
      text: 'This will Update the food Details',
      showCancelButton: true,
      cancelButtonColor: 'red',
      confirmButtonColor: 'green'
    }).then((result)=>{
      if(result.value){
        $.ajax({
          url: 'process/food_menu_process.php',
          type: 'POST',
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          // data:{
          //   id:foodId, 
          //   name:foodName,
          //   image:foodImage,
          //   foodcat:foodCat,
          //   status:foodStatus,
          //   prize:foodPrize,
          //   action:'update'
          // },
          success:function(reply){
            if(reply == 'ok') {
              Swal.fire({
                icon: 'success',
                title: 'Done',
                text: 'Food Updated Successfully',
                showConfirmButton: false,
                timer: 1000
              });
              $("#edit_food_form")[0].reset();
              $("#edit_food_modal").modal('hide');
              showAllFood();
            }
            else{
              $("#message").html(reply);
            }
          }
        })
      }
    })
  })
  

  // Deleting a Food From menu

  $(document).on("click", ".deleteBtn", function(e){
    e.preventDefault();
    let id = $(this).attr("id");
    Swal.fire({
      icon: 'warning',
      title: 'Delete Food?',
      text: 'This Action is not reversible',
      showCancelButton: true,
      cancelButtonColor: 'red',
      confirmButtonColor: 'green'
    }).then((result)=> {
      if(result.value){
        $.ajax({
          url: 'process/food_menu_process.php',
          type: 'POST',
          data: {delId:id},
          success:function(reply) {
            Swal.fire({
              icon: 'success',
              title: 'Done',
              text: 'Food Deleted Successfully',
              showConfirmButton: false,
              timer: 1000
            });
            showAllFood();
          }
        })
      }
    })
  });

});


