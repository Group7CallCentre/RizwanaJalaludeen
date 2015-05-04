<script>
function pagination(page){
 var search = $("input#fieldSearch").val();
 var record = $("select#pageRecord").val(); 
   if (search!==""){
    dataString = 'starting='+page+'&name='+search+'&perpage='+ record+'&random='+Math.random();
  }
 
  else{
    dataString = 'starting='+page+'&perpage='+record+'&random='+Math.random();
  }
  
  $.ajax({
    url:"tablepage.php",
    data: dataString,
    type:"GET",
    success:function(data)
    {
      $('#divPageData').html(data);
    }
  });
}

function loadData(){
    var dataString;
    var search = $("input#fieldSearch").val();
    var record = $("select#pageRecord").val();
	dataString = 'name='+ search + '&perpage=' + record;
    
      $.ajax({
      url: "tablepage.php",
      type: "GET",
      data: dataString,
      success:function(data)
      {
        $('#divPageData').html(data);
      }
    });
  }


  
$('#students tr:even:not(#nav):not(#total)').addClass('even');
$('#students tr:odd:not(#nav):not(#total)').addClass('odd') 
 $("form#form1").submit(function(){
    var vId = $("input#edit_id").val();                  
    var vName = $("input#edit_name").val();                
	var vAddress = $("input#edit_address").val();         
	var vExam = $("input#edit_studied").val();             
	var vExam = $("input#edit_workplacement").val(); 
	var vExam = $("input#edit_paidperhour").val(); 
	//var myRegExp=/^[A-Z]{2}\d{4}\b/;                  
    
	 
	if ((vName=="")||(vAddress == "")||(vExam == "")){
	   alert("Please complete the missing field(s)");
        $("input#edit_name").focus();
        return false;
		}
	/* else if( !myRegExp.test(vExam)){
        alert ('Invalid Format for Exam No.');
        $("input#edit_exam_no").focus();
        return false;
      }  */
	else{
          $.ajax({
          url: "process_data.php",
          type:$(this).attr("method"), 
          data:$(this).serialize(), 
          dataType: 'json', 
          success:function(response){
             if(response.status == 3) // return nilai dari hasil proses
             {
                  alert("Data Successfully Updated");
                  
                   $(".morph-content").hide(2000);				  
                   
				  loadData();
             }
             else if(response.status==1)
             {
                alert("Please complete the missing field(s)");
				$("input#add_name").focus();
             }
			/* else if(response.status==2)
             {
                alert("Invalid Format for Exam No.");
				$("input#add_exam_no").focus();
             }
			 */
			 else
             {
                alert("Data update unsccessful");
             }
          }
        });
        return false;
      }
	 return false;
  });

  
  $("form#form2").submit(function(){
    
	      $.ajax({
          url: "process_data.php",
          type:$(this).attr("method"), 
          data:$(this).serialize(), 
          dataType: 'json', 
          success:function(response){
             if(response.status == 1) // return nilai dari hasil proses
             {
                  alert("Data Successfully Delected");
                  
                   $(".morph-content").hide(2000);				  
                   
				  loadData();
             }
             else
             {
                alert("Data Failed to Delete");
             }
          }
        });
        return false;
      
	
  });  
</script>
<script src="js/modernizr.custom.js"></script>
<script src="js/classie.js"></script>
<script src="js/uiMorphingButton_fixed.js"></script>
<script src="js/buttonMorp.js"></script>


<?php
error_reporting(E_ALL^E_NOTICE);
include('pagination_class.php');
include('connect.php');

if (isset($_GET['name']) and !empty($_GET['name'])){
  $name = $_GET['name'];
  $sql = "select * from students where name like '%$name%'";
}
else{
  $sql = "select * from students order by studentid";
}

if(isset($_GET['starting'])){ //starting page
    $starting=$_GET['starting'];
}else{
    $starting=0;
}
 
$recpage=$_GET['perpage'];

$obj = new pagination_class($sql,$starting,$recpage);		
$result = $obj->result;
?>       
<div id="page_contents">
 		 
  <div id="addDiv">
    <div  class="morph-button morph-button-modal morph-button-modal-2 morph-button-fixed">
	    <button type="button">ADD</button>
			<div class="morph-content">
				<div>
					<div class="content-style-form content-style-form-1">
					  <span class="icon icon-close">Close the dialog</span>
					   <h2>Add Data</h2>
						<form id="form1" method="post" >
							<p><label>Name</label><input type="text" id="add_name" name="add_name" /></p>
							<p><label>Address</label><input type="text" id="add_address" name="add_address" /> </p>
						    <p><label>Studied</label><textarea id="add_studied" name="add_studied" ></textarea></p>
							<p><label>Workplacement</label><textarea id="add_workplacement" name="add_workplacement" ></textarea></p>
							<p><label>Paid Per Hour</label><input type="text" id="add_paidperhour" name="add_paidperhour" /></p>
						    <p><input type="submit" value="Add" /></p>
							<input type="hidden" id="action" name="action" value="add" />
						</form>
					</div>
				</div>
			</div>
	</div>
  </div>
	
	  <div id="student_wrap"> 	
		<table  id="students"  width="100%" >
			<tr><th>Sl No</th><th>Student Name</th><th>Address</th><th>Studied</th><th>Workplacement</th><th>Paid Per Hour</th><th style="padding-left:19px;">Action</th>
			</tr>
				<?php if(mysqli_num_rows($result)!=0){
					$counter = $starting + 1;
					while($data = mysqli_fetch_array($result)) {?>
			<tbody><tr>
				<td><?php echo $data['studentid']; ?></td>
				<td><?php echo $data['name']; ?></td>
                <td><?php echo $data['address']; ?></td>
				<td><?php echo $data['studied']; ?></td>
				<td><?php echo $data['workplacement']; ?></td>
				<td><?php echo $data['paidperhour']; ?></td>
				<td>   
				      <div class="morph-button morph-button-modal morph-button-modal-2 morph-button-fixed">
						<button type="button">Edit</button>
						<div class="morph-content">
							<div>
								<div class="content-style-form content-style-form-1">
									<span class="icon icon-close">Close the dialog</span>
									<h2>Update Data</h2>
									<form id="form1" method="post" >
										<p><label>ID</label><input type="text" id="edit_id" name="edit_id" value="<?php echo $data['studentid']; ?>" readonly /></p>
										<p><label>Name</label><input type="text" id="edit_name" name="edit_name" value="<?php echo $data['name']; ?>" /></p>
										<p><label>Address</label><input type="text" id="edit_address" name="edit_address" value="<?php echo $data['address']; ?>" /></p>
									    <p><label>Studied</label><textarea id="edit_studied" name="edit_studied" ><?php echo $data['studied']; ?></textarea></p>
										
									    <p><label>Workplacement</label><textarea id="edit_workplacement" name="edit_workplacement"><?php echo $data['workplacement']; ?></textarea></p>
										
									    <p><label>Paid Per Hour</label><input type="text" id="edit_paidperhour" name="edit_paidperhour" value="<?php echo $data['paidperhour']; ?>" /></p>
									    <p><input  type="submit" value="Update" /></p>
										<input type="hidden" name="action" value="update" />
									</form>
								</div>
							</div>
						</div>
					  </div>
					  <div class="morph-button morph-button-modal morph-button-modal-2 morph-button-fixed">
						<button type="button">Delete</button>
						<div class="morph-content">
							<div>
								<div class="content-style-form content-style-form-1">
									<span class="icon icon-close">Close the dialog</span>
									<h2>Delete Data</h2>
                                       <p ><h2 style="margin:10px 10px;">Do you really want to delete from "demo" where SL No="<?php echo $data['id']; ?>" </h2></p>
									   <form id="form2" method="post" >
				                        <p><input type="hidden"  name="delete_id" value="<?php echo $data['studentid']; ?>" /></p>
									   <p><input type="submit" value="Delete" /></p>
										<input type="hidden" name="action" value="delete" />
									</form>
								</div>
							</div>
						</div>
					  </div>
			    </td> 
					 
					 
			</tr></tbody> <?php } ?>
			
            <tfoot><tr id="nav"><td colspan="5"><div><?php echo $obj->anchors; ?></div></td>
			</tr>
			<tr id="total"><td colspan="5"><?php echo $obj->total; ?></td>
			</tr>
				<?php } else{ ?>
			<tr><td align="center" colspan="5">No Data Found</td>
			</tr></tfoot>
				<?php } ?>
				
		</table>
	  </div>		
	</div>
	
  	
		