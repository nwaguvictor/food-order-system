$(document).ready(function(){
// Function to show all methods
    showAllFoodCategory();

    function showAllFoodCategory(){
        $.ajax({
            url:'process/food_cat_process.php',
            type:'POST',
            data: {action:'view_food_cat'},
            success:function(rep){
                $("#cat-table").html(rep);
            }
            
        });
    }

// Show Cart modal form
    $(document).on('click', '#cat-modal-btn', function(e){
        e.preventDefault();
        $("#add-cat-form")[0].reset();
        $('#cat-modal').modal('show');
    });


    // Adding a new category
    $("#add_cat_btn").click(function(e){
        e.preventDefault();
        let catName = $("#new_cat_name").val();
        if (catName == '') {
            alert("Enter Category Name");
        }
        else{
            $.ajax({
                url: 'process/food_cat_process.php',
                type: 'POST',
                data: {cat_name:catName},
                success:function(resp){
                    if (resp == 'ok') {
                        Swal.fire({
                            position: 'top-right',
                            title: 'Done',
                            text:'Category Added Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $("#add-cat-form")[0].reset();
                        $("#cat-modal").modal('hide');
                        showAllFoodCategory();
                    }
                    else {
                        alert("Category Already Exist.");
                    }
                }
            })
        }
        
    });

    // DELETING FOOD CATEGORY

    $(document).on('click', '.delBtn', function(e){
        e.preventDefault();
        let catId = $(this).attr('id');
        Swal.fire({
            icon:'warning',
            title:'Delete',
            text:'Delete Food Category?',
            showCancelButton: 'true',
            cancelButtonColor:'red',
            confirmButtonColor: 'green'
        }).then((result) => {
            if (result.value){
                $.ajax({
                    url:'process/food_cat_process.php',
                    type:'POST',
                    data:{cat_id:catId},
                    success:function(resp){
                        if (resp == 'ok') {
                            Swal.fire({
                                icon:'success',
                                title:'Done',
                                text:'Food Category Deleted Successfully',
                                showConfirmButton: false,
                                timer: 1000
                            });
                            showAllFoodCategory();
                        }
                    }
                })
            }
        })
    });

    // Geting cat details by it's id and setting cat_title to form input value
    $(document).on('click', '.editBtn', function(e){
        e.preventDefault();
        let editCatId = $(this).attr('id');
        $.ajax({
            url:'process/food_cat_process.php',
            type: 'POST',
            data:{the_cat_id:editCatId},
            success:function(resp){
                data = JSON.parse(resp);
                $("#edit_cat_name").val(data.cat_title);
                $("#cat_id").val(data.cat_id);
                $("#edit-cat-modal").modal('show');
            }
        });

       
    });
    
     // Updating the category
     $("#update_cat_btn").click(function(e){
        e.preventDefault();
        newCatName = $("#edit_cat_name").val();
        editCatId = $("#cat_id").val();
        if (newCatName == ''){
            alert("Enter Category Name");
        }
        else {
            Swal.fire({
                icon:'question',
                title:'Update Category',
                text: 'This Will Update the Food Category',
                showCancelButton: true,
                cancelButtonColor: 'red',
                confirmButtonColor: 'green'
            }).then((result)=> {
                $.ajax({
                    url:'process/food_cat_process.php',
                    type:'POST',
                    data:{
                        editCatId:editCatId,
                        newCatName:newCatName
                    },
                    success:function(resp){
                        if (resp == 'ok') {
                            Swal.fire({
                                icon:'success',
                                title:'Updated',
                                text:'Category Updated',
                                showConfirmButton: false,
                                timer: 1000
                            })
                            $("#edit-cat-modal").modal('hide');
                            showAllFoodCategory();
                        }else {
                            Swal.fire({
                                icon:'error',
                                title:'Error',
                                html: '<p>'+ resp +'</p>',
                            })
                        }
                    }
                })
            })
        }
    })


})