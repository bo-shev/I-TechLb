<?
include 'conect.php';


    function getInfoCompTask($dbh, $date, $id_project) 
    {       
        $sql = "SELECT worker.id_worker, worker.fid_department, work.date,
        work.time_start,work.time_end,work.description, 
        projects.id_projects,projects.name,projects.manager
        FROM worker JOIN work ON worker.id_worker = work.fid_worker 
        JOIN projects ON work.fid_projects=projects.id_projects
        WHERE work.description = 'completed' AND work.date = '$date' 
        AND projects.name = '$id_project'";

$output = "<table border='1' >";

$output .="  <tr> <th>ProjectWorker</th>  <th>Department</th>  <th>Status</th> <th>IdProject</th>   <th>ProjectName</th> <th>ProjectsManager</th></th>";


        foreach ($dbh->query($sql) as $row) 
        {              
            $output .= "<tr><th>" 
            . $row['id_worker'] . "</tb>  <th>" 
             . $row['fid_department'] . "</th><th>" 
              . $row['description'] . "</th> <th>" 
               . $row['id_projects'] . "</th> <th>" 
                . $row['name'] . "</th>   <th>" 
                 . $row['manager'] . "</th></tr>";
                 
        }      

       

        $output .= "</table>";
        echo $output;
    }

    function getTotalTime($dbh, $id_project)
    {
        
       $sql = "SELECT work.time_end , work.time_start FROM work JOIN projects ON projects.id_projects=work.fid_projects WHERE projects.name = '$id_project'";

       
       foreach ($dbh->query($sql) as $row) 
        {$seconds = strtotime($row[time_end]) - strtotime($row[time_start]) ;}

        //echo "$seconds"."<br>";
	$res = array();
	
	$res['days'] = floor($seconds / 86400);
	$seconds = $seconds % 86400;
    echo $res['days']."days ";
	
	$res['hours'] = floor($seconds / 3600);
	$seconds = $seconds % 3600;
    echo $res['hours']."hours ";
 
	$res['minutes'] = floor($seconds / 60);
	$res['seconds'] = $seconds % 60;
    echo $res['minutes']."minutes ";
    echo $res['seconds']."seconds ";
    
    }

    function getAmountOfEmployees($dbh, $chief)
    {
        
        $stmt = $dbh->prepare ("SELECT COUNT(*) as 'amount' FROM worker JOIN department
        on department.id_department = worker.fid_department
        WHERE department.chief = :name");
        //$smth->bindParam(":name",$chief);
                
        echo "<bs>amount of employees: ";

        if ($stmt->execute(array(':name' => $chief))) //$_GET['amount']
        {
            
            while ($row = $stmt->fetch()) 
            {
              print_r($row[0]);
            }
        }
      
        
    }
         
 if(array_key_exists('button1',$_POST))
 {
    getInfoCompTask($dbh, $_POST['specifieddate'], $_POST['project']); 
 }
 else if (array_key_exists('button2',$_POST))
 {
    getTotalTime($dbh, $_POST['project']); 
 }
 else if (array_key_exists('button3',$_POST))
 {
     
    getAmountOfEmployees($dbh, $_POST['num']); 
 }
 
?>