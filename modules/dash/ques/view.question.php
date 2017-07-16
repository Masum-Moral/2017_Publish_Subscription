<?php

include_once 'blade/view.question.blade.php';
include_once '/../../common/class.common.php';
session_start();

?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<!DOCTYPE>
<html>
 
<style>
	


	
  #header{

   	  width: 80%;
   	  height: 35%;
   	  
    border: 10px solid blue;
    padding: 25px;
    margin: 25px;
  background:url("AZ2.JPG")no-repeat;resize: auto;

   }

    
	#form{
    width: 80%;
    border: 10px solid #660033;
    padding: 25px;
    margin: 25px;
    margin: 25px;
  /*background:url("q.jpg") ;opacity:10%;*/
}


#show{
    width:100%;
   
     border: 10px  solid indigo;
    padding: 5px;
   
 background-color: #80bfff;
   
    
   }





</style>



	<head >
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>QuestionCRUD Operations</title>

		
	</head>

<body bgcolor="#999999" >
<center>
	<div id="header" style="color:#0000ff">
		<label><h1  style=" font-size:45px">Question archive</h1></label>
		
	</div>
	<?php if (isset($_SESSION['globalUser'])){ ?>
	
	<div id="form" >
		<form method="post">
		
			<button type="submit" name="log_out" class="w3-button w3-blue w3-round" >Log Out</button>&nbsp
			<button type="submit" name="search" class="w3-button w3-blue w3-round">Search Question</button>
			<table width="100%" border="1" cellpadding="15">
				<tr>
					
					<?php
						$Result = $_QuestionBAO->getAllCourse();
						if ($Result->getIsSuccess())
							$CourseList = $Result->getResultObject();					
				?>
				<td>
					<select name="title" style="width:170px">
					<option selected disabled>Select Course Title</option>
					<?php
						for ($i = 0; $i<sizeof($CourseList); $i++){
							$Course = $CourseList[$i];
					?>
					<?php
						if (!isset($_GET['edit'])){

					?>
						<option value="<?php echo $Course->getID();?>" > <?php echo $Course->getTitle(); ?> 
						</option>
					<?php
					}
						if (isset($_GET['edit'])){
							
							if ($getROW->getTitle() == $Course->getID() ){
					?>
						<option selected value = "<?php echo $Course->getID();?>" > <?php echo $Course->getTitle();?> 
						</option>
					<?php
					}
						else {

					?>
					<option value="<?php echo $Course->getID();?>" > <?php echo $Course->getTitle(); ?> 
					</option>
				<?php
				}	
				}
				}
				?>	
				</select>
				</td>
					<?php
						$Result = $_QuestionBAO->getAllCourse();
						if ($Result->getIsSuccess())
							$CourseList = $Result->getResultObject();					
				?>
				<td>
					<select name="course" style="width:170px">
					<option selected disabled>Select Course No</option>
					<?php
						for ($i = 0; $i<sizeof($CourseList); $i++){
							$Course = $CourseList[$i];
					?>
					<?php
						if (!isset($_GET['edit'])){

					?>
						<option value="<?php echo $Course->getID();?>" > <?php echo $Course->getCourse(); ?> 
						</option>
					<?php
					}
						if (isset($_GET['edit'])){
							
							if ($getROW->getCourse() == $Course->getID() ){
					?>
						<option selected value = "<?php echo $Course->getID();?>" > <?php echo $Course->getCourse();?> 
						</option>
					<?php
					}
						else {

					?>
					<option value="<?php echo $Course->getID();?>" > <?php echo $Course->getCourse(); ?> 
					</option>
				<?php
				}	
				}
				}
				?>	
				</select>
				</td>

				</tr>

				<tr>
				<?php
						$Result = $_QuestionBAO->getAllTerms();
						if ($Result->getIsSuccess())
							$TermList = $Result->getResultObject();					
				?>
				<td>
					<select name="term" style="width:170px">
					<option selected disabled>Select Term</option>
					<?php
						for ($i = 0; $i<sizeof($TermList); $i++){
							$Term = $TermList[$i];
					?>
					<?php
						if (!isset($_GET['edit'])){

					?>
						<option value="<?php echo $Term->getID();?>" > <?php echo $Term->getName(); ?> 
						</option>
					<?php
					}
						if (isset($_GET['edit'])){
							
							if ($getROW->getTerm() == $Term->getID() ){
					?>
						<option selected value = "<?php echo $Term->getID();?>" > <?php echo $Term->getName();?> 
						</option>
					<?php
					}
						else {

					?>
					<option value="<?php echo $Term->getID();?>" > <?php echo $Term->getName(); ?> 
					</option>
				<?php
				}	
				}
				}
				?>	
				</select>
				</td>	
				<?php
						$Result = $_QuestionBAO->getAllSession();
						if ($Result->getIsSuccess())
							$SessionList = $Result->getResultObject();					
				?>
				<td>
					<select name="session" style="width:170px">
					<option selected disabled>Select Session</option>
					<?php
						for ($i = 0; $i<sizeof($SessionList); $i++){
							$Session = $SessionList[$i];
					?>
					<?php
						if (!isset($_GET['edit'])){

					?>
						<option value="<?php echo $Session->getID();?>" > <?php echo $Session->getName(); ?> 
						</option>
					<?php
					}
						if (isset($_GET['edit'])){
							
							if ($getROW->getSession() == $Session->getID() ){
					?>
						<option selected value = "<?php echo $Session->getID();?>" > <?php echo $Session->getName();?> 
						</option>
					<?php
					}
						else {

					?>
					<option value="<?php echo $Session->getID();?>" > <?php echo $Session->getName(); ?> 
					</option>
				<?php
				}	
				}
				}
				?>	
				</select>
				</td>

				</tr>

				<tr>
				
				<?php
						$Result = $_QuestionBAO->getAllUser();
						if ($Result->getIsSuccess())
							$UserList = $Result->getResultObject();					
				?>
				<td>
					<select name="teacher" style="width:170px">
					<option selected disabled>Select Teacher</option>
					<?php
						for ($i = 0; $i<sizeof($UserList); $i++){
							$User = $UserList[$i];
					?>
					<?php
						if (!isset($_GET['edit'])){

					?>
						<option value="<?php echo $User->getID();?>" > <?php echo $User->getFirstName(); ?> 
						</option>
					<?php
					}
						if (isset($_GET['edit'])){
							
							if ($getROW->getTeacher() == $User->getID() ){
					?>
						<option selected value = "<?php echo $User->getID();?>" > <?php echo $User->getFirstName();?> 
						</option>
					<?php
					}
						else {

					?>
					<option value="<?php echo $User->getID();?>" > <?php echo $User->getFirstName(); ?> 
					</option>
				<?php
				}	
				}
				}
				?>	
				</select>
				</td>
					<td>
					<select name="type" style="width:170px" required>
					<option selected disabled>Select Question Type</option>
					<?php
						if (!isset($_GET['edit'])){
					?>
					<option value="CT">CT</option>
					<option value="Term-Final">Term-Final</option>
					<?php
					}
					if (isset($_GET['edit'])){
						if ($getROW->getType() == 'CT'){	
					?>
					<option selected value="CT">CT</option>
					<option value="Term-Final">Term-Final</option>
					<?php
				}
				else {
					?>
					<option value="CT">CT</option>
					<option selected="Term-Final">Term-Final</option>
					<?php
				}
			}
				?>
					</td>

				</tr>
			
				<input type="hidden" name="creator" value="<?php echo $_SESSION['globalUser']->getID(); ?>">

				<tr>
				
				<td><input type="text" name="tag" placeholder="Tag" value="<?php 
					if(isset($_GET['edit'])) echo $getROW->getTag();  ?>" required></td>
				<td><input type="date" name="question_date" placeholder="Date" value="<?php 
					if(isset($_GET['edit'])) echo $getROW->getQuestionDate(); ?>" required></td>
				</tr>



				<tr>
				<td><input type="text" name="link" placeholder="Question Link" value="<?php 
					if(isset($_GET['edit'])) echo $getROW->getLink(); ?>" required></td>
					<td>
						<?php
						if(isset($_GET['edit']))
						{
							?>
							<button type="submit" name="update"  class="w3-button w3-black w3-round-large ">update</button>
							<?php
						}
						else
						{
							?>
							<button type="submit" name="save" class="w3-button w3-black w3-round-large">save</button>
							<?php
						}
						?>
					</td>

				
				
				</tr>
			</table>
			
		</form>
</select>

</div>

<br>

<div id="show">

	<table width="100%" border="1" cellpadding="15" align="center">
	<?php
	
	
	$Result = $_QuestionBAO->getAllQuestions();

	//if DAO access is successful to load all the Roles then show them one by one
	if($Result->getIsSuccess()){

		$QuestionList = $Result->getResultObject();
	?>
	
		<tr>
			
			<td>Title </td>
			<td>Course </td>
			<td>Term </td>
			<td>Session </td>
			<td>Teacher </td>
			<td>Type</td>
			<td>Tag</td>
			<td>Date</td>
			<td>Creator</td>

		</tr>
		<?php
		for($i = 0; $i < sizeof($QuestionList); $i++) {
			$Question = $QuestionList[$i];
			//echo $Question->getLink();
			?>
		    <tr>
			    
			    <td><a href="<?php echo $Question->getLink(); ?>" target="_blank"> <?php echo $_QuestionBAO->getTitleFromID( $Question->getTitle());?> </a></td>
			    <td><?php echo $_QuestionBAO->getCourseFromID($Question->getCourse());?></td>
			    <td><?php echo $_QuestionBAO->getTermFromID($Question->getTerm()); ?></td>
			    <td><?php echo $_QuestionBAO->getSessionFromID($Question->getSession()); ?></td>
			    <td><?php echo $_QuestionBAO->getTeacherFromID($Question->getTeacher()); ?></td>
			    <td><?php echo $Question->getType(); ?></td>
			    <td><?php echo $Question->getTag(); ?></td>
			    <td><?php echo $Question->getQuestionDate(); ?></td>
			    <td><?php echo $_QuestionBAO->getTeacherFromID($Question->getCreator()); ?></td>
			    <td><a href="?edit=<?php echo $Question->getID(); ?>" onclick="return confirm('sure to edit !'); " >edit</a></td>
			    <td><a href="?del=<?php echo $Question->getID(); ?>" onclick="return confirm('sure to delete !'); " >delete</a></td>
		    </tr>
		    
	    <?php

		}
	}
	else{

		echo $Result->getResultObject(); //giving failure message
	}
	?>
	</table>
	</div>
</center>
<?php 
}
else 
	{
		echo "please <a style='color:#07485c' href='../dash/view.login.php'> log in</a> first<br>";
		echo "or <br><a style='color:#99ff66' href='view.search.question.php'> Search Question  </a><br>";

	}
 ?>
</body>
</html>
