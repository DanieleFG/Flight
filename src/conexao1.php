<?php
namespace Daniele\Dashboard;

$servename = "127.0.0.1";
$username  = "root";
$password = "123456";
$databaseName = "my_database";
$fetchTableName = 'data';
$port = '3307';

$conn = new mysqli($servename, $username, $password, $databaseName, $port);
if($conn){
    echo "Conectado";
    print_r($conn);
}else {
    echo "Erro conexão";
}

// if($fetchTableName) {
//     $sql = "SHOW databases";
//     $results = $conn->query($sql);
//     if($results->num_rows > 0) {
//         while($row = $results->fetch_assoc()){
//             print_r($row);
//         }
//     } else {
//         echo "0 results";
//     }
// }

$conn->close();