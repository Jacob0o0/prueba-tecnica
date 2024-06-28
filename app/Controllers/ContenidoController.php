<?php

namespace App\Controllers;

use App\Database\Migrations\Contenidos;
use App\Models\ContenidoModel;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;

class ContenidoController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $model = new ContenidoModel();
        $data = $model->findAll();
        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $model = new ContenidoModel();
        $data = $model->find(['id' => $id]);

        if (!$data) return $this->failNotFound('No Data Found');

        return $this->respond($data[0]);
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        helper(['form']);
        $rules = [
            'titulo'            => 'required', 
            'palabras_clave'    => 'required', 
            'area_conocimiento' => 'required', 
            'tipo_contenido'    => 'required', 
            'imagen_portada'    => 'required', 
            'thumbnail'         => 'required', 
            'descripcion'       => 'required', 
            'contenido'         => 'required'
        ];
        $data = [
            'titulo'            => $this->request->getVar('titulo'),
            'palabras_clave'    => $this->request->getVar('palabras_clave'),
            'area_conocimiento' => $this->request->getVar('area_conocimiento'),
            'tipo_contenido'    => $this->request->getVar('tipo_contenido'),
            'imagen_portada'    => $this->request->getVar('imagen_portada'),
            'thumbnail'         => $this->request->getVar('thumbnail'),
            'descripcion'       => $this->request->getVar('descripcion'),
            'contenido'         => $this->request->getVar('contenido')
        ];
        
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        $model = new ContenidoModel();
        $model->save($data);
        
        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Data Inserted'
            ]
        ];
        return $this->respondCreated($response);
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        helper(['form']);
        $rules = [
            'titulo'            => 'required', 
            'palabras_clave'    => 'required', 
            'area_conocimiento' => 'required', 
            'tipo_contenido'    => 'required', 
            'imagen_portada'    => 'required', 
            'thumbnail'         => 'required', 
            'descripcion'       => 'required', 
            'contenido'         => 'required'
        ];
        $data = [
            'titulo'            => $this->request->getVar('titulo'),
            'palabras_clave'    => $this->request->getVar('palabras_clave'),
            'area_conocimiento' => $this->request->getVar('area_conocimiento'),
            'tipo_contenido'    => $this->request->getVar('tipo_contenido'),
            'imagen_portada'    => $this->request->getVar('imagen_portada'),
            'thumbnail'         => $this->request->getVar('thumbnail'),
            'descripcion'       => $this->request->getVar('descripcion'),
            'contenido'         => $this->request->getVar('contenido')
        ];
        
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        $model = new ContenidoModel();
        $find = $model->find(['id' => $id]);

        if(!$find) return $this->failNotFound('No Data Found');
        $model->update($id, $data);
        
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data updated'
            ]
        ];
        return $this->respond($response);
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $model = new ContenidoModel();
        $find = $model->find(['id' => $id]);

        if(!$find) return $this->failNotFound('No Data Found');
        
        $model->delete($id);
        
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data deleted'
            ]
        ];
        return $this->respond($response);
    }
}
