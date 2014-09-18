<?php
/**
 * esta clase es donde se realizan las sentenciasde de la tabla matricula
 * @author Shirley Marcela Rivero <marrivero@misena.edu.co>
 */
class modelClass {

  static public function getMatricula() {
    try {
      $sql = 'SELECT matricula.num_ficha, matricula.id_apren, matricula.estado FROM matricula';
      return dataBaseClass::getInstance()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return $e;
    }
  }
/**
 * 
 * @param type $id se define con la llave primaria
 * @return \PDOException de vuelve error si no se realiza de locontrario exito
 */
  static public function certifyId($id) {
    try {
      $sql = 'SELECT matricula.num_ficha FROM matricula WHERE matricula.num_ficha = ' . $id;
      return dataBaseClass::getInstance()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return $e;
    }
  }

  static public function getAll() {
    try {
      $sql = 'SELECT matricula.estado, matricula.id_apre, matricula.num_ficha from matricula ';
      return dataBaseClass::getinstance()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return $e;
    }
  }
/**
 * 
 * @param type $Num es num_ficha
 * @param type $Id es id_apre
 * @param type $Estado es  estado
 * @return \PDOException|boolean????
 * @throws PDOException devuelve exito si  se realiza de lo contrario error
 */
  static public function NewMatricula($Num, $Id, $Estado) {
    try {
      $sql = "INSERT INTO matricula (num_ficha, id_apre, estado ) VALUES ('$Num', '$Id', '$Estado')";


      dataBaseClass::getInstance()->beginTransaction();
      $rsp = dataBaseClass::getInstance()->exec($sql);
      dataBaseClass::getInstance()->commit();

      if ($rsp !== false) {
        $rsp = true;
      } else {
        throw new PDOException("La matricula $Num $Id $Estado   está siendo usado");
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

  static public function updateMatricula($id, $numFicha, $data) {
    try {
      
      $sql = "UPDATE matricula SET ";

      foreach ($data as $key => $value) {
        $sql = $sql . " " . $key . " = '" . $value . "', ";
      }

      $newLeng = strlen($sql) - 2;
      $sql = substr($sql, 0, $newLeng);

      $sql = $sql . " WHERE num_ficha = '".$numFicha."' AND id_apre = '".$id."'";
      
      echo $sql;
      die();

      dataBaseClass::getInstance()->beginTransaction();
      $rsp = dataBaseClass::getInstance()->exec($sql);
      dataBaseClass::getInstance()->commit();

      if ($rsp !== false) {
        $rsp = true;
      } else {
        throw new PDOException("La Matricula no ha podido ser actualizado");
      }
      return $rsp;
    } catch (PDOException $e) {
      dataBaseClass::getInstance()->rollback();
      return $e;
    }
  }
  /**
   * 
   * @param type $id se define de la llave primaria
   * @return \PDOException devuelve exito y si no devuelbe error
   */
  

  static public function getRow($id) {
    try {

      $sql = 'SELECT matricula.estado, matricula.id_apre, matricula.num_ficha From matricula  WHERE matricula.num_ficha = ' . $id;
      return dataBaseClass::getInstance()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return $e;
    }
  }

  static public function deleteMatricula($id) {
    try {

      $sql = 'DELETE FROM matricula WHERE num_ficha = ' . $id;
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