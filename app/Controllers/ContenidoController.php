<?php

namespace App\Controllers;

use App\Database\Migrations\Contenidos;
use App\Models\ContenidoModel;
use CodeIgniter\API\ResponseTrait;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;

class ContenidoController extends ResourceController
{
    protected $helpers = ['form'];
    use ResponseTrait;

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $model = new ContenidoModel();

        $data = $model  ->orderBy('created_at', 'DESC')
                        ->orderBy('updated_at', 'DESC')
                        ->findAll();

        foreach ($data as &$contenido) {
            $contenido['thumbnail'] = base_url('uploads/' . $contenido['thumbnail']);
            $contenido['imagen_portada'] = base_url('uploads/' . $contenido['imagen_portada']);
        }
    
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

        $data[0]["thumbnail"] = base_url('uploads/' . $data[0]['thumbnail']);
        $data[0]["imagen_portada"] = base_url('uploads/' . $data[0]['imagen_portada']);

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
        $data = $this->request->getPost();

        $contenidoModel = new ContenidoModel();

        if (!$contenidoModel->validate($data)) {
            $validationErrors = $contenidoModel->errors();

            return $this->failValidationErrors($validationErrors);
        }

        $imageFields = ['imagen_portada', 'thumbnail'];
        foreach ($imageFields as $field) {
            $img = $this->request->getFile($field);
            
            if ($img->isValid() && !$img->hasMoved()) {
                $newName = $img->getRandomName();
                $img->move(FCPATH . 'uploads', $newName);
                $data[$field] = $newName;
            }
        }

        $inserted = $contenidoModel->insert($data);

        if (!$inserted) {
            return $this->failServerError('No se pudo publicar el contenido, intenta más tarde');
        }

        return $this->respondCreated(['message' => 'Contenido publicado correctamente'], 201);
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
        $rules = [
            'titulo'            => 'required', 
            'palabras_clave'    => 'required', 
            'area_conocimiento' => 'required', 
            'tipo_contenido'    => 'required', 
            'descripcion'       => 'required', 
            'contenido'         => 'required'
        ];

        $data = $this->request->getJSON();
        
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        $model = new ContenidoModel();
        $find = $model->find(['id' => $id]);

        if(!$find) return $this->failNotFound('No Data Found');
        
        $model->update($id, $data);
        
        return $this->respondCreated(['message' => 'Contenido actualizado correctamente'], 201);
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

        // Eliminar las imágenes asociadas
        $camposImagen = ['imagen_portada', 'thumbnail'];

        foreach ($camposImagen as $campo) {
            if (!empty($find[$campo])) {
                $rutaImagen = FCPATH . 'uploads/' . $find[$campo];
                echo $rutaImagen;
                if (file_exists($rutaImagen)) {
                    unlink($rutaImagen);
                }
            }
        }
        
        if ($model->delete($id)) {
            return $this->respondDeleted(['message' => 'Contenido eliminado correctamente']);
        } else {
            return $this->failServerError('No se pudo eliminar el contenido');
        }
    }
}
