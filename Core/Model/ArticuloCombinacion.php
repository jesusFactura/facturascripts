<?php
/**
 * This file is part of facturacion_base
 * Copyright (C) 2015-2017  Carlos Garcia Gomez  neorazorx@gmail.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace FacturaScripts\Core\Model;

use FacturaScripts\Core\Base\Model;

/**
 * Este modelo representa el par atributo => valor de la combinación de un artículo con atributos.
 * Ten en cuenta que lo que se almacena son estos pares atributo => valor,
 * pero la combinación del artículo es el conjunto, que comparte el mismo código.
 *
 * Ejemplo de combinación:
 * talla => l
 * color => blanco
 *
 * Esto se traduce en dos objetos articulo_combinación, ambos con el mismo código,
 * pero uno con nombreatributo talla y valor l, y el otro con nombreatributo color
 * y valor blanco.
 *
 * @author Carlos García Gómez <neorazorx@gmail.com>
 */
class ArticuloCombinacion
{
    use Model {
        saveInsert as private saveInsertTrait;
    }

    /**
     * Clave primaria. Identificador de este par atributo-valor, no de la combinación.
     * @var
     */
    public $id;

    /**
     * Identificador de la combinación.
     * Ten en cuenta que la combinación es la suma de todos los pares atributo-valor.
     * @var
     */
    public $codigo;

    /**
     * Segundo identificador para la combinación, para facilitar la sincronización
     * con woocommerce o prestashop.
     * @var
     */
    public $codigo2;

    /**
     * Referencia del artículos relacionado.
     * @var
     */
    public $referencia;

    /**
     * ID del valor del atributo.
     * @var
     */
    public $idvalor;

    /**
     * Nombre del atributo.
     * @var
     */
    public $nombreatributo;

    /**
     * Valor del atributo.
     * @var
     */
    public $valor;

    /**
     * Referencia de la propia combinación.
     * @var
     */
    public $refcombinacion;

    /**
     * Código de barras de la combinación.
     * @var
     */
    public $codbarras;

    /**
     * Impacto en el precio del artículo.
     * @var
     */
    public $impactoprecio;

    /**
     * Stock físico de la combinación.
     * @var
     */
    public $stockfis;

    /**
     * ArticuloCombinacion constructor.
     *
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->init(__CLASS__, 'articulo_combinaciones', 'id');
        if (is_null($data) || empty($data)) {
            $this->clear();
        } else {
            $this->loadFromData($data);
        }
    }

    /**
     * Resetea los valores de todas las propiedades modelo.
     */
    public function clear()
    {
        $this->id = null;
        $this->codigo = null;
        $this->codigo2 = null;
        $this->referencia = null;
        $this->idvalor = null;
        $this->nombreatributo = null;
        $this->valor = null;
        $this->refcombinacion = null;
        $this->codbarras = null;
        $this->impactoprecio = 0;
        $this->stockfis = 0;
    }

    /**
     * Devuelve la combinación de artículo con codigo = $cod
     * @deprecated since version 110
     *
     * @param string $cod
     *
     * @return ArticuloCombinacion|bool
     */
    public function getByCodigo($cod)
    {
        $sql = 'SELECT * FROM ' . $this->tableName() . ' WHERE codigo = ' . $this->var2str($cod) . ';';
        $data = $this->database->select($sql);
        if (!empty($data)) {
            return new ArticuloCombinacion($data[0]);
        }
        return false;
    }

    /**
     * Elimina todas las combinaciones del artículo con referencia = $ref
     *
     * @param string $ref
     *
     * @return bool
     */
    public function deleteFromRef($ref)
    {
        $sql = 'DELETE FROM ' . $this->tableName() . ' WHERE referencia = ' . $this->var2str($ref) . ';';
        return $this->database->exec($sql);
    }

    /**
     * Devuelve un array con todas las combinaciones del artículo con referencia = $ref
     *
     * @param string $ref
     *
     * @return array
     */
    public function allFromRef($ref)
    {
        $lista = [];

        $sql = 'SELECT * FROM ' . $this->tableName() . ' WHERE referencia = ' . $this->var2str($ref)
            . ' ORDER BY codigo ASC, nombreatributo ASC;';
        $data = $this->database->select($sql);
        if (!empty($data)) {
            foreach ($data as $d) {
                $lista[] = new ArticuloCombinacion($d);
            }
        }

        return $lista;
    }

    /**
     * Devuelve un array con todos los datos de la combinación con código = $cod,
     * ten en cuenta que lo que se almacenan son los pares atributo => valor.
     *
     * @param string $cod
     *
     * @return array
     */
    public function allFromCodigo($cod)
    {
        $lista = [];

        $sql = 'SELECT * FROM ' . $this->tableName() . ' WHERE codigo = ' . $this->var2str($cod)
            . ' ORDER BY nombreatributo ASC;';
        $data = $this->database->select($sql);
        if (!empty($data)) {
            foreach ($data as $d) {
                $lista[] = new ArticuloCombinacion($d);
            }
        }

        return $lista;
    }

    /**
     * Devuelve un array con todos los datos de la combinación con codigo2 = $cod,
     * ten en cuenta que lo que se almacena son los pares atrubuto => valor.
     *
     * @param string $cod
     *
     * @return array
     */
    public function allFromCodigo2($cod)
    {
        $lista = [];

        $sql = 'SELECT * FROM ' . $this->tableName() . ' WHERE codigo2 = ' . $this->var2str($cod)
            . ' ORDER BY nombreatributo ASC;';
        $data = $this->database->select($sql);
        if (!empty($data)) {
            foreach ($data as $d) {
                $lista[] = new ArticuloCombinacion($d);
            }
        }

        return $lista;
    }

    /**
     * Devuelve las combinaciones del artículos $ref agrupadas por código.
     *
     * @param string $ref
     *
     * @return array
     */
    public function combinacionesFromRef($ref)
    {
        $lista = [];

        $sql = 'SELECT * FROM ' . $this->tableName() . ' WHERE referencia = ' . $this->var2str($ref)
            . ' ORDER BY codigo ASC, nombreatributo ASC;';
        $data = $this->database->select($sql);
        if (!empty($data)) {
            foreach ($data as $d) {
                if (isset($lista[$d['codigo']])) {
                    $lista[$d['codigo']][] = new ArticuloCombinacion($d);
                } else {
                    $lista[$d['codigo']] = [new ArticuloCombinacion($d)];
                }
            }
        }

        return $lista;
    }

    /**
     * Devuelve un array con las combinaciones que contienen $query en su referencia
     * o que coincide con su código de barras.
     *
     * @param string $query
     *
     * @return array
     */
    public function search($query = '')
    {
        $artilist = [];
        $query = static::noHtml(mb_strtolower($query, 'UTF8'));

        $sql = 'SELECT * FROM ' . $this->tableName() . " WHERE referencia LIKE '" . $query . "%'"
            . ' OR codbarras = ' . $this->var2str($query);

        $data = $this->database->selectLimit($sql, 200);
        if (!empty($data)) {
            foreach ($data as $d) {
                $artilist[] = new ArticuloCombinacion($d);
            }
        }

        return $artilist;
    }

    /**
     * Inserta los datos del modelo en la base de datos.
     * @return bool
     */
    private function saveInsert()
    {
        if ($this->codigo === null) {
            $this->codigo = $this->getNewCodigo();
        }
        return $this->saveInsertTrait();
    }

    /**
     * Esta función es llamada al crear la tabla del modelo. Devuelve el SQL
     * que se ejecutará tras la creación de la tabla. útil para insertar valores
     * por defecto.
     * @return string
     */
    private function install()
    {
        /// nos aseguramos de que existan las tablas necesarias
        //new Atributo();
        //new AtributoValor();

        return '';
    }

    /**
     * Devuelve un nuevo código para una combinación de artículo
     * @return int
     */
    private function getNewCodigo()
    {
        $sql = 'SELECT MAX(' . $this->database->sql2Int('codigo') . ') as cod FROM ' . $this->tableName() . ';';
        $cod = $this->database->select($sql);
        if (!empty($cod)) {
            return 1 + (int)$cod[0]['cod'];
        }
        return 1;
    }
}
