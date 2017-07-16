<?php 
$db = new mysqli('localhost','root','','publish_subscription');
$query = "SELECT * FROM tbl_child_cat";
$result = mysqli_query($db, $query);
while ($row = mysqli_fetch_array($result)) {
	$sub_data["CatID"] = $row["CatID"];
	$sub_data["Name"]  = $row["Name"];
	$sub_data["text"]  = $row["Name"];
	$sub_data["ParentID"]  = $row["ParentID"];
    $data[] = $sub_data;
}

foreach ($data as $key => &$value) 
{
	$output[$value["CatID"]] = &$value;
}

foreach ($data as $key => &$value)
{
	if ($value["ParentID"] && isset($output[$value["ParentID"]]))
	{
			$output[$value["ParentID"]]["nodes"][] = &$value;
	}	
}

foreach ($data as $key => &$value)
{
	if ($value["ParentID"] && isset($output[$value["ParentID"]]))
	{
			unset($data[$key]);
	}	
}
echo json_encode($data);
echo '<pre>';
print_r($data);
echo '<pre>';
?>   