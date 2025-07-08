<?php

// Definimos el namespace donde se encuentra este modelo
namespace App\Models;

// Importamos las clases necesarias
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Articulo
 * 
 * Representa los productos disponibles en la tienda de mascotas
 * Tabla: articulos
 * Campos: id, nombre, descripcion, stock, precio, categoria_id, created_at, updated_at
 */
class Articulo extends Model
{
    // Trait que permite usar factories para crear datos de prueba
    use HasFactory;

    /**
     * Campos que pueden ser asignados masivamente
     * 
     * Incluimos todos los campos editables según la migración
     */
    protected $fillable = [
        'nombre',        // Nombre del producto
        'descripcion',   // Descripción del producto (puede ser null)
        'stock',         // Cantidad en inventario (default: 0)
        'precio',        // Precio del producto en formato decimal
        'categoria_id'   // ID de la categoría a la que pertenece
    ];

    /**
     * Relación muchos a uno con Categoria
     * 
     * Cada artículo pertenece a una categoría
     * Definida en la migración como: categoria_id foreign key
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoria()
    {
        // Retorna la categoría a la que pertenece este artículo
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Relación uno a muchos con DetalleVenta
     * 
     * Un artículo puede estar en muchas ventas
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalleVentas()
    {
        // Retorna todos los detalles de venta donde aparece este artículo
        return $this->hasMany(DetalleVenta::class);
    }

    /**
     * Scope para obtener artículos en stock
     * 
     * Uso: Articulo::enStock()->get()
     * Filtra productos que tienen stock disponible
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeEnStock($query)
    {
        // Filtra artículos con stock mayor a 0
        return $query->where('stock', '>', 0);
    }

    /**
     * Scope para obtener artículos sin stock
     * 
     * Uso: Articulo::sinStock()->get()
     * Filtra productos que no tienen stock disponible
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSinStock($query)
    {
        // Filtra artículos con stock igual a 0
        return $query->where('stock', 0);
    }

    /**
     * Scope para obtener artículos por categoría
     * 
     * Uso: Articulo::porCategoria(1)->get()
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $categoriaId ID de la categoría
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePorCategoria($query, $categoriaId)
    {
        // Filtra artículos por ID de categoría
        return $query->where('categoria_id', $categoriaId);
    }

    /**
     * Scope para buscar artículos por nombre
     * 
     * Uso: Articulo::porNombre('collar')->get()
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $nombre Nombre a buscar
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePorNombre($query, $nombre)
    {
        // Busca artículos que contengan el texto en el nombre
        return $query->where('nombre', 'like', "%{$nombre}%");
    }
}