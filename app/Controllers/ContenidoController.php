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
     * FUNCIÓN PARA OBTENER TODAS LAS PUBLICACIONES SUBIDAS
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $model = new ContenidoModel();

        $data = $model  ->orderBy('created_at', 'DESC')
                        ->orderBy('updated_at', 'DESC')
                        ->findAll();

        // FUNCIÓN CREADA CON EL MOTIVO DE ENTREGARLE AL FRONT END LA RUTA COMPLETA DE LAS IMAGENES ALMACENADAS:
        foreach ($data as &$contenido) {
            $contenido['thumbnail']         = base_url('uploads/' . $contenido['thumbnail']     );
            $contenido['imagen_portada']    = base_url('uploads/' . $contenido['imagen_portada']);
        }
    
        return $this->respond($data);
    }

    /**
     * FUNCIÓN PARA OBTENER UNA PUBLICACIÓN CON UN ID EN ESPECÍFICO
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

        // MANIPULACIÓN DE DATOS CON EL MOTIVO DE ENTREGARLE AL FRONT END LA RUTA COMPLETA DE LAS IMAGENES ALMACENADAS
        $data[0]["thumbnail"]       = base_url('uploads/' . $data[0]['thumbnail']       );
        $data[0]["imagen_portada"]  = base_url('uploads/' . $data[0]['imagen_portada']  );

        return $this->respond($data[0]);
    }

    /**
     * FUNCIÓN PARA CREAR Y SUBIR UNA NUEVA PUBLICACIÓN AL SISTEMA
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $data = $this->request->getPost();

        $contenidoModel = new ContenidoModel();

        // SE VALIDA CON EL MODELO QUE LOS DATOS CUMPLAN CON LAS REGLAS DEFINIDAS
        if (!$contenidoModel->validate($data)) {
            $validationErrors = $contenidoModel->errors();

            return $this->failValidationErrors($validationErrors);
        }

        // FUNCIÓN CREADA PARA OBTENER Y ALMACENAR LAS IMÁGENES DADAS POR EL USUARIO
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
     * FUNCIÓN PARA EDITAR UNA PUBLICACIÓN SUBIDA AL SISTEMA
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
        
        // SE VALIDA QUE LOS DATOS CUMPLAN LAS REGLAS DEFINIDAS
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        $model = new ContenidoModel();

        $find = $model->find(['id' => $id]);

        if(!$find) return $this->failNotFound('No Data Found');
        
        $model->update($id, $data);
        
        return $this->respondCreated(['message' => 'Contenido actualizado correctamente'], 201);
    }

    /**
     * FUNCIÓN PARA ELIMINAR UNA PUBLICACION DEL SISTEMA
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

        // FUNCIÓN PARA ELIMINAR LAS IMAGENES ASOCIADAS
        // NOTA: POR ALGÚN MOTIVO NO DETECTADO, NO SE PUEDEN ELIMINAR LAS IMAGENES EXISTENTES
        $camposImagen = ['imagen_portada', 'thumbnail'];

        foreach ($camposImagen as $campo) {
            if (!empty($find[$campo])) {
                $rutaImagen = FCPATH . 'uploads/' . $find[$campo];

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
