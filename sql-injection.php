<?php


//if there is POST data...
if(isset($_POST['id'])){

    $connection = mysqli_connect("localhost", "root", "", "test");

    
    // 1, 2, 3 work fine
    // 0 works, gracefully gives no results.
    // 100 works, gracefully gives no results.
    
    // try entering: 1 or 1=1
    // problem?
    
    
    $id = $_POST['id'];
    
    //if searching by name, use this
    //$id = mysql_real_escape_string($id);

    //is this bad? YES IT IS. Why? 2 reasons.....
    $sql = "SELECT * FROM `test_list` WHERE `ID` = " . $id;

    //what does this SQL query look like?
    //echo $sql . '<br><br>';

    //execute search
    $result = mysqli_query($connection, $sql);

    $data = array();
    //get all data
    while($row = mysqli_fetch_assoc($result)){
        array_push($data, $row);
    }

    echo "Here are the results of your search: <br> <br>";
    
    
    if(sizeof($data) == 0){
        //no results, couldnt find name by id
        echo "<i>Could not find ID # " . $id . "</i>";  
        
    }else{
    
        //we found some data
        //what does it ALL look like?
        //var_dump($data);
        
        //build HTML from the data
        echo '<ul>';

        for($i = 0; $i < sizeof($data); ++$i){

            echo '<li>';
            echo $data[$i]['name'];

            ///Could have access to info they shouldnt

            //echo " ....... ";
            //echo $data[$i]['phone_number'];
            echo '</li>';   

        }

        echo '</ul>';
    }

}
?>


<html>
    <title> SQL injection example</title>
    
    <head></head>
    
    <body>
        <form method="post" action="?">
        
            Search for a name by 
            typing in an ID number: <input type="text" name="id"/>
            <input type="submit" value="Submit"/>
        
        </form>
    
    
    
    </body>
    
</html>