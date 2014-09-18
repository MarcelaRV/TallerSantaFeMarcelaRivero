<?php
/**
 * esta clase es donde se realizan las sentenciasde de la tabla Aprendiz
 * @author Shirley Marcela Rivero <marrivero@misena.edu.co>
 */
class modelClass {
/**
 * esta funcion es sentencia que permitirar vizualizar la tabla aprendiz
 * @param type $id se define esta variable con la llave primaria de la tabala
 * @return \PDOException devuelve exito si se realiza no realizado  si no se puede procesar
 */
  static public function viewAprendiz($id) {
    try {
      $sql = 'SELECT aprendiz.id_apre, aprendiz.nom_apre, aprendiz.apell_apre FROM aprediz WHERE aprediz.id_apre = ' . $id;
      return dataBaseClass::getInstance()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return $e;
    }
  }
/**
 * esta funcion es sentencia que permitirara validar la llave primaria la tabla aprendiz
 * @param type $id se define esta variable con la llave primaria de la tabala
 * @return \PDOException devuelve exito si se realiza no realizado  si no se puede procesar
 */
  static public function certifyId($id) {
    try {
      $sql = 'SELECT aprendiz.id_apre FROM aprendiz WHERE aprendiz.id_apre = ' . $id;
      return dataBaseClass::getInstance()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return $e;
    }
  }
  /**
   * este metodo trae los datos de la tabla ciudad que son utilizados para un select de formulario
   * @return \PDOException @return \PDOException devuelve exito si se realiza no realizado  si no se puede procesar
   */

  static public function showCity() {
    try {
      $sql = 'SELECT ciudad.cod_ciudad, ciudad.nom_ciudad FROM ciudad';
      return dataBaseClass::getInstance()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return $e;
    }
  }
/**
   * este metodo trae los datos de la tabla ciudad que son utilizados para un select de formulario
   * @return \PDOException @return \PDOException devuelve exito si se realiza no realizado  si no se puede procesar
   */
  static public function showTypeId() {
    try {
      $sql = 'SELECT tipo_id.cod_tipo_id, tipo_id.desc_tipo_id FROM tipo_id';
      return dataBaseClass::getInstance()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return $e;
    }
  }
/**
   * este metodo trae los datos de la tabla ciudad que son utilizados para un select de formulario
   * @return \PDOException @return \PDOException devuelve exito si se realiza no realizado  si no se puede procesar
   */
  static public function getRh() {
    try {
      $sql = 'SELECT rh.cod_rh, rh.desc_rh FROM rh';
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
      $sql = 'SELECT aprendiz.id_apre, aprendiz.nom_apre, aprendiz.apell_apre, aprendiz.tel_apre, aprendiz.cod_ciudad, aprendiz.cod_tipo_id, aprendiz.genero, aprendiz.edad FROM aprendiz';
      return dataBaseClass::getInstance()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return $e;
      /*
        if($e->getCode() === 10) {
        echo 'Base de Datos no encotrada';
        }
       */
    }
  }
/**
 * en este metodo se ejecuta la sentecia de update
 * @param type $id se define esta variable con la llave primaria de la tabla
 * @param type $data se define esta variable como un array por medio del forech
 * @return \PDOException|boolean ??
 * @throws PDOException devuelbe exito si se realiza o devuelbe no realizado si no se ejecuta
 */
  static public function updateApren($id, $data) {
    try {

      $sql = "UPDATE aprendiz SET ";

      foreach ($data as $key => $value) {
        $sql = $sql . " " . $key . " = '" . $value . "', ";
      }

      $newLeng = strlen($sql) - 2;
      $sql = substr($sql, 0, $newLeng);

      $sql = $sql . " WHERE id_apre = " . $id;

      dataBaseClass::getInstance()->beginTransaction();
      $rsp = dataBaseClass::getInstance()->exec($sql);
      dataBaseClass::getInstance()->commit();

      if ($rsp !== false) {
        $rsp = true;
      } else {
        throw new PDOException("El aprendiz no ha podido ser actualizado");
      }
      return $rsp;
    } catch (PDOException $e) {
      dataBaseClass::getInstance()->rollback();
      return $e;
    }
  }
/**
 * 
 * @param type $id se define esta variable con la llave primaria de la tabla
 * 
 * @throws PDOException devuelbe exito si se realiza o devuelbe no realizado si no se ejecuta
 */
  static public function getRow($id) {
    try {

      $sql = 'SELECT aprendiz.id_apre, aprendiz.nom_apre, aprendiz.apell_apre, aprendiz.cod_ciudad, aprendiz.cod_rh, aprendiz.cod_tipo_id, aprendiz.genero, aprendiz.edad, aprendiz.tel_apre from aprendiz, ciudad, depto, rh, tipo_id  WHERE aprendiz.cod_rh=rh.cod_rh and aprendiz.cod_ciudad=ciudad.cod_ciudad and ciudad.cod_depto=depto.cod_depto and aprendiz.cod_tipo_id=tipo_id.cod_tipo_id and aprendiz.id_apre = ' . $id;
      return dataBaseClass::getInstance()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return $e;
    }
  }
  /**
 * 
 * @param type $id se define esta variable con la llave primaria de la tabla
 * 
 * @throws PDOException devuelbe exito si se realiza o devuelbe no realizado si no se ejecuta
 */

  static public function deleteUsuario($id) {
    try {

      $sql = "DELETE FROM aprendiz WHERE id_apre = " . $id;

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
  /**
   * 
   * @param type $id se define como la llave primaria
   * @param type $nom se define como nom_apre
   * @param type $apell se define como apell_apre
   * @param type $tel se define como tel_apre
   * @param type $ciudad se define como cod_ciudad
   * @param type $rh se define como cod_rh
   * @param type $tipoId se define como cod_tipo_id
   * @param type $genero se define cocmo  genero
   * @param type $edad se define como edad
   * 
   *@throws PDOException devuelbe exito si se ejecuta y si no nose pudo realizar
   */

  static public function NewApre($id, $nom, $apell, $tel, $ciudad, $rh, $tipoId, $genero, $edad) {
    try {
      $sql = "INSERT INTO aprendiz (id_apre, nom_apre, apell_apre, tel_apre, cod_ciudad, cod_rh, cod_tipo_id, genero, edad ) VALUES ('$id', '$nom', '$apell', '$tel', '$ciudad', '$rh', '$tipoId', '$genero', '$edad')";
      dataBaseClass::getInstance()->beginTransaction();
      $rsp = dataBaseClass::getInstance()->exec($sql);
      dataBaseClass::getInstance()->commit();

      if ($rsp !== false) {
        $rsp = true;
      } else {
        throw new PDOException("El aprendiz $id $nom $apell  está siendo usado");
      }

      return $rsp;
    } catch (PDOException $e) {
      return $e;
    }
  }

}

?>