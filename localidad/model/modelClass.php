<?php
/**
 * esta clase es donde se realizan las sentenciasde de la tabla Aprendiz
 * @author Shirley Marcela Rivero <marrivero@misena.edu.co>
 */
class modelClass {
/**
 * trae todo lo de localidad
 * @return \PDOException devuelve exito si se realiza y errror de lo contrario
 */
    static public function getLocalidad() {
        try {
            $sql = 'SELECT localidad.id, localidad.nombre, localidad.localidad_id FROM localidad';
            return dataBaseClass::getInstance()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e;
        }
    }

    static public function getRow($id) {
        try {

            $sql = 'SELECT localidad.id, localidad.nombre, localidad.localidad_id FROM localidad WHERE localidad.id = ' . $id;

            return dataBaseClass::getInstance()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e;
        }
    }

    static public function certifyId($id) {
        try {
            $sql = 'SELECT localidad.id FROM localidad WHERE localidad.id = ' . $id;
            return dataBaseClass::getInstance()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e;
        }
    }
/**
 * esta  funcion trae todos los datos de la tabla aprendiz con base a una sentencia
 * @return \PDOException devuelbe exito si se realiza o devuelbe no realizado si no se ejecuta
 */
    static public function getAll() {
        try {
            $sql = 'SELECT localidad.id, localidad.nombre, localidad.localidad_id FROM localidad ';
            return dataBaseClass::getinstance()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e;
        }
    }

    static public function NewLocalidad($Id, $Nombre, $locaId) {
        try {
            $sql = "INSERT INTO localidad (id, nombre, localidad_id ) VALUES ('$Id', '$Nombre', '$locaId')";


            dataBaseClass::getInstance()->beginTransaction();
            $rsp = dataBaseClass::getInstance()->exec($sql);
            dataBaseClass::getInstance()->commit();

            if ($rsp !== false) {
                $rsp = true;
            } else {
                throw new PDOException("La localidad $Id $Nombre   está siendo usado");
            }

            return $rsp;
        } catch (PDOException $e) {
            return $e;
        }
    }
/**
 * en este metodo se ejecuta la sentecia de update
 * @param type $id se define esta variable con la llave primaria de la tabla
 * @param type $data se define esta variable como un array por medio del forech
 * @return \PDOException|boolean ??
 * @throws PDOException devuelbe exito si se realiza o devuelbe no realizado si no se ejecuta
 */
    static public function updateLocalidad($id, $data) {
        try {

            $sql = "UPDATE localidad SET ";

            foreach ($data as $key => $value) {
                $sql = $sql . " " . $key . " = '" . $value . "', ";
            }

            $newLeng = strlen($sql) - 2;
            $sql = substr($sql, 0, $newLeng);

            $sql = $sql . " WHERE id = " . $id;

            dataBaseClass::getInstance()->beginTransaction();
            $rsp = dataBaseClass::getInstance()->exec($sql);
            dataBaseClass::getInstance()->commit();

            if ($rsp !== false) {
                $rsp = true;
            } else {
                throw new PDOException("La localidad no ha podido ser actualizado");
            }
            return $rsp;
        } catch (PDOException $e) {
          dataBaseClass::getInstance()->rollback();
            return $e;
        }
    }

    static public function deleteLocalidad($id) {
        try {

            $sql = 'DELETE FROM localidad WHERE id = ' . $id;

            dataBaseClass::getInstance()->beginTransaction();
            $rsp = dataBaseClass::getInstance()->exec($sql);
            dataBaseClass::getInstance()->commit();

            if ($rsp !== false) {
                $rsp = true;
            } else {
                throw new PDOException("El aprendiz no ha podido ser eliminado", 2633);
            }
            return $rsp;
        } catch (PDOException $e) {
          dataBaseClass::getInstance()->rollback();
            return $e;
        }
    }

}

?>