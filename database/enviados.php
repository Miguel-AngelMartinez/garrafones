<?php
require 'Database.php';
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $db = new ConnectionDB();
    $sql = "SELECT * FROM enviados";
    $stmt = $db->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $db = new ConnectionDB();
    $sql = "INSERT INTO enviados (nombre, correo, contrasena) VALUES (:nombre, :correo, :contrasena)";
    $stmt = $db->db->prepare($sql);
    $stmt->bindParam(':nombre', $_POST['nombre']);
    $stmt->bindParam(':correo', $_POST['correo']);
    $stmt->bindParam(':contrasena', $_POST['contrasena']);
    $stmt->execute();
    echo json_encode(array('message' => 'Enviado creado'));
}
if ($_SERVER["REQUEST_METHOD"] === "PUT") {
    $db = new ConnectionDB();
    $sql = "UPDATE enviados SET nombre = :nombre, correo = :correo, contrasena = :contrasena WHERE ID = :ID";
    $stmt = $db->db->prepare($sql);
    $stmt->bindParam(':ID', $_GET['ID']);
    $stmt->bindParam(':nombre', $_POST['nombre']);
    $stmt->bindParam(':correo', $_POST['correo']);
    $stmt->bindParam(':contrasena', $_POST['contrasena']);
    $stmt->execute();
    echo json_encode(array('message' => 'Enviado actualizado'));
}
if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    $db = new ConnectionDB();
    $sql = "DELETE FROM enviados WHERE ID = :ID";
    $stmt = $db->db->prepare($sql);
    $stmt->bindParam(':ID', $_GET['ID']);
    $stmt->execute();
    echo json_encode(array('message' => 'Enviado eliminado'));
}
?>