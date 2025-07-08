<?php

// Definimos el namespace donde se encuentra este modelo
namespace App\Models;

// Importamos las clases necesarias
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo DetalleVenta
 * 
 * Representa los productos específicos vendidos en cada venta
 * Tabla: detalle_ventas
 * Campos: id, venta_id, articulo_id, cantidad, precio_unitario, subtotal, created_at, updated_at
 * Índices: [venta_id, articulo_id] para optimizar consultas
 */
class DetalleVenta extends Model
{
    // Trait que permite usar factories para crear datos de prueba
    use HasFactory;

    /**
     * Campos que pueden ser asignados masivamente
     * 
     * Incluimos todos los campos editables según la migración
     */
    protected $fillable = [
        'venta_id',        // ID de la venta a la que pertenece
        'articulo_id',     // ID del artículo vendido
        'cantidad',        // Cantidad vendida (unsigned integer)
        'precio_unitario', // Precio por unidad al momento de la venta
        'subtotal'         // Subtotal de esta línea (cantidad × precio_unitario)
    ];

    /**
     * Relación muchos a uno con Venta
     * 
     * Cada detalle pertenece a una venta específica
     * Definida en la migración como: venta_id foreign key con cascade
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function venta()
    {
        // Retorna la venta a la que pertenece este detalle
        return $this->belongsTo(Venta::class);
    }

    /**
     * Relación muchos a uno con Articulo
     * 
     * Cada detalle corresponde a un artículo específico
     * Definida en la migración como: articulo_id foreign key con cascade
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function articulo()
    {
        // Retorna el artículo vendido en este detalle
        return $this->belongsTo(Articulo::class);
    }

    /**
     * Evento que se ejecuta antes de guardar el modelo
     * 
     * Calcula automáticamente el subtotal antes de guardar
     */
    protected static function boot()
    {
        parent::boot();

        // Antes de crear un nuevo detalle, calcula el subtotal
        static::creating(function ($detalleVenta) {
            $detalleVenta->subtotal = $detalleVenta->cantidad * $detalleVenta->precio_unitario;
        });

        // Antes de actualizar un detalle, recalcula el subtotal
        static::updating(function ($detalleVenta) {
            $detalleVenta->subtotal = $detalleVenta->cantidad * $detalleVenta->precio_unitario;
        });
    }

    /**
     * Scope para detalles de una venta específica
     * 
     * Uso: DetalleVenta::porVenta(1)->get()
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $ventaId ID de la venta
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePorVenta($query, $ventaId)
    {
        // Filtra detalles por ID de venta
        return $query->where('venta_id', $ventaId);
    }

    /**
     * Scope para detalles de un artículo específico
     * 
     * Uso: DetalleVenta::porArticulo(5)->get()
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $articuloId ID del artículo
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePorArticulo($query, $articuloId)
    {
        // Filtra detalles por ID de artículo
        return $query->where('articulo_id', $articuloId);
    }

    /**
     * Scope para detalles con cantidad mayor a un valor
     * 
     * Uso: DetalleVenta::conCantidadMayorA(5)->get()
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $cantidad Cantidad mínima
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeConCantidadMayorA($query, $cantidad)
    {
        // Filtra detalles con cantidad mayor al valor especificado
        return $query->where('cantidad', '>', $cantidad);
    }

    /**
     * Accessor para obtener el subtotal calculado en tiempo real
     * 
     * Uso: $detalleVenta->subtotal_calculado
     * 
     * @return float Subtotal calculado
     */
    public function getSubtotalCalculadoAttribute()
    {
        // Calcula el subtotal en tiempo real
        return $this->cantidad * $this->precio_unitario;
    }

    /**
     * Método para verificar si el subtotal guardado es correcto
     * 
     * Útil para validaciones
     * 
     * @return bool True si el subtotal es correcto
     */
    public function subtotalEsCorrecto()
    {
        // Compara el subtotal guardado con el calculado
        return $this->subtotal == ($this->cantidad * $this->precio_unitario);
    }
}