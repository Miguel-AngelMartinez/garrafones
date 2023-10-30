<?php
require 'Database.php';
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $db = new ConnectionDB();
    $sql = "SELECT * FROM pedidos";
    $stmt = $db->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $db = new ConnectionDB();
    $sql = "INSERT INTO pedidos (producto, cantidad, metodo_pago, usuario_id) VALUES (:producto, :cantidad, :metodo_pago, :usuario_id)";
    $stmt = $db->db->prepare($sql);
    $stmt->bindParam(':producto', $_POST['producto']);
    $stmt->bindParam(':cantidad', $_POST['cantidad']);
    $stmt->bindParam(':metodo_pago', $_POST['metodo_pago']);
    $stmt->bindParam(':usuario_id', $_POST['usuario_id']);
    $stmt->execute();
    echo json_encode(array('message' => 'Pedido creado'));
}
if ($_SERVER["REQUEST_METHOD"] === "PUT") {
    $db = new ConnectionDB();
    $sql = "UPDATE pedidos SET producto = :producto, cantidad = :cantidad, metodo_pago = :metodo_pago, usuario_id = :usuario_id WHERE ID = :ID";
    $stmt = $db->db->prepare($sql);
    $stmt->bindParam(':ID', $_GET['ID']);
    $stmt->bindParam(':producto', $_POST['producto']);
    $stmt->bindParam(':cantidad', $_POST['cantidad']);
    $stmt->bindParam(':metodo_pago', $_POST['metodo_pago']);
    $stmt->bindParam(':usuario_id', $_POST['usuario_id']);
    $stmt->execute();
    echo json_encode(array('message' => 'Pedido actualizado'));
}
if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    $db = new ConnectionDB();
    $sql = "DELETE FROM pedidos WHERE ID = :ID";
    $stmt = $db->db->prepare($sql);
    $stmt->bindParam(':ID', $_GET['ID']);
    $stmt->execute();
    echo json_encode(array('message' => 'Pedido eliminado'));
}
?>