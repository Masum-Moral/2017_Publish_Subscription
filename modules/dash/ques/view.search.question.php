<?php

include_once 'blade/view.question.blade.php';
include_once '/../../common/class.common.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Question Searching Operations</title>





<style type="text/css">
	
	#form{
    width: 96%;
    border: 15px solid ;
    padding: 25px;
    margin: 25px;
    background:url("1.jpg") no-repeat;opacity:10%;
}

#show{
    width:auto;
    height: auto;
    border: 20px  solid blue;
    background-color: #80bfff;
   
    
   }


</style>








		
	</head>

<body bgcolor="#999999">
<center>
	<div id="header">
		
	</div>
	
	<div id="form" >
		<form method="post">
		<button type="submit" name="upload" button class="w3-button w3-blue w3-round-xlarge">Upload Question</button>
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
				
						<option value="<?php echo $Course->getID();?>" > <?php echo $Course->getTitle(); ?> 
						</option>
					<?php
					
					}
				?>	
				</select>
				<input type="checkbox" name="title_check">
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
					
						<option value="<?php echo $Course->getID();?>" > <?php echo $Course->getCourse(); ?> 
						</option>
					
				<?php

				}
				?>	
				</select>
				<input type="checkbox" name="course_check">
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
						<option value="<?php echo $Term->getID();?>" > <?php echo $Term->getName(); ?> 
						</option>
					
				<?php
					
				}
				
				?>	
				</select>
				<input type="checkbox" name="term_check">
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
				<input type="checkbox" name="session_check">
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
				<input type="checkbox" name="teacher_check">
				</td>

					<td>
					<select name="type" style="width:170px">
					<option selected disabled>Select Question Type</option>
					<option value="CT">CT</option>
					<option value="Term-Final">Term-Final</option>	
					</select>
					<input type="checkbox" name="type_check">
					</td>

				</tr>

				<tr>
				
				<td>
					<select name="tag" style="width:170px">
					<option disabled selected>Select Tag</option>
					<?php
						$Result = $_QuestionBAO->searchQuestions($query);
						if($Result->getIsSuccess())
								$QuestionList = $Result->getResultObject();
						for($i = 0; $i < sizeof($QuestionList); $i++) {
								$Question = $QuestionList[$i];
					?>
					<option value="<?php echo $Question->getTag(); ?>"><?php echo $Question->getTag(); ?></option>
					<?php
				}
					?>
					</select>
					<input type="checkbox" name="tag_check">
				</td>
				<td><input style="width:170px" type="date" name="question_date" placeholder="Date" value="<?php 
					if(isset($_GET['edit'])) echo $getROW->getQuestionDate(); ?>">
				<input type="checkbox" name="date_check">
				</td>

				</tr>


				<tr>
					<td>
						<center><button type="submit" name="search_upload" button class="w3-button w3-black w3-round-xlarge">search</button></center>
					</td> 

				
				
				</tr>
			</table>
		</form>


<br>
   <div id="show">  
	<table width="100%" border="1" cellpadding="15" align="center">
	<?php

	$query =" ";
	if (isset($_POST['search_upload'])){
		$flag = 0;
	if (isset($_POST['title_check']))
	{
		$flag = 1;
		$title_string = $_POST['title'];
		$title_string = "\"$title_string\"";
		$query = " WHERE "." Title = ".$query.$title_string." ";
	}
	if (isset($_POST['course_check']))
	{
		$course_string = $_POST['course'];
		$course_string = "\"$course_string\"";
		if ($flag == 1)
			$query = $query." and CourseID= ".$course_string." ";
		else
			$query = " WHERE "."CourseID =".$query.$course_string." ";

		$flag =1;
	}
	if (isset($_POST['term_check']))
	{
		$term_string= $_POST['term'];
		$term_string = "\"$term_string\"";
		if ($flag == 1)
			$query = $query." and TermID = ".$term_string." ";
		else
			$query = " WHERE "."TermID =".$query.$term_string." ";
		$flag = 1;
	}
	if (isset($_POST['session_check']))
	{
		$session_string= $_POST['session'];
		$session_string = "\"$session_string\"";
		if ($flag == 1)
			$query = $query." and SessionID = ".$session_string." ";
		else
			$query = " WHERE "."SessionID =".$query.$session_string." ";
		$flag = 1;
	}
	if (isset($_POST['teacher_check']))
	{
		$teacher_string= $_POST['teacher'];
		$teacher_string = "\"$teacher_string\"";
		if ($flag == 1)
			$query = $query." and TeacherID = ".$teacher_string." ";
		else
			$query = " WHERE "."TeacherID =".$query.$teacher_string." ";
		$flag = 1;
	}
	if (isset($_POST['type_check']))
	{
		$type_string= $_POST['type'];
		$type_string = "\"$type_string\"";
		if ($flag == 1)
			$query = $query." and Type = ".$type_string." ";
		else
			$query = " WHERE "."Type =".$query.$type_string." ";
		$flag = 1;
	}
	if (isset($_POST['tag_check']))
	{
		$tag_string= $_POST['tag'];
		$tag_string = "\"$tag_string\"";
		if ($flag == 1)
			$query = $query." and Tag = ".$tag_string." ";
		else
			$query = " WHERE "."Tag =".$query.$tag_string." ";
		$flag = 1;
	}
	if (isset($_POST['date_check']))
	{
		echo $_POST['question_date'];
		$date_string= $_POST['question_date'];
		$date_string = "\"$date_string\"";
		if ($flag == 1)
			$query = $query." and QuestionDate = ".$date_string." ";
		else
			$query = " WHERE "."QuestionDate =".$query.$date_string." ";
		$flag = 1;
	}
	//echo "SELECT * FROM tbl_question_archive"." WHERE ".$query;
	$Result = $_QuestionBAO->searchQuestions($query);

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

		</tr>
		<?php
		for($i = 0; $i < sizeof($QuestionList); $i++) {
			$Question = $QuestionList[$i];
			//echo $Question->getLink();
			?>
		    <tr>
			    
			    <td><?php echo $_QuestionBAO->getTitleFromID( $Question->getTitle());?></td>
			    <td><?php echo $_QuestionBAO->getCourseFromID($Question->getCourse());?></td>
			    <td><?php echo $_QuestionBAO->getTermFromID($Question->getTerm()); ?></td>
			    <td><?php echo $_QuestionBAO->getSessionFromID($Question->getSession()); ?></td>
			    <td><?php echo $_QuestionBAO->getTeacherFromID($Question->getTeacher()); ?></td>
			    <td><?php echo $Question->getType(); ?></td>
			    <td><?php echo $Question->getTag(); ?></td>
			    <td><?php echo $Question->getQuestionDate(); ?></td>
			    <td><a href="<?php echo $Question->getLink(); ?>" target = "_blank">Download</a></td>
			    
		    </tr>
	    <?php

		}

	}
	else{

		echo $Result->getResultObject(); //giving failure message
	}
}
	?>
	</table>
	</div>
	
	</div>
</center>
</body>
</html>