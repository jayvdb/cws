<?php 
include("form/navigasi.php") ;
if(isset($_GET['op'])){
	if(isset($_GET['file_no'])){
		$qry = mysql_query("SELECT * FROM `person` WHERE `file_no`='".$_GET['file_no']."'") or die(mysql_error());
		$data = mysql_fetch_array($qry);
		
		$arrival = $data['arrival'];
		$split=explode(",",$arrival);
		$disable = "disabled";
		$button = '<button type="submit" id="person_update" class="btn btn-primary"><i class="fa fa-refresh"></i> Update</button>';
		
		$edit = 1;
	}
}
else{
	$button = '<button type="submit" id="person_save" class="btn btn-success"><i class="fa fa-save"></i> Save</button>';
	$edit = 0;
}
?>

<script>
(function($) {
	$(document).ready(function(){

		var file_no = $("#file_no").val();
		var country2 = $("#country2").val();
		var MA = $("#MA").val();
		
		$("#coo").load("form/general-action.php","op=getcountry&country="+country2);
		$("#marital").load("form/general-action.php","op=getmarital&status="+MA);
		$("#family-relation").load("form/general-action.php","op=getrelation");
		$("#file_no").change(function(){file_no = $(this).val();$("#family").load("form/personal-family-data.php?file_no="+file_no);});		
		if(file_no != ""){$("#family").load("form/personal-family-data.php?file_no="+file_no);}
		
		//save person
		$("#person_save").click(function(){
			var file_no = $("#file_no").val(), name = $("#name").val(), coo = $("#coo").val(), dob = $("#dob").val(), sex = $('input:radio[name=sex]:checked').val(), marital = $("#marital").val(), address = $("#address").val(), phone = $("#phone").val(), photo = $("#photo").val(), status = $("#status").val(), date_arrival = $("#date_arrival").val(),arrival = $("#arrival").val(), education = $("#education").val(), skill = $("#skill").val(), mot = $("#mot").val(), known_language = $("#known_language").val(), previous_occupation = $("#previous_occupation").val(), volunteer = $("#volunteer").val(), date_recognition = $("#date_recognition").val(), status_active = $("#status_active").val();
			
			var datanya = "&file_no="+file_no+"&name="+name+"&coo="+coo+"&dob="+dob+"&sex="+sex+"&marital="+marital+"&address="+address+"&phone="+phone+"&status="+status+"&arrival="+arrival+"&date_arrival="+date_arrival+"&education="+education+"&skill="+skill+"&mot="+mot+"&known_language="+known_language+"&previous_occupation="+previous_occupation+"&volunteer="+volunteer+"&date_recognition="+date_recognition+"&status_active="+status_active;
			
			$.ajax({url:"form/personal-action.php",data:"op=saveperson"+datanya,cache:false,success: function(msg){
					if(msg=="success"){
						alert("berhasil");
						$("#collapseOne").removeClass("in");
						$("#collapseTwo").addClass("in");
						if(file_no !=""){
							$("#file_no").attr("disabled", true);
						}
						}else{alert("gagal");}}
			});
			
		});
		
		//update person
		$("#person_update").click(function(){
			var file_no = $("#file_no").val(), name = $("#name").val(), coo = $("#coo").val(), dob = $("#dob").val(), sex = $('input:radio[name=sex]:checked').val(), marital = $("#marital").val(), address = $("#address").val(), phone = $("#phone").val(), photo = $("#photo").val(), status = $("#status").val(), date_arrival = $("#date_arrival").val(),arrival = $("#arrival").val(), education = $("#education").val(), skill = $("#skill").val(), mot = $("#mot").val(), known_language = $("#known_language").val(), previous_occupation = $("#previous_occupation").val(), volunteer = $("#volunteer").val(), date_recognition = $("#date_recognition").val(), status_active = $("#status_active").val();
			
			var datanya = "&file_no="+file_no+"&name="+name+"&coo="+coo+"&dob="+dob+"&sex="+sex+"&marital="+marital+"&address="+address+"&phone="+phone+"&status="+status+"&arrival="+arrival+"&date_arrival="+date_arrival+"&education="+education+"&skill="+skill+"&mot="+mot+"&known_language="+known_language+"&previous_occupation="+previous_occupation+"&volunteer="+volunteer+"&date_recognition="+date_recognition+"&status_active="+status_active;
			
			$.ajax({url:"form/personal-action.php",data:"op=updateperson"+datanya,cache:false,success: function(msg){
					if(msg=="success"){
						alert("berhasil update");
						location.reload();
						$("#collapseOne").removeClass("in");
						$("#collapseTwo").addClass("in");
					}else{alert("gagal");}}});
		});
		
		//add family
		$("#add-family").click(function(){
			var name = $("#family-name").val(),age = $("#family-age").val(),sex = $('input:radio[name=family-sex]:checked').val(),location = $("#family-location").val(),relation = $("#family-relation").val(),remarks = $("#family-remarks").val(),contact = $("#family-contact").val(),file_no = $("#file_no").val();
			var datanya = "&file_no="+file_no+"&value="+name+";"+age+";"+sex+";"+relation+";"+location+";"+remarks+";"+contact;
			
			$.ajax({url: "form/personal-action.php",data: "op=addfamily"+datanya,cache: false,
				success: function(msg){if(msg=="success"){alert("berhasil");}else{alert("gagal");}
					$("#family").load("form/personal-family-data.php?file_no="+file_no);
					$(".family .form-control").val("");
					$(".family select").val("0");
				}
			});
		});
	});
}) (jQuery);
</script>
<div id="page-wrapper">
<div class="row">
	<div class="col-lg-12">
	<div class="col-lg-10"><h3 class="page-header">Personal Information</h3></div>
	<div class="col-lg-2" ><div class="photo"><img src=""></div><!-- buat photo --></div>
		<div class="col-lg-3">
			<div class="form-group">
				<label>File No:</label>
				<input class="form-control" name="file-no" id="file_no" <?php if($edit==1){echo 'value="'.$data['file_no'].'"'; echo $disable;}?>>
			</div>
		</div>	
	</div>
<div class="col-lg-12">
	<div class="panel-group" id="accordion">
		<!-- A panel -->
		<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Reported Personal Information</a>
			</h4>
			</div>
		<div id="collapseOne" class="panel-collapse collapse in">
		<div class="panel-body">
		<!-- biodata -->
	<!-- form-biodata -->
		<div class="col-lg-6">
		<div class="table-responsive">
			<table class="table table-bordered table-hover" >
				<tbody>
					<tr>
						<td width="180px"><label>Name: *</label></td>
						<td>
							<input class="form-control" name="name" id="name" required value="<?php if($edit==1){ echo $data['name'];}?>"></td>
						<!-- --->
					</tr>
					<tr>
						<td ><label>Country of Origin: *</label></td>
						<td><input type="hidden" id="country2" value="<?php if($edit==1){ echo $data['coo'];}?>">
							<select class="form-control" name="country-origin" id="coo" placeholder="Country of Origin" required></select></td>
					</tr>
					<tr>
						<td ><label>Date of Birth: *</label></td>
						<td>
							<div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
								<input type="text" class="form-control" name="birth" id="dob" onchange="CalAge(dob,age);" value="<?php if($edit==1){echo $data['dob'];}?>" required><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
							<label>Age</label> <input class="form-control" name="age" placeholder="Age" id="age">		
						</td>
					</tr>
					<tr>
						<td ><label>Sex: *</label></td>
						<td>
							<div class="form-group">
								<label class="radio-inline"><input type="radio" name="sex"  value="M" <?php if($edit==1){if($data['sex']=="M")echo "checked";} ?> >Male</label>
								<label class="radio-inline"><input type="radio" name="sex"  value="F" <?php if($edit==1){if($data['sex']=="F")echo "checked";}?>>Female</label>
							</div>
						</td>
					</tr>
					<tr>
						<td ><label>Marital status: *</label></td>
						<td><input type="hidden" id="MA" value="<?php echo $data['marital'];?>" >
							<select class="form-control" name="marital-status" id="marital" ></select></td>
					</tr>
					<tr>
						
						<td ><label>Address (in detail): *</label></td>
						<td><textarea class="form-control" name="address" id="address" rows="4" ><?php if($edit==1){echo $data['address'];}?></textarea></td>
					</tr>
					<tr>
						
						<td ><label>Phone No: *</label></td>
						<td><input class="form-control" name="phone" id="phone" value="<?php if($edit==1){echo $data['phone'];}?>" required></td>
					</tr>
					<tr>
						<td ><label>Photo: </label></td>
						<td><input  type="file" name="photo" id="photo"></td>
					</tr>
				</tbody>
			</table>
		</div>
		</div>
		<div class="col-lg-6">
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<tbody>
					<tr>
						<td width="180px"><label>Status:</label></td>
						<td><select class="form-control" name="status" id="status">
							<option value="0">-- select --</option>
							<option <?php if($edit==1){if($data['status']=="Refugee")echo"selected";}?>>Refugee</option>
							<option <?php if($edit==1){if($data['status']=="Asylum Seeker")echo"selected";}?>>Asylum Seeker</option>
						</select></td>
					</tr>
					<tr>					
						<td ><label>Date & port arrival: *</label></td>
						<td><div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
								<input type="text" class="form-control" name="date_arrival" id="date_arrival"  value="<?php if($edit==1){echo $split[1];}?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
							<input class="form-control" name="arrival" id="arrival" placeholder="Port Arrival" value="<?php if($edit==1){echo $split[0];}?>"></td>
					</tr>
					
					<tr>
						
						<td ><label>Education:</label></td>
						<td><input class="form-control" name="education" id="education" value="<?php if($edit==1){ echo $data['education'];}?>"></td>
					</tr>
					<tr>
						
						<td ><label>Skills:</label></td>
						<td><textarea class="form-control" name="skill" id="skill" ><?php if($edit==1){echo $data['skill'];}?></textarea></td>
					</tr>
					<tr>
						
						<td ><label>Mother of Tongue:</label></td>
						<td><input class="form-control" name="mother-tongue" id="mot" value="<?php if($edit==1){ echo $data['mot'];}?>"></td>
					</tr>
					<tr>
						
						<td ><label>Knowledge of other languages:</label></td>
						<td><input class="form-control" name="known-language" id="known_language" value="<?php if($edit==1){echo $data['known_language'];}?>"></td>
					</tr>
					<tr>
						
						<td ><label>Previous occupation:</label></td>
						<td><input class="form-control" name="previous-occupation" id="previous_occupation" value="<?php if($edit==1){echo $data['previous_occupation'];}?>"></td>
					</tr>
					<tr>
						
						<td ><label>Willingness to volunteer:</label></td>
						<td><input class="form-control" name="volunteer" id="volunteer" value="<?php if($edit==1){echo $data['volunteer'];}?>"></td>
					</tr>
					<tr>
						
						<td ><label>Date of recognition:</label></td>
						<td>
							<div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
								<input type="text" class="form-control" name="birth" id="date_recognition" value="<?php if($edit==1){ echo $data['date_recognition'];}?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</td>
					</tr>
					<tr>
						<td ><label>Active?: </label></td>
						<td><select class="form-control" name="active" id="status_active" >
							<option value="1" <?php if($edit==1){if($data['active']=="1")echo"selected";}?>>Active</option>
							<option value="2" <?php if($edit==1){if($data['active']=="2")echo"selected";}?>>Terminated</option>
							<option value="3" <?php if($edit==1){if($data['active']=="3")echo"selected";}?>>Deleted</option>
						</select></td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php echo $button;?>
		</div>
		</div>
		</div>
		
		</div>
		<!-- B panel -->
		<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Reported family members</a>
			</h4>
		</div>
		<div id="collapseTwo" class="panel-collapse collapse  ">
		<div class="panel-body">
			<div class="col-lg-6">
			<div class="table-responsive">
				<!-- <form role="form" name="form-family"> -->
					<table class="table table-bordered table-hover family">
						<tbody>
							<tr>
								<td width="10px" align="right"><label>1.</label></td>
								<td width="120px"><label>Name</label></td>
								<td><input class="form-control" id="family-name" placeholder="Name"> </td>
							</tr>
							<tr>
								<td align="right"><label>2.</label></td>
								<td><label>Age</label></td>
								<td><input class="form-control" id="family-age" type="number" placeholder="Age"></td>
							</tr>
							<tr>
								<td align="right"><label>3.</label></td>
								<td><label>Sex</label></td>
								<td>
									<div class="form-group">
									<label class="radio-inline"><input type="radio" name="family-sex" id="family-sex"  value="M" checked>Male</label>
									<label class="radio-inline"><input type="radio" name="family-sex"  id="family-sex" value="F">Female</label>
									</div>
								</td>
							</tr>
							<tr>
								<td align="right"><label>4.</label></td>
								<td><label>Relation</label></td>
								<td><select class="form-control" name="family-relation" id="family-relation"></select>
								</td>
							</tr>
						</tbody>
					</table>
				<!-- </form> -->
			</div><!-- table-responsive -->	
			</div>
			<div class="col-lg-6">
			<div class="table-responsive">
				<table class="table table-bordered table-hover family">
					<tbody>
					<tr>
						<td width="10px" align="right"><label>5.</label></td>
						<td width"120px"><label>Current location</label></td>
						<td><textarea class="form-control" id="family-location" placeholder="Locations"></textarea></td>
					</tr>
					<tr>
						<td align="right"><label>6.</label></td>
						<td><label>Remarks</label></td>
					<td><textarea class="form-control" id="family-remarks" placeholder="Remarks"></textarea></td>
					</tr>
					<tr>
						<td align="right"><label>7.</label></td>
						<td><label>Last Contact family?:</label></td>
						<td><textarea class="form-control" id="family-contact" placeholder="Type here"></textarea></td>
					</tr>
					</tbody>
					<tfoot>
					<tr>
						<td colspan="3"><button  class="btn btn-sm btn-success" id="add-family" title="Add family"><i class="fa fa-plus"></i> Add </button> </td>
					</tr>
					</tfoot>
				</table>
				
			</div>
			
			</div>
			<div class="col-lg-12" id="family"></div>
		</div>
		</div>
		
		</div>
	</div>
</div>
</div><!-- row -->
</div><!-- page-wrapper -->

