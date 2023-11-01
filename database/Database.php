<?php
class ConnectionDB
{
    private $host = 'uzb4o9e2oe257glt.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
    private $dbname = 'xrubqk8kr3nera28';
    private $username = 'sb138ngp7obd8cgd';
    private $password = 'ixr9y4jwc4aom7ky';
    private $db;  // Propiedad para la conexión a la base de datos

    public function __construct()
    {
        // Establece la conexión a la base de datos en el constructor
        $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
        try {
            $this->db = new PDO($dsn, $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function createDB()
    {
        // Define la consulta SQL para crear las tablas
        $sql = "
            CREATE TABLE usuarios (
                ID INT AUTO_INCREMENT PRIMARY KEY,
                Nombre VARCHAR(255),
                Correo VARCHAR(255),
                Contrasena VARCHAR(255),
                Direccion VARCHAR(255),
                Token_FB VARCHAR(255),
                Estado VARCHAR(255)
            );

            CREATE TABLE pedidos (
                ID INT AUTO_INCREMENT PRIMARY KEY,
                producto VARCHAR(255),
                cantidad INT,
                metodo_pago VARCHAR(255),
                usuario_id INT,
                FOREIGN KEY (usuario_id) REFERENCES usuarios(ID)
            );

            CREATE TABLE purificadora (
                ID INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(255),
                correo VARCHAR(255),
                contrasena VARCHAR(255),
                telefono VARCHAR(255)
            );

            CREATE TABLE enviados (
                ID INT AUTO_INCREMENT PRIMARY KEY,
                costo VARCHAR(255),
                id_purificadora INT,
                FOREIGN KEY (id_purificadora) REFERENCES purificadora(ID)
            );
        ";

        try {
            // Ejecuta la consulta SQL
            $this->db->exec($sql);
            echo "Las tablas han sido creadas exitosamente.";
        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }
}

// Ejemplo de uso

?>
