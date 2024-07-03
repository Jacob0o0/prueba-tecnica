<?php

namespace App\Models;

use CodeIgniter\Model;

class ContenidoModel extends Model
{
    protected $table            = 'contenidos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    // DATOS QUE SE PUEDEN MODIFICAR O SUBIR:
    protected $allowedFields    = ['titulo', 'palabras_clave', 'area_conocimiento', 'tipo_contenido', 'imagen_portada', 'thumbnail', 'descripcion', 'contenido'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // VALIDACIONES
    protected $validationRules      = [
        'titulo'            => [
            'label' => 'titulo',
            'rules' => 'required'
        ], 
        'palabras_clave'    => [
            'label' => 'palabras_clave',
            'rules' => 'required'
        ], 
        'area_conocimiento' => [
            'label' => 'area_conocimiento',
            'rules' => 'required'
        ], 
        'tipo_contenido'    => [
            'label' => 'tipo_contenido',
            'rules' => 'required'
        ], 
        'imagen_portada'    => [
            'label' => 'imagen_portada',
            'rules' => 'required'
        ], 
        'thumbnail'         => [
            'label' => 'thumbnail',
            'rules' => 'required'
        ], 
        'descripcion'       => [
            'label' => 'descripcion',
            'rules' => 'required'
        ], 
        'contenido'         => [
            'label' => 'contenido',
            'rules' => 'required'
        ]
    ];

    // MENSAJES PARA VALIDACIONES INCORRECTAS
    protected $validationMessages   = [
        'titulo'            => [
            'required' => 'El campo {field} es requerido.'
        ], 
        'palabras_clave'    => [
            'required' => 'El campo {field} es requerido.'
        ], 
        'area_conocimiento' => [
            'required' => 'El campo {field} es requerido.'
        ], 
        'tipo_contenido'    => [
            'required' => 'El campo {field} es requerido.'
        ], 
        'imagen_portada'    => [
            'required' => 'El campo {field} es requerido.'
        ], 
        'thumbnail'         => [
            'required' => 'El campo {field} es requerido.'
        ], 
        'descripcion'       => [
            'required' => 'El campo {field} es requerido.'
        ], 
        'contenido'         => [
            'required' => 'El campo {field} es requerido.'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
