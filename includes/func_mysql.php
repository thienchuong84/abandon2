<?php
function getConnection($host,$user,$pass,$db) {
	if(mysqli_connect_error()){
        echo "Failed to connect Database NEW : ".mysqli_connect_error();
    }
	return mysqli_connect($host, $user, $pass, $db);
}

// update Aug 08, 2015 : cách dung vòng lập while thay vì dùng count()
function getArray($conn, $sql) {   
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
        $tmp_array = array();
        //for($row=0; $row<$count; $row++){
            //$row_of_array = mysqli_fetch_row($result);
        //while($row_of_array = mysqli_fetch_assoc($result)){
        /*nếu dùng hàm mysqli_fetch_assoc() như trên mãng trả về sẽ là : array(1) { [0]=> array(4) { ["idUser"]=> string(1) "1" ["user"]=> string(5) "admin" ["pass"]=> string(5) "admin" ["fullname"]=> string(13) "Administrator" } }
        như vậy bên trang login.php ta có thể gán biến bằng name trong table. Ví dụ: $user= getArray() ; $_SESSION['id'] = $user[0]["idUser"] thay vì $_SESSION['id'] = $user[0][0]  */
        while($row_of_array = mysqli_fetch_row($result)){
            $tmp_array[] = $row_of_array;
        }
        return $tmp_array;
    } else {
        return false;
    }
    mysqli_free_result($result);
    mysqli_close($conn);
}

/* Update Aug 08, 2015 : cách dùng hàm count() và for() để query dòng lấy kết quả
 Cách này được thay bằng hàm while : while($row_of_array = mysqli_fetch_assoc($result)) { $tmp_array = $row_of_array; }*/
function getArray_count($conn, $sql) {   
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
    //if($count > 0){   // khi dùng điều kiện này để xét, luôn trả về bằng 1 nên kết quả sai, phải dung mysqli_num_rows mới chính xác
        $count = count($result);
        $tmp_array = array();
        for($row=0; $row<$count; $row++){
            $row_of_array = mysqli_fetch_row($result);
            //for($col=0; $col<5; $col++){
            foreach ($row_of_array as $value) {
                    $tmp_array[$row][] = $value;
            }
        }
        return $tmp_array;
    } else {
        return false;
    }
    mysqli_free_result($result);
    mysqli_close($conn);
}

// hàm getArray dùng count() đếm hàng của $result, bỏ vào for và dùng foreach để lấy giá trị. Test hàm dưới xem 2 foreach() có lấy được như trên ko?
/* update Aug 08, 2015: với hàm foreach lồng foreach nó tạo một mãng đứng, ví dụ khi query user admin được 1 hàng 5 cột, bình thường ta dùng [0][0] [0][1] để lấy giá trị 1 và 2 của hàng đầu tiên
nhưng với cái này nó sẽ xếp theo kiểu [0][0] [1][0] để lấy giá trị, tức nếu ta query được 2 hàng và lấy như cách dưới, muốn lấy id và user của user 2 ta phải dung [5][0] [6][0] */
function getArray_foreach($conn, $sql) {   
    $result = mysqli_query($conn, $sql);
    $tmp_array = array();
        if(mysqli_num_rows($result)>0){
        //foreach ($result as $value) {
        foreach ($result as $key) {    
            foreach ($key as $value) {
                    $tmp_array[][] = $value;
            }
        }
        return $tmp_array;
    } else {
        return false;
    } 
    mysqli_free_result($result);
    mysqli_close($conn);
}




/* su dung ben html

    $conn = Getconnection(db_host, db_user, db_pass, db3);

    $sql = "SELECT      navtab_menu.* 
    FROM        users
    INNER JOIN  roles_navtab    ON users.idRole = roles_navtab.idRole
    INNER JOIN  navtab_menu ON roles_navtab.idMenu = navtab_menu.idMenu
    WHERE       idUser='{$_SESSION["id"]}'";

	$array = have_navbar_menu($sql, $conn);

    if($menu[0][0]!="") { 
    $count = count($menu);
    for($row=0; $row<$count; $row++) {
		echo $menu[$row][0]; echo $menu[$row][1];
    }

*/




?>