<?php

// Definimos el namespace donde se encuentra este modelo
namespace App\Models;

// Importamos las clases necesarias
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Categoria
 * 
 * Representa las categorías de productos en la tienda de mascotas
 * Tabla: categorias
 * Campos: id, nombre, created_at, updated_at
 */
class Categoria extends Model
{
    // Trait que permite usar factories para crear datos de prueba
    use HasFactory;

    /**
     * Campos que pueden ser asignados masivamente
     * 
     * Solo incluimos los campos que existen en la migración
     * y que queremos que sean editables
     */
    protected $fillable = [
        'nombre'    // Nombre de la categoría (ej: "Comida para perros", "Juguetes")
    ];

    public function articulos()
    {
        // Retorna todos los artículos que pertenecen a esta categoría
        return $this->hasMany(Articulo::class);
    }

    /**
     * Scope para buscar categorías por nombre
     * 
     * Uso: Categoria::porNombre('comida')->get()
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $nombre Nombre a buscar
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePorNombre($query, $nombre)
    {
        // Busca categorías que contengan el texto en el nombre
        return $query->where('nombre', 'like', "%{$nombre}%");
    }
}