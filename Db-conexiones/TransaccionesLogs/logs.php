<?php
/**
*Representa la estructura de los metas almacenados en la base de datos
*/
require_once 'database.php';

class Logs
{
	function __construct(){}

	/**
	*Retorna fila especifica de la tabla 'meta'
	*@param $idMeta Identificador del registro
	*@return array datos del registro
	*/
	public static function getAll()
	{
		$query="select * from Logs";
		try{
			//preparar sentencia
			$cmd=Database::getInstance()->getDb()->prepare($query);
			//ejecutar sentencia preparada
			$cmd->execute();

			return $cmd->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){return false;}
	}
	 /**
     * Obtiene los campos de una meta con un identificador
     * determinado
     *
     * @param $metaConsecutivo Identificador de la meta
     * @return mixed
     */
	public static function getById($idLog)
    {
        // Consulta de la meta
        $query = "SELECT metaConsecutivo,metaTitulo FROM log WHERE me = ?";

        try {
            // Preparar sentencia
            $cmd = Database::getInstance()->getDb()->prepare($query);
            // Ejecutar sentencia preparada
            $cmd->execute(array($idLog));
            // Capturar primera fila del resultado
            $row = $cmd->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
	/**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $metaConsecutivo      identificador
     * @param $metaTitulo      nuevo titulo
     * @param $metaDescripcion nueva descripcion
     * @param $metaFechaLimite    nueva fecha limite de cumplimiento
     * @param $metaCategoria   nueva categoria
     * @param $metaPrioridad   nueva prioridad
     */
    public static function update($idMeta,$metaTitulo,$metaDescripcion,$metaFechaLimite,$metaCategoria,$metaPrioridad)
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE meta SET metTitulo=?, metaDescripcion=?, metaFechaLimite=?, metaCategoria=?, metaPrioridad=? WHERE idMeta=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($metaTitulo,$metaDescripcion,$metaFechaLimite,$metaCategoria,$metaPrioridad,$idMeta));

        return $cmd;
    }
	/**
     * Insertar una nueva meta
     *
     * @param $titulo      titulo del nuevo registro
     * @param $descripcion descripción del nuevo registro
     * @param $fechaLim    fecha limite del nuevo registro
     * @param $categoria   categoria del nuevo registro
     * @param $prioridad   prioridad del nuevo registro
     * @return PDOStatement
     */
	public static function insert($titulo,$descripcion,$fechaLim,$categoria,$prioridad)
    {
        // Sentencia INSERT
        $comando = "INSERT INTO meta (metaTitulo,metaDescripcion,metaFechaLimite,metaCategoria,metaPrioridad) VALUES(?,?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($titulo,$descripcion,$fechaLim,$categoria,$prioridad));

    }
	 /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idMeta identificador de la meta
     * @return bool Respuesta de la eliminación
     */
    public static function delete($idMeta)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM meta WHERE idMeta=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idMeta));
    }
}
?>