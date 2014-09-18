<?php
/**
 * esta clase es donde se realizan las sentenciasde de la tabla Programa
 * @author Shirley Marcela Rivero <marrivero@misena.edu.co>
 */

class modelClass {
    
    static public function getProgra() {
        try {
            $sql = 'SELECT programa.cod_prog,  programa.desc_prog, programa.estado  FROM programa';
            return dataBaseClass::getInstance()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e;
        }
    }
    /**
     * 
     * @param type $id se define de la llave primaria
     * @return \PDOException devuelve exito si se realiza y si el locantrario error
     */

    static public function getRow($id) {
        try {

            $sql = 'SELECT programa.cod_prog,  programa.desc_prog, programa.estado  FROM programa WHERE programa.cod_prog= ' . $id;        
            return dataBaseClass::getInstance()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e;

        }
    }

    
/**
     * 
     * @param type $id se define de la llave primaria
     * @return \PDOException devuelve exito si se realiza y si el locantrario error
     */

    static public function certifyId($id) {
        try {
            $sql = 'SELECT programa.cod_prog  FROM programa WHERE programa.cod_prog=  ' . $id;
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
            $sql = 'SELECT programa.cod_prog,  programa.desc_prog, programa.estado  FROM programa';
            return dataBaseClass::getinstance()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e;
        }
    }

    static public function NewCausa($Cod, $Desc,$Estado) {
        try {
            $sql = "INSERT INTO programa (cod_prog, desc_prog, estado) VALUES ('$Cod', '$Desc', '$Estado')";
            
            
            dataBaseClass::getInstance()->beginTransaction();
            $rsp = dataBaseClass::getInstance()->exec($sql);
            dataBaseClass::getInstance()->commit();

            if ($rsp !== false) {
                $rsp = true;
            } else {
                throw new PDOException("El programa $Cod $Desc   está siendo usado");
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
    static public function updateProgra($id, $data) {
        try {

            $sql = "UPDATE programa SET ";

            foreach ($data as $key => $value) {
                $sql = $sql . " " . $key . " = '" . $value . "', ";
            }

            $newLeng = strlen($sql) - 2;
            $sql = substr($sql, 0, $newLeng);

            $sql = $sql . " WHERE cod_prog = " . $id;

            dataBaseClass::getInstance()->beginTransaction();
            $rsp = dataBaseClass::getInstance()->exec($sql);
            dataBaseClass::getInstance()->commit();

            if ($rsp !== false) {
                $rsp = true;
            } else {
                throw new PDOException("El programa no ha podido ser actualizado");
            }
            return $rsp;
        } catch (PDOException $e) {
          dataBaseClass::getInstance()->rollback();
            return $e;
        }
    }

    static public function deleteProgra($id) {
        try {

            $sql = 'DELETE FROM programa WHERE cod_prog = ' . $id;

            dataBaseClass::getInstance()->beginTransaction();
            $rsp = dataBaseClass::getInstance()->exec($sql);
            dataBaseClass::getInstance()->commit();

            if ($rsp !== false) {
                $rsp = true;
            } else {
                $rsp = false;
            }
            return $rsp;
        } catch (PDOException $e) {
          dataBaseClass::getInstance()->rollback();
            return $e;
        }
    }
}
?>