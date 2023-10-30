<?php
require 'Database.php';
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $db = new ConnectionDB();
    $sql = "SELECT * FROM usuarios";
    $stmt = $db->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $db = new ConnectionDB();
    $sql = "INSERT INTO usuarios (Nombre, Correo, Contrasena, Direccion, Token_FB) VALUES (:Nombre, :Correo, :Contrasena, :Direccion, :Token_FB)";
    $stmt = $db->db->prepare($sql);
    $stmt->bindParam(':Nombre', $_POST['Nombre']);
    $stmt->bindParam(':Correo', $_POST['Correo']);
    $stmt->bindParam(':Contrasena', $_POST['Contrasena']);
    $stmt->bindParam(':Direccion', $_POST['Direccion']);
    $stmt->bindParam(':Token_FB', $_POST['Token_FB']);
    $stmt->execute();
    echo json_encode(array('message' => 'Usuario creado'));
}
if ($_SERVER["REQUEST_METHOD"] === "PUT") {
    $db = new ConnectionDB();
    $sql = "UPDATE usuarios SET Nombre = :Nombre, Correo = :Correo, Contrasena = :Contrasena, Direccion = :Direccion, Token_FB = :Token_FB WHERE ID = :ID";
    $stmt = $db->db->prepare($sql);
    $stmt->bindParam(':ID', $_GET['ID']);
    $stmt->bindParam(':Nombre', $_POST['Nombre']);
    $stmt->bindParam(':Correo', $_POST['Correo']);
    $stmt->bindParam(':Contrasena', $_POST['Contrasena']);
    $stmt->bindParam(':Direccion', $_POST['Direccion']);
    $stmt->bindParam(':Token_FB', $_POST['Token_FB']);
    $stmt->execute();
    echo json_encode(array('message' => 'Usuario actualizado'));
}
if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    $db = new ConnectionDB();
    $sql = "DELETE FROM usuarios WHERE ID = :ID";
    $stmt = $db->db->prepare($sql);
    $stmt->bindParam(':ID', $_GET['ID']);
    $stmt->execute();
    echo json_encode(array('message' => 'Usuario eliminado'));
}
?>