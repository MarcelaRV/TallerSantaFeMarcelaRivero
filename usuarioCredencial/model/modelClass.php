<?php
/**
 * esta clase es donde se realizan las sentenciasde de la tabla usuario_credencial
 * @author Shirley Marcela Rivero <marrivero@misena.edu.co>
 */
class modelClass {
  
  /**
   * se trae todo de la tabla usuario_credencial
   * @return \PDOException devuelve exito si se realiza no realizado  si no se puede procesar
   */
    
    static public function getUsuario_credencial() {
        try {
            $sql = 'SELECT usuario_credencial.id, usuario_credencial.usuario_id, usuario_credencial.credencial_id FROM usuario_credencial';
            return dataBaseClass::getInstance()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e;
        }
    }
    /**
     *  esta funcion traetodo lo de credencial
     * @return \PDOException devuelve exito si se realiza no realizado  si no se puede procesar
     */
    
    static public function getcredencial() {
        try {
            $sql = 'SELECT credencial.id, credencial.nombre FROM credencial';
            return dataBaseClass::getInstance()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e;
        }
    }/**
     *  trae los datos de usuario
     *@param type $id se define esta variable con la llave primaria de la tabala
 * @return \PDOException devuelve exito si se realiza no realizado  si no se puede procesar
     */

    static public function getRow($id) {
        try {

            $sql = 'SELECT usuario_credencial.id, usuario_credencial.usuario_id, usuario_credencial.credencial_id from usuario_credencial WHERE usuario_credencial.id = ' . $id;
            
            return dataBaseClass::getInstance()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e;

        }
    }
/**
 * 
 *@param type $id se define esta variable con la llave primaria de la tabala
 * @return \PDOException devuelve exito si se realiza no realizado  si no se puede procesar
 */
    

    static public function certifyId($id) {
        try {
            $sql = 'SELECT usuario_credencial.id FROM usuario_credencial WHERE usuario_credencial.id = ' . $id;
            return dataBaseClass::getInstance()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e;
        }
    }
    /**
     * 
     * @return \PDOException  devuelve exito si se realiza no realizado  si no se puede procesar
     */

    static public function getAll() {
        try {
            $sql = 'SELECT usuario_credencial.id, usuario_credencial.usuario_id, usuario_credencial.credencial_id from usuario_credencial';
            return dataBaseClass::getinstance()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e;
        }
    }
  /**
   * 
   * @param type $Id se define como llave primaria
   * @param type $Usuario se define usuario
   * @param type $CredeId se define usuario_credencial
   * 
   * @throws PDOException  devuelve exito si se realiza no realizado  si no se puede procesar
   */

    static public function NewUsu($Id, $Usuario, $CredeId) {
        try {
            echo $sql = "INSERT INTO usuario_credencial (id, usuario_id, credencial_id ) VALUES ($Id, $Usuario, $CredeId)";
            
            
            
            dataBaseClass::getInstance()->beginTransaction();
            $rsp = dataBaseClass::getInstance()->exec($sql);
            dataBaseClass::getInstance()->commit();

            if ($rsp !== false) {
                $rsp = true;
            } else {
                throw new PDOException("El usuario_credencial $Id $Usuario   está siendo usado");
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

    static public function updateUsu($id, $data) {
        try {

            $sql = "UPDATE usuario_credencial SET ";

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
                throw new PDOException("El usuario_credencial no ha podido ser actualizado");
            }
            return $rsp;
        } catch (PDOException $e) {
          dataBaseClass::getInstance()->rollback();
            return $e;
        }
    }
    /**
     * 
     * @param type $id se define como primaria
     * @throws PDOException devuelve exito si se realiza si no no se puede
     */

    static public function deleteUsu($id) {
        try {

            $sql = 'DELETE FROM usuario_credencial WHERE id = ' . $id;

            dataBaseClass::getInstance()->beginTransaction();
            $rsp = dataBaseClass::getInstance()->exec($sql);
            dataBaseClass::getInstance()->commit();

            if ($rsp !== false) {
          $rsp = true;
            } else {
                throw new PDOException("El usuario_credencial no ha podido ser eliminado", 2633);
            }
            return $rsp;
        } catch (PDOException $e) {
          dataBaseClass::getInstance()->rollback();
            return $e;
        }
    }

}

?>