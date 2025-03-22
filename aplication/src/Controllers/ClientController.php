<?php

namespace Xyz\PruebaTecnica\Controllers;

use Xyz\PruebaTecnica\Models\Client;
use Exception;

class ClientController
{
    // Crear un nuevo cliente
    public function store($data)
    {
        if (empty($data['name']) || empty($data['email'])) {
            throw new Exception('Todos los campos son obligatorios.'); 
        }

        if (Client::where('email', $data['email'])->exists()) {
            throw new Exception('El correo electrónico ya está registrado.'); 
        }

        return Client::create($data);
    }

    // Obtener un cliente por ID
    public function show($id)
    {
        $client = Client::find($id);
        if (!$client) {
            throw new Exception('Cliente no encontrado.');
        }

        return $client;
    }

    // Obtener todos los clientes
    public function index() 
    {
        return Client::all(); 
    }

    // Actualizar un cliente
    public function update($id, $data)
    {
        if (empty($data['name']) || empty($data['email'])) {
            throw new Exception('Todos los campos son obligatorios.'); 
        }

        $client = Client::find($id);
 
        if (!$client) {
            throw new Exception('Cliente no encontrado.'); 
        }

        if (Client::where('email', $data['email'])->where('id', '!=', $id)->exists()) { 
            throw new Exception('El correo electrónico ya está registrado.');
        }

        $client->update($data); 
        return $client;
    }

    // Eliminar un cliente
    public function destroy($id)
    {
        $client = Client::find($id); 

        if (!$client) {
            throw new Exception('Cliente no encontrado.'); 
        }

        $client->delete(); 
        return true;
    }
}