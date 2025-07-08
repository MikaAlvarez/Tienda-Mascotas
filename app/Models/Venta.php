<?php

// Definimos el namespace donde se encuentra este modelo
namespace App\Models;

// Importamos las clases necesarias
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Venta
 * 
 * Representa las transacciones de compra en la tienda de mascotas
 * Tabla: ventas
 * Campos: id, cliente_id, fecha_venta, metodo_pago, total, estado, created_at, updated_at
 */
class Venta extends Model
{
    // Trait que permite usar factories para crear datos de prueba
    use HasFactory;

    /**
     * Campos que pueden ser asignados masivamente
     * 
     * Incluimos todos los campos editables según la migración
     */
    protected $fillable = [
        'cliente_id',    // ID del cliente que realizó la compra
        'fecha_venta',   // Fecha y hora de la venta
        'metodo_pago',   // Método de pago (puede ser null, máximo 50 caracteres)
        'total',         // Total de la venta en formato decimal
    ];

    /**
     * Valores por defecto para campos
     * 
     * Definimos valores por defecto según la migración
     */
    protected $attributes = [
        'estado' => 'pendiente',        // Estado por defecto según migración
    ];

    /**
     * Relación muchos a uno con Cliente
     * 
     * Cada venta pertenece a un cliente
     * Definida en la migración como: cliente_id foreign key con cascade
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        // Retorna el cliente que realizó esta venta
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Relación uno a muchos con DetalleVenta
     * 
     * Una venta puede tener muchos detalles (productos)
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalleVentas()
    {
        // Retorna todos los detalles de esta venta
        return $this->hasMany(DetalleVenta::class);
    }

    /**
     * Scope para ventas pendientes
     * 
     * Uso: Venta::pendientes()->get()
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePendientes($query)
    {
        // Filtra ventas con estado 'pendiente'
        return $query->where('estado', 'pendiente');
    }

    /**
     * Scope para ventas completadas
     * 
     * Uso: Venta::completadas()->get()
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompletadas($query)
    {
        // Filtra ventas con estado 'completada'
        return $query->where('estado', 'completada');
    }

    /**
     * Scope para ventas canceladas
     * 
     * Uso: Venta::canceladas()->get()
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCanceladas($query)
    {
        // Filtra ventas con estado 'cancelada'
        return $query->where('estado', 'cancelada');
    }

    /**
     * Scope para ventas de una fecha específica
     * 
     * Uso: Venta::porFecha('2024-01-15')->get()
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $fecha Fecha en formato 'Y-m-d'
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePorFecha($query, $fecha)
    {
        // Filtra ventas por fecha específica
        return $query->whereDate('fecha_venta', $fecha);
    }

    /**
     * Scope para ventas entre fechas
     * 
     * Uso: Venta::entreFechas('2024-01-01', '2024-01-31')->get()
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $fechaInicio Fecha de inicio
     * @param string $fechaFin Fecha de fin
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeEntreFechas($query, $fechaInicio, $fechaFin)
    {
        // Filtra ventas dentro del rango de fechas
        return $query->whereBetween('fecha_venta', [$fechaInicio, $fechaFin]);
    }

    /**
     * Scope para ventas por método de pago
     * 
     * Uso: Venta::porMetodoPago('efectivo')->get()
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $metodoPago Método de pago a buscar
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePorMetodoPago($query, $metodoPago)
    {
        // Filtra ventas por método de pago
        return $query->where('metodo_pago', $metodoPago);
    }
}