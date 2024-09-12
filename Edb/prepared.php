<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kingchobo";

try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    echo "<p>DB 연결에 성공했습니다.</p>";

} catch (PDOException $e) {
    echo $e->getMessage();
}

// *[아래]prepare 구문을 사용하지 않으면 전체가 다 해석을 해서 처리해야하는데, 
// prepare 구문을 사용하게 되면, 한번 해석 구문이 이루어지고 binding 만 하면 매개변수만 전달해주면 되기 때문에 
// 최소화 할 수 있다. 게다가 다른 구문을 injection(주입) 시켜서 db정보를 얻어내거나 날리거나 할 수도 있다.
 try {
$stmt = $conn->prepare("INSERT INTO myguests (firstname, lastname, eamil)
VALUES (:firstname, :lastname, :email)");

$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':lastname', $lastname);
$stmt->bindParam(':email', $email);

$firstname = "John";
$lastname = "Doe";
$email = "john@eample.com";
$stmt->execute();

$firstname = "Julie";
$lastname = "Dooley";
$email = "jolie@eample.com";
$stmt->execute();
 
} catch (PDOException $e) {
    echo $e->getMessage();
 }

 $conn = null;
?>