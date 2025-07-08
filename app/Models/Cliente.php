<?php

// Definimos el namespace donde se encuentra este modelo
namespace App\Models;

// Importamos las clases necesarias
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Cliente
 * 
 * Representa los clientes de la tienda de mascotas
 * Tabla: clientes
 * Campos: id, nombre, email, telefono, direccion, ciudad, created_at, updated_at
 */
class Cliente extends Model
{
    // Trait que permite usar factories para crear datos de prueba
    use HasFactory;

    /**
     * Nombre de la tabla en la base de datos
     * 
     * Especificamos explícitamente el nombre de la tabla
     */
    protected $table = 'clientes';

    /**
     * Campos que pueden ser asignados masivamente
     * 
     * Incluimos todos los campos editables según la migración
     */
    protected $fillable = [
        'nombre',       // Nombre completo del cliente
        'email',        // Email del cliente (único según migración)
        'telefono',     // Teléfono del cliente (puede ser null)
        'direccion',    // Dirección del cliente (puede ser null)
        'ciudad'        // Ciudad del cliente (puede ser null)
    ];

    /**
     * Relación uno a muchos con Venta
     * 
     * Un cliente puede realizar muchas compras
     * Definida en la migración de ventas como: cliente_id foreign key
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ventas()
    {
        // Retorna todas las ventas realizadas por este cliente
        return $this->hasMany(Venta::class);
    }

    /**
     * Scope para buscar clientes por nombre
     * 
     * Uso: Cliente::porNombre('Juan')->get()
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $nombre Nombre a buscar
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePorNombre($query, $nombre)
    {
        // Busca clientes que contengan el texto en el nombre
        return $query->where('nombre', 'like', "%{$nombre}%");
    }

    /**
     * Scope para buscar clientes por email
     * 
     * Uso: Cliente::porEmail('gmail')->get()
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $email Email a buscar
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePorEmail($query, $email)
    {
        // Busca clientes que contengan el texto en el email
        return $query->where('email', 'like', "%{$email}%");
    }

    /**
     * Scope para buscar clientes por ciudad
     * 
     * Uso: Cliente::porCiudad('Buenos Aires')->get()
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $ciudad Ciudad a buscar
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePorCiudad($query, $ciudad)
    {
        // Busca clientes que contengan el texto en la ciudad
        return $query->where('ciudad', 'like', "%{$ciudad}%");
    }

    /**
     * Scope para clientes con ventas
     * 
     * Uso: Cliente::conVentas()->get()
     * Obtiene solo clientes que han realizado al menos una compra
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeConVentas($query)
    {
        // Filtra clientes que tienen al menos una venta
        return $query->has('ventas');
    }
}